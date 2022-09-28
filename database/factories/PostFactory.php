<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'image' => null,
            'slug' => fake()->slug(),
            'excerpt' => fake()->sentence(),
            'body' => fake()->paragraphs(3,true),
        ];
    }
}
