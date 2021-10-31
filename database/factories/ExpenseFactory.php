<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Support\Str;
use App\Models\ExpenseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'expense_category_id' => ExpenseCategory::first(),
            'amount' => random_int(1,8),
            'comment' => 'Hey this is a comment',
        ];
    }
}
