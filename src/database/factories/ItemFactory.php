<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{

    protected $model = Item::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10), 
            'condition_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->word,
            'brandname' => $this->faker->company,
            'price' => $this->faker->numberBetween(1000, 50000),
            'description' => $this->faker->sentence,
            'image' => '商品写真.png', 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
