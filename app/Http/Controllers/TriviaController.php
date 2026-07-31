<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\GameResult;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TriviaController extends Controller
{
    /**
     * 1. Start a New Game Round
     */
    public function index()
    {
        // Fetch 5 random questions
        $questions = Question::inRandomOrder()
            ->take(5)
            ->get(['id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d']); // leave out the answer to prevent cheating

        return Inertia::render('Trivia/Play', [
            'questions' => $questions
        ]);
    }

    /**
     * 2. Submit Answers & Calculate Score
     */
    public function store(Request $request)
    {
        // Validate payload sent from React
        $validated = $request->validate([
            'answers' => 'required|array',
            'time_taken' => 'required|integer|min:0',
        ]);

        $userAnswers = $validated['answers'];
        $timeTaken = $validated['time_taken'];

        // Retrieve the actual correct options from the DB for the submitted question IDs
        $questionIds = array_keys($userAnswers);
        $questions = Question::whereIn('id', $questionIds)->get()->keyBy('id');

        $score = 0;

        foreach ($userAnswers as $questionId => $submittedOption) {
            if (isset($questions[$questionId])) {
                if ($questions[$questionId]->correct_option === strtoupper($submittedOption)) {
                    $score += 20; // 5 questions * 20 pts = 100 max points
                }
            }
        }

        // Save result to DB
        GameResult::create([
            'user_id' => Auth::id(),
            'score' => $score,
            'time_taken_seconds' => $timeTaken,
        ]);

        return redirect()->route('trivia.leaderboard')->with('success', "Game over! You scored {$score} points!");
    }

    /**
     * 3. View Global Leaderboard
     */
    public function leaderboard()
    {
        $leaderboard = GameResult::with('user:id,name')
            ->orderByDesc('score')
            ->orderBy('time_taken_seconds', 'asc') // Faster time wins ties
            ->take(10)
            ->get();

        return Inertia::render('Trivia/Leaderboard', [
            'leaderboard' => $leaderboard
        ]);
    }
}
