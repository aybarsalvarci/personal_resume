<?php

namespace Database\Factories;

use App\Models\ProjectCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $icons = ["fas fa-user", "fas fa-shopping-cart", "fas fa-image", "fas fa-lightbulb", "fas fa-laptop-code", "fas fa-chart-line", "fas fa-chart-pie"];
        $name = $this->faker->word();
        return [
            'category_id' => ProjectCategory::factory(),
            'image' => $this->faker->imageUrl(width: 800),
            'icon' => $this->faker->randomElement($icons),
            'link' => $this->faker->url,
            'name' => $name,
            'slug' => str()->slug($name),
            'description' => $this->faker->text(),
            'isFeatured' => $this->faker->boolean(),
            'meta_description' => $this->faker->text(160),
            'meta_keywords' => $this->faker->text(160),
            'keys' => str_replace(" ", ", ", $this->faker->sentence())
        ];
    }
}
