<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = 'Accessoires Gaming';
        $slug = Str::slug($name);
        DB::table('categories')->insert(
            [
                'name'=> $name,
                'slug'=>$slug
            ]
        );
    }
}
