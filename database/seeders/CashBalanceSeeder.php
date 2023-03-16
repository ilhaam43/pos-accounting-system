<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CashBalance;
use Carbon\Carbon;

class CashBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $februaryDate = Carbon::create(2023, 02, 06, 10, 30, 0);
        $date = Carbon::create(2023, 03, 06, 10, 30, 0);
        $cashBalance = [
            [
                'initial_cash' => 5000000,
                'ending_cash' => 5000000,
                'change' => 0,
                'created_at' => $februaryDate
            ],
        ];

        foreach ($cashBalance as $key => $value) {
            CashBalance::create($value);
        }
    }
}
