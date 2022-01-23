<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'title' => 'Apple',
            'price' => 99999,
            'filename' => 'products/apple01.jpg',
        ]);
        DB::table('products')->insert([
            'title' => 'orange',
            'price' => 45166,
            'filename' => 'products/orange01.jpg',
        ]);
    }
}
