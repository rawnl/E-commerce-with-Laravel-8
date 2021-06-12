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
        DB::table('products')->insert(
            [
                'name'=>'Manette PS4 - Red',
                'slug'=> Str::slug('Manette PS4 - Red'),
                'price'=>'22000',
                'SKU'=>'ps4-manette',
                'short_description' => "Manette de Jeu Bluetooth sans Fil pour Playstation 4 avec câble USB Compatible avec Windows PC-Red",
                'description'=>"Compatible avec la console PS4 et PC. Si vous souhaitez connecter votre contrôleur à l'ordinateur, vous devez utiliser un câble micro-port pour vous connecter, ou l'acheteur dispose d'un récepteur Bluetooth, vous pouvez utiliser le récepteur Bluetooth pour connecter ce contrôleur sans fil.",
                'stock_status'=>'instock',
                'quantity'=>14,
                'category_id'=>1,
            ]
        );
    }
}
