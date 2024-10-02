<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Page>
 */
class PageFactory extends Factory
{
   
    
    protected $model = \App\Models\Page::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'perex' => $this->faker->paragraph(),
            'text' => $this->faker->paragraphs(3, true),
            'published_at' => $this->faker->dateTimeBetween('-5 years'),
        ];
    }
}
