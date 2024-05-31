<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categorie;
use App\Models\Livre;

class LivresTableSeeder extends Seeder
{
    public function run()

    {
        // Supprimer tous les enregistrements de la table categories
        DB::table('livres')->delete();
        // Réinitialiser l'auto-incrément
        DB::statement('ALTER TABLE livres AUTO_INCREMENT = 1;');
     
        DB::table('livres')->insert([
                [
                    'titre' => 'Le Guide du voyageur galactique',
                    'pages' => 224,
                    'description' => 'Un livre de science fiction humoristique.',
                    'categorie_id' => Categorie::inRandomOrder()->first()->id,
                    'image' => 'images/guide_voyageur.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Le Seigneur des Anneaux',
                    'pages' => 1178,
                    'description' => 'Un classique de la fantasy épique.',
                    'categorie_id' => Categorie::inRandomOrder()->first()->id,
                    'image' => 'images/seigneur_anneaux.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'titre' => 'Le Mystère de la chambre jaune',
                    'pages' => 320,
                    'description' => 'Un roman policier de Gaston Leroux.',
                    'categorie_id' => Categorie::inRandomOrder()->first()->id,
                    'image' => 'images/chambre_jaune.jpg',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
               
            ]);
           
      
    }
}
