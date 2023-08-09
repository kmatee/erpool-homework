<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'skateboard',
            'price' => 25000,
            'category_id' => 1
        ]);

        DB::table('products')->insert([
            'name' => 'tent',
            'price' => 28000,
            'category_id' => 2
        ]);

        DB::table('products')->insert([
            'name' => 'goggles',
            'price' => 2700,
            'category_id' => 3
        ]);

        DB::table('products')->insert([
            'name' => 'basketball',
            'price' => 5000,
            'category_id' => 4
        ]);
    }
}
