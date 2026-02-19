<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'title' => fake()->title(),
      'slug' => fake()->slug(),
      'text' => fake()->text(),
      'phone' => fake()->phoneNumber(),
      'status' => fake()->randomElement([1, 2, 3]),
      'user_id' => \App\Models\User::factory(),
    ];
  }
}
