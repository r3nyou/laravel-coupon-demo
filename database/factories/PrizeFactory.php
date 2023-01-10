<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PrizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random('6'),
            'discount_amount' => mt_rand(100, 500),
            'probability' => mt_rand(1000, 8000) / 100,
        ];
    }
}
