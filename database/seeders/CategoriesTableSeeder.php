<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        
        // Supprimer tous les enregistrements de la table categories
        DB::table('categories')->delete();

        // Réinitialiser l'auto-incrément
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1;');

        // Insérer les nouvelles catégories
        DB::table('categories')->insert([
            [
                'nom' => 'Science Fiction',
                'description' => 'Livres de science fiction',
            ],
            [
                'nom' => 'Fantasy',
                'description' => 'Livres de fantasy',
            ],
            [
                'nom' => 'Mystère',
                'description' => 'Livres de mystère',
            ],
        ]);

        
    }
}
