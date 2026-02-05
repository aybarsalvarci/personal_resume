<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
        return [
            'category_id' => BlogCategory::factory(),
            'title' => $title,
            'slug' => str()->slug($title),
            'meta_description' => $this->faker->sentence(),
            'meta_keywords' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'isFeatured' => $this->faker->boolean(),
        ];
    }
}
