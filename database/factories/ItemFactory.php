<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sub_category_id' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}
