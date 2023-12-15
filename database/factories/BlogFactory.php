<?php

namespace Database\Factories;

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
        return [
            'title' => fake()->sentence(10),
            'slug' => fake()->slug(),
            'short_description' => fake()->sentence(25),
            'language' => 'pl',
            'content' => fake()->paragraph(10),
            'tags' => 'tag1,tag2,tag3',
            'image_url' => fake()->imageUrl(),
        ];
    }
}
