<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => 'Received',
            'from_branch_id' => $this->faker->numberBetween(1,50),
            'to_branch_id' => $this->faker->numberBetween(1,50),
            'sender_name' => $this->faker->name(),
            'receiver_id' => $this->faker->numberBetween(1,50),
            'description' => $this->faker->text(50),
            'quantity' => $this->faker->numberBetween(1,50),
            'price' => $this->faker->numberBetween(20,500),
            'home' => $this->faker->numberBetween(20,250),
            'labour' => $this->faker->numberBetween(20,200),
            'paid' => $this->faker->numberBetween(20,500),
            'creator_id' => $this->faker->numberBetween(1,50),
        ];
    }
}
