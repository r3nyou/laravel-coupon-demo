<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Prize;
use App\Models\Voucher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Activity::factory(1)
            ->has(
                Prize::factory(3)
                    ->has(
                        Voucher::factory(10)
                    )
            )
            ->create();
    }
}
