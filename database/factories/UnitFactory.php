<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class UnitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->word(),
            'unit_id' => null,
            'operator' => $this->faker->randomElement(['+','-','*','/']),
            'value' => $this->faker->numberBetween(1,100)
        ];
    }
}
