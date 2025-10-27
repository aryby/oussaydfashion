<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image' => 'default.jpg',
            'product_id' => \App\Models\Product::factory()->create()->id,
            'discount_percentage' => $this->faker->numberBetween(10, 50),
        ];
    }
}
