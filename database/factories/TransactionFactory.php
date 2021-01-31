<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Resto;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $resto = Resto::has('food')->get()->random();
        $customer = User::all()->except($resto->id)->random();

        return [
            'quantity' => $this->faker->numberBetween(1,3),
            'total' => $this->faker->randomDigit,
            'status' => $this->faker->randomElement([Transaction::PENDING,Transaction::CANCELED,Transaction::ON_DELIVERY,Transaction::DELIVERED]),
            'food_id' => $resto->food->random()->id,
            'customer_id' => $customer->id,
        ];
    }
}
