<?php

namespace Database\Factories;

use App\Models\Tax;
use App\Models\Unit;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Standard','Combo']),
            'name' => $this->faker->word(),
            'barcode' => $this->faker->ean13(),
            'brand_id' => Brand::factory(),
            'product_category_id' => ProductCategory::factory(),
            'tax_id' => Tax::factory(),
            'tax_method' => $this->faker->randomElement(['Exclusive','Inclusive']),
            'product_unit_id' => Unit::factory(),
            'sale_unit_id' => Unit::factory(),
            'purchase_unit_id' => Unit::factory(),
            'cost' => $this->faker->numberBetween(30,1000),
            'price' => $this->faker->numberBetween(31,1000),
            'image' => null,
            'details' => $this->faker->realText(),
            'alert_quantity' => $this->faker->numberBetween(1,10),
        ];
    }
}
