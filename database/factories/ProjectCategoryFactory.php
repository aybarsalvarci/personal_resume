<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class ProjectCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->word();
        $icons = ["fab fa-laravel", "fab fa-python", "fab fa-php", "fab fa-js", "fab fa-sass", "fab fa-less", "fas fa-layer-group", "fas fa-server", "fas fa-brain"];
        return [
            'icon' => $this->faker->randomElement($icons),
            'name' => $name,
            'slug' => str()->slug($name),
            'order' => $this->faker->randomDigit(),
        ];
    }
}
