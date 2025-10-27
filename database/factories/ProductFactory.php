<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->text,
            'details' => $this->faker->text,
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'sale_price' => $this->faker->randomFloat(2, 5, 90),
            'qty' => $this->faker->numberBetween(1, 10),
            'images' => json_encode(['default.jpg']),
            'brand_id' => \App\Models\Brand::factory()->create()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (\App\Models\Product $product) {
            $product->categories()->attach(\App\Models\Category::factory()->create()->id);
        });
    }
}
