<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                'name'=>'Oppo F9',
                'price'=>'80000',
                'category'=>'Mobile',
                'description'=>'Smart phone avec capacité de stockage de 64Gb ',
                'quantity'=>'150',
                'image'=>'https://www.esanshar.com/image/cache/catalog/Seller_81/F9/F9pro-550x550.jpg'
            ]
        );
    }
}
