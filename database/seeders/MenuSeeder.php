<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::create(2023, 03, 06, 10, 30, 0);
        $menu = [
            [
                'name' => 'Mie Goreng',
                'image' => 'menus/image/mie goreng.jfif',
                'price' => 20000,
                'category' => 'Makanan',
                'created_at' => $date
            ],
            [
                'name' => 'Mie Rebus',
                'image' => 'menus/image/mie rebus.jfif',
                'price' => 22000,
                'category' => 'Makanan',
                'created_at' => $date
            ],
            [
                'name' => 'Mie Goreng Seafood',
                'image' => 'menus/image/mie goreng seafood.webp',
                'price' => 30000,
                'category' => 'Makanan',
                'created_at' => $date
            ],
            [
                'name' => 'Mie Rebus Seafood',
                'image' => 'menus/image/mie rebus seafood.jpg',
                'price' => 32000,
                'category' => 'Makanan',
                'created_at' => $date
            ],
            [
                'name' => 'Es Teh Manis',
                'image' => 'menus/image/es-teh-manis.jpg',
                'price' => 5000,
                'category' => 'Minuman',
                'created_at' => $date
            ],
            [
                'name' => 'Es Jeruk',
                'image' => 'menus/image/es jeruk.jpg',
                'price' => 7000,
                'category' => 'Minuman',
                'created_at' => $date
            ],
        ];

        foreach ($menu as $key => $value) {
            Menu::create($value);
        }
    }
}
