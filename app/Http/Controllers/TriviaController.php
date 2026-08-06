<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\GameResult;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TriviaController extends Controller
{
    private const QUESTIONS_PER_GAME = 10;
    private const POINTS_PER_CORRECT_ANSWER = 10;
    private const MIX_SLUG = 'mix';

    /**
     * Home: the category picker.
     */
    public function home()
    {
        $categories = Category::orderBy('sort_order')
            ->get(['id', 'name', 'slug', 'accent_color', 'icon']);

        return Inertia::render('Home', [
            'categories' => $categories,
        ]);
    }

    /**
     * 1. Start a New Game Round
     */
    public function index(string $categorySlug)
    {
        if ($categorySlug === self::MIX_SLUG) {
            $categoryName = 'Mix';
            $questionsQuery = Question::query();
        } else {
            $categoryModel = Category::where('slug', $categorySlug)->firstOrFail();
            $categoryName = $categoryModel->name;
            $questionsQuery = Question::where('category_id', $categoryModel->id);
        }

        // correct_option is included so the client can show instant right/wrong
        // feedback (shake + sound) on each answer; the timer makes hunting
        // through dev tools for it not worth the lost time. Scoring is still
        // computed server-side in store() regardless.
        $questions = $questionsQuery
            ->inRandomOrder()
            ->take(self::QUESTIONS_PER_GAME)
            ->get(['id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option']);

        return Inertia::render('Trivia/Play', [
            'questions' => $questions,
            'category' => $categoryName,
        ]);
    }

    /**
     * 2. Submit Answers & Calculate Score
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable|string|in:A,B,C,D',
            'time_taken' => 'required|integer|min:0',
        ]);

        $userAnswers = $validated['answers'];
        $timeTaken = $validated['time_taken'];

        $questionIds = array_keys($userAnswers);
        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        $score = 0;

        foreach ($userAnswers as $questionId => $submittedOption) {
            if ($submittedOption && isset($questions[$questionId])) {
                if ($questions[$questionId]->correct_option === $submittedOption) {
                    $score += self::POINTS_PER_CORRECT_ANSWER;
                }
            }
        }

        $gameResult = GameResult::create([
            'user_id' => Auth::id(),
            'score' => $score,
            'time_taken_seconds' => $timeTaken,
        ]);

        return redirect()->route('trivia.results', $gameResult);
    }

    /**
     * 3. View a Single Game's Results
     */
    public function results(GameResult $gameResult)
    {
        abort_unless($gameResult->user_id === Auth::id(), 403);

        return Inertia::render('Trivia/Results', [
            'score' => $gameResult->score,
            'maxScore' => self::QUESTIONS_PER_GAME * self::POINTS_PER_CORRECT_ANSWER,
            'timeTaken' => $gameResult->time_taken_seconds,
        ]);
    }

    /**
     * 4. View Global Leaderboard
     *
     * Ranked by a player's Total Score summed across every Game they've
     * played, tie-broken by their average time per Game (faster wins).
     * Computed live from game_results rather than stored — see ADR 0002.
     */
    public function leaderboard()
    {
        $leaderboard = User::query()
            ->select('users.id', 'users.name')
            ->selectRaw('SUM(game_results.score) as total_score')
            ->selectRaw('AVG(game_results.time_taken_seconds) as average_time_seconds')
            ->join('game_results', 'game_results.user_id', '=', 'users.id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_score')
            ->orderBy('average_time_seconds')
            ->take(10)
            ->get();

        return Inertia::render('Trivia/Leaderboard', [
            'leaderboard' => $leaderboard,
        ]);
    }
}
