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
                'name'=>'Xbox Wireless Controller - Black',
                'slug'=> Str::slug('Xbox Wireless Controller - Black'),
                'price'=>'20000',
                'SKU'=>'xbox-manette',
                'short-description' => "Disponible à un prix inférieur auprès d'autres vendeurs qui n'offrent peut-être pas la livraison Prime gratuite.",
                'description'=>"Découvrez le confort et la sensation améliorés de la nouvelle manette sans fil Xbox, dotée d'un design élégant et profilé et d'une prise texturée. Profitez d'un mappage de boutons personnalisé et d'une portée sans fil jusqu'à deux fois supérieure. Branchez n'importe quel casque compatible avec la prise casque stéréo 3,5 mm. Et avec la technologie Bluetooth, jouez à vos jeux préférés sur les PC et tablettes Windows 10. Mappage des boutons disponible via l'application Accessoires Xbox. Portée par rapport aux manettes précédentes avec la Xbox One S.",
                'stock-status'=>'instock',
                'quantity'=>4,
                'category_id'=>1,
            ]
        );
    }
}
