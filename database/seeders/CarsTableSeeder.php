<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // Vider la table 'routes'
        DB::table('cars')->truncate();
        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('cars')->insert([
            ['name' => 'Peugeot 208', 'seating_capacity' => 4, 'color' => 'Rouge', 'image_url' => 'https://example.com/images/peugeot_208.jpg', 'price_per_km' => 0.25],
            ['name' => 'Renault Clio', 'seating_capacity' => 4, 'color' => 'Bleu', 'image_url' => 'https://example.com/images/renault_clio.jpg', 'price_per_km' => 0.20],
            ['name' => 'BMW Série 3', 'seating_capacity' => 5, 'color' => 'Noir', 'image_url' => 'https://example.com/images/bmw_serie_3.jpg', 'price_per_km' => 0.50],
            ['name' => 'Mercedes A-Class', 'seating_capacity' => 5, 'color' => 'Blanc', 'image_url' => 'https://example.com/images/mercedes_a_class.jpg', 'price_per_km' => 0.75],
            ['name' => 'Volkswagen Golf', 'seating_capacity' => 4, 'color' => 'Gris', 'image_url' => 'https://example.com/images/volkswagen_golf.jpg', 'price_per_km' => 0.30],
        ]);
    }
}
