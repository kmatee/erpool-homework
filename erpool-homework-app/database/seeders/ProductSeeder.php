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
            'category_id' => 1,
            'image_url' => 'https://cdn11.bigcommerce.com/s-oq4cmf0wjd/images/stencil/1280x1280/products/560/3363/Heineken_Complete_TieDye_Crooked__29778.1626992757__81745.1670910412.jpg?c=2'
        ]);

        DB::table('products')->insert([
            'name' => 'tent',
            'price' => 28000,
            'category_id' => 2,
            'image_url' => 'https://media.istockphoto.com/id/142533334/photo/yellow-dome-tent-with-open-zip-enclosure.jpg?s=612x612&w=0&k=20&c=GZyiiSF95j0Yxa_7pc6LUebf8MVvRebJcrnMXETN5eU='
        ]);

        DB::table('products')->insert([
            'name' => 'goggles',
            'price' => 2700,
            'category_id' => 3,
            'image_url' => 'https://hips.hearstapps.com/hmg-prod/images/swim-goggles-1653058843.jpg?crop=0.888888888888889xw:1xh;center,top&resize=1200:*'
        ]);

        DB::table('products')->insert([
            'name' => 'basketball',
            'price' => 5000,
            'category_id' => 4,
            'image_url' => 'https://target.scene7.com/is/image/Target/GUEST_20affc7e-e0d7-4eb6-a6f3-68d13520f8be?wid=488&hei=488&fmt=pjpeg'
        ]);
    }
}
