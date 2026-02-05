<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogCategory>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = ["fas fa-user", "fas fa-shopping-cart", "fas fa-image", "fas fa-lightbulb", "fas fa-laptop-code", "fas fa-chart-line", "fas fa-chart-pie"];
        $name = $this->faker->unique()->word();

        return [
            'name' => $name,
            'slug' => str()->slug($name),
            'icon' => $this->faker->randomElement($icons),
            'order' => $this->faker->randomDigit(),
        ];
    }
}
