<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => '097' . rand(111111, 999999),
            'code' => strtoupper(Str::random(8)),
            'discount_amount' => mt_rand(100, 500),
            'expired_at' => Carbon::now()->addYear(),
        ];
    }
}
