<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Food', 'slug' => 'food', 'accent_color' => '#F2B8C6', 'icon' => '🍕'],
            ['name' => 'Animals', 'slug' => 'animals', 'accent_color' => '#E8A9B8', 'icon' => '🐾'],
            ['name' => 'Movies', 'slug' => 'movies', 'accent_color' => '#D98CA0', 'icon' => '🎬'],
            ['name' => 'Computers', 'slug' => 'computers', 'accent_color' => '#C97F98', 'icon' => '💻'],
            ['name' => 'Ocean', 'slug' => 'ocean', 'accent_color' => '#B8718F', 'icon' => '🌊'],
            ['name' => 'Music', 'slug' => 'music', 'accent_color' => '#A66584', 'icon' => '🎵'],
            ['name' => 'Space', 'slug' => 'space', 'accent_color' => '#935979', 'icon' => '🚀'],
            ['name' => 'Sports', 'slug' => 'sports', 'accent_color' => '#7F4D6D', 'icon' => '⚽'],
            ['name' => 'Geography', 'slug' => 'geography', 'accent_color' => '#6C4160', 'icon' => '🌍'],
            ['name' => 'Video Games', 'slug' => 'video-games', 'accent_color' => '#593554', 'icon' => '🎮'],
        ];

        foreach ($categories as $index => $category) {
            DB::table('categories')->insert([
                ...$category,
                'sort_order' => $index + 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
