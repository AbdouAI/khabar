<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = DB::table('users')->pluck('id')->toArray();
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraphs(3, true),
            'view_count' => $this->faker->numberBetween(0, 1000),
            'image' => 'ie7EDGLw7jutkk7LAkLHtffrNWkp3b4TYf0nlbti.jpg',
            'date' => $this->faker->dateTimeBetween('-2 months', 'today')->format('Y-m-d'),
            'user_id' => $this->faker->randomElement($userIds),
            'category_id' => $this->faker->randomElement($categoryIds),
        ];
    }
}
