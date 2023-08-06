<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $harga = [
            10000,
            20000,
            30000,
            40000,
            50000,
            60000,
            70000,
            80000,
            90000,
            100000,
        ];
        for ($i = 0; $i < 10; $i++) {
            Item::create([
                'name' => 'Item ' . $i + 1,
                'harga' => $harga[rand(0, 9)],
                'satuan' => 'Pak',
                'stok' => 0,
            ]);
        }
    }
}
