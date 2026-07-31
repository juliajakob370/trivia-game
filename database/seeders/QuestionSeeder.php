<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('questions')->insert([
            [
                'question_text' => 'How was lunch?',
                'option_a' => 'Good',
                'option_b' => 'Bad',
                'option_c' => 'Still eating it',
                'option_d' => 'You guys had lunch??',
                'correct_option' => 'A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'What is the capital of Ontario?',
                'option_a' => 'Ottawa',
                'option_b' => 'Toronto',
                'option_c' => 'Waterloo',
                'option_d' => 'London',
                'correct_option' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'What is the largest filter-feeding shark?',
                'option_a' => 'Great White Shark',
                'option_b' => 'Mako',
                'option_c' => 'Bull Shark',
                'option_d' => 'Whale Shark',
                'correct_option' => 'D',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'What never spoils?',
                'option_a' => 'Pickles',
                'option_b' => 'Honey',
                'option_c' => 'Maple Syrup',
                'option_d' => 'Milk',
                'correct_option' => 'B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'question_text' => 'How many hearts does an octopus have?',
                'option_a' => '8',
                'option_b' => '1',
                'option_c' => '3',
                'option_d' => '2',
                'correct_option' => 'C',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
