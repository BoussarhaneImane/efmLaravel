<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
       /* $this->call(StagiaireSeeder::class);*/
       $this->call([
        CategoriesTableSeeder::class,
        LivresTableSeeder::class,
    ]);

    }
}
