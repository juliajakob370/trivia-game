<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\GameResult;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class TriviaTest extends TestCase
{
    use RefreshDatabase;

    private function makeCategory(string $name, string $slug): Category
    {
        return Category::create([
            'name' => $name,
            'slug' => $slug,
            'accent_color' => '#C97F98',
            'icon' => '❓',
            'sort_order' => 1,
        ]);
    }

    private function makeQuestions(Category $category, int $count): void
    {
        for ($i = 0; $i < $count; $i++) {
            Question::create([
                'question_text' => "{$category->name} question {$i}",
                'option_a' => 'Correct',
                'option_b' => 'Wrong',
                'option_c' => 'Wrong',
                'option_d' => 'Wrong',
                'correct_option' => 'A',
                'category_id' => $category->id,
            ]);
        }
    }

    public function test_home_page_lists_categories(): void
    {
        $this->makeCategory('Food', 'food');
        $this->makeCategory('Space', 'space');

        $response = $this->actingAs(User::factory()->create())->get('/dashboard');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Home')
            ->has('categories', 2)
            ->where('categories.0.name', 'Food')
        );
    }

    public function test_starting_a_game_for_a_category_returns_ten_questions_from_it(): void
    {
        $food = $this->makeCategory('Food', 'food');
        $space = $this->makeCategory('Space', 'space');
        $this->makeQuestions($food, 15);
        $this->makeQuestions($space, 15);

        $response = $this->actingAs(User::factory()->create())->get('/play/food');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Trivia/Play')
            ->has('questions', 10)
        );

        $questionIds = collect($response->viewData('page')['props']['questions'])->pluck('id');
        $this->assertCount(0, Question::whereIn('id', $questionIds)->where('category_id', $space->id)->get());
    }

    public function test_starting_a_game_for_a_category_with_fewer_than_ten_questions_serves_what_exists(): void
    {
        $thin = $this->makeCategory('Thin', 'thin');
        $this->makeQuestions($thin, 4);

        $response = $this->actingAs(User::factory()->create())->get('/play/thin');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Trivia/Play')
            ->has('questions', 4)
        );
    }

    public function test_mix_pulls_questions_from_any_category(): void
    {
        $food = $this->makeCategory('Food', 'food');
        $space = $this->makeCategory('Space', 'space');
        $this->makeQuestions($food, 10);
        $this->makeQuestions($space, 10);

        $response = $this->actingAs(User::factory()->create())->get('/play/mix');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Trivia/Play')
            ->has('questions', 10)
        );
    }

    public function test_submitting_answers_scores_ten_points_per_correct_answer(): void
    {
        $category = $this->makeCategory('Food', 'food');
        $this->makeQuestions($category, 10);
        $questions = Question::where('category_id', $category->id)->get();

        $answers = [];
        foreach ($questions as $index => $question) {
            // Answer the first 6 correctly, leave the rest wrong or unanswered.
            $answers[$question->id] = match (true) {
                $index < 6 => 'A',
                $index < 9 => 'B',
                default => null,
            };
        }

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/submit-game', [
            'answers' => $answers,
            'time_taken' => 55,
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect(route('trivia.leaderboard'));

        $this->assertDatabaseHas('game_results', [
            'user_id' => $user->id,
            'score' => 60,
            'time_taken_seconds' => 55,
        ]);
    }

    public function test_leaderboard_ranks_by_total_score_across_games_tie_broken_by_average_time(): void
    {
        $leader = User::factory()->create(['name' => 'Leader']);
        $fasterTiedPlayer = User::factory()->create(['name' => 'FasterTied']);
        $slowerTiedPlayer = User::factory()->create(['name' => 'SlowerTied']);

        // Leader: two games summing to more than the tied players.
        GameResult::create(['user_id' => $leader->id, 'score' => 100, 'time_taken_seconds' => 90]);
        GameResult::create(['user_id' => $leader->id, 'score' => 100, 'time_taken_seconds' => 90]);

        // Tied on total score (150), but different average times.
        GameResult::create(['user_id' => $fasterTiedPlayer->id, 'score' => 100, 'time_taken_seconds' => 40]);
        GameResult::create(['user_id' => $fasterTiedPlayer->id, 'score' => 50, 'time_taken_seconds' => 60]);

        GameResult::create(['user_id' => $slowerTiedPlayer->id, 'score' => 100, 'time_taken_seconds' => 80]);
        GameResult::create(['user_id' => $slowerTiedPlayer->id, 'score' => 50, 'time_taken_seconds' => 80]);

        $response = $this->actingAs(User::factory()->create())->get('/leaderboard');

        $response->assertOk();
        $response->assertInertia(fn (Assert $page) => $page
            ->component('Trivia/Leaderboard')
            ->has('leaderboard', 3)
            ->where('leaderboard.0.name', 'Leader')
            ->where('leaderboard.0.total_score', 200)
            ->where('leaderboard.1.name', 'FasterTied')
            ->where('leaderboard.1.total_score', 150)
            ->where('leaderboard.2.name', 'SlowerTied')
            ->where('leaderboard.2.total_score', 150)
        );
    }
}
