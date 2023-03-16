<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionCategory;
use Carbon\Carbon;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::create(2023, 03, 06, 10, 30, 0);
        $transactionCategory = [
            [
                'category' => 'Gaji Karyawan',
                'type' => 'Pengeluaran',
                'created_at' => $date
            ],
            [
                'category' => 'Bahan Baku',
                'type' => 'Pengeluaran',
                'created_at' => $date
            ],
            [
                'category' => 'Tagihan Air',
                'type' => 'Pengeluaran',
                'created_at' => $date
            ],
            [
                'category' => 'Tagihan Listrik',
                'type' => 'Pengeluaran',
                'created_at' => $date
            ],
            [
                'category' => 'Peralatan',
                'type' => 'Pengeluaran',
                'created_at' => $date
            ],
        ];

        foreach ($transactionCategory as $key => $value) {
            TransactionCategory::create($value);
        }
    }
}
