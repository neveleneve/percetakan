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
        for ($i = 0; $i < 2; $i++) {
            Item::create([
                'name' => 'Item ' . $i + 1,
                'satuan' => 'Pak',
                'stok' => 0,
            ]);
        }
    }
}
