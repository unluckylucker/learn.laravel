<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name'=>'Мобильные телефоны2', 'code'=>'mobiles2', 'description'=>'Мобильные телефоны'],
            ['name'=>'Потративная техника2', 'code'=>'portable2', 'description'=>'Мобильные телефоны'],
            ['name'=>'Бытовая техника2', 'code'=>'bitovaya2', 'description'=>'Мобильные телефоны'],
        ]);
    }
}
