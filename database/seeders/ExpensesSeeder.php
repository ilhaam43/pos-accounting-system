<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Expense;
use Carbon\Carbon;

class ExpensesSeeder extends Seeder
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
        $expenses = [
            [
                'category_id' => 1,
                'description' => 'Gaji Karyawan Bulan Maret',
                'value' => 2000000,
                'created_at' => $februaryDate
            ],
            [
                'category_id' => 2,
                'description' => 'Bahan Baku Bulan Maret',
                'value' => 1500000,
                'created_at' => $februaryDate
            ],
            [
                'category_id' => 3,
                'description' => 'Tagihan Air Bulan Maret',
                'value' => 200000,
                'created_at' => $februaryDate
            ],
            [
                'category_id' => 4,
                'description' => 'Bahan Baku Bulan Maret',
                'value' => 1500000,
                'created_at' => $februaryDate
            ],
            [
                'category_id' => 1,
                'description' => 'Gaji Karyawan Bulan Maret',
                'value' => 2000000,
                'created_at' => $date
            ],
            [
                'category_id' => 2,
                'description' => 'Bahan Baku Bulan Maret',
                'value' => 1500000,
                'created_at' => $date
            ],
            [
                'category_id' => 3,
                'description' => 'Tagihan Air Bulan Maret',
                'value' => 200000,
                'created_at' => $date
            ],
            [
                'category_id' => 4,
                'description' => 'Bahan Baku Bulan Maret',
                'value' => 1500000,
                'created_at' => $date
            ],
        ];

        foreach ($expenses as $key => $value) {
            Expense::create($value);
        }
    }
}
