<?php

namespace Database\Factories;

use App\Models\Food;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FoodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Food::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->paragraph(1),
            'ingredients' => $this->faker->paragraph(1),
            'price' => $this->faker->numberBetween(10000),
            'rate' => $this->faker->randomFloat(2, 0, 5),
            'status' => $this->faker->randomElement([Food::UNAVAILABLE, Food::AVAILABLE]),
            'image' => $this->faker->randomElement(['food_sample_1.jpg', 'food_sample_2.jpg', 'food_sample_3.jpg',]),
            'resto_id' => User::all()->random()->id,
        ];
    }
}
