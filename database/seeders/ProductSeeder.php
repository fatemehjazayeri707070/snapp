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
        $words = [ "خورشت", "قیمه", "کباب", "ماهی", "پلو", "نان", "آب", "پیتزا", "ساندویچ", "مرغ", "سالاد"];
        for ($i=0; $i < 50 ; $i++) {
            $date = now()->add( -rand(1,30), 'day');
            $title = $words[rand(0, count($words) - 1)] . ' ' . $words[rand(0, count($words) - 1)];
            DB::table('products')->insert([
               'shop_id' => rand(9, 11),
               'title' => $title,
               'price' => rand(10, 100) * 1000,
               'discount' => rand(0, 5) * 5,
               'created_at' => $date,
               'updated_at' => $date,
           ]);
        }
    }
}
