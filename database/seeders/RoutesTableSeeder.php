<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class RoutesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Désactiver temporairement les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table 'routes'
        DB::table('routes')->truncate();

        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('routes')->insert([
            ['departure_city_id' => 1, 'arrival_city_id' => 2, 'distance_km' => 775.00, 'duration' => '07:30:00'],
            ['departure_city_id' => 1, 'arrival_city_id' => 3, 'distance_km' => 465.00, 'duration' => '04:30:00'],
            ['departure_city_id' => 2, 'arrival_city_id' => 4, 'distance_km' => 400.00, 'duration' => '04:00:00'],
            ['departure_city_id' => 3, 'arrival_city_id' => 5, 'distance_km' => 470.00, 'duration' => '05:00:00'],
            ['departure_city_id' => 4, 'arrival_city_id' => 2, 'distance_km' => 400.00, 'duration' => '04:00:00'],
        ]);
    }
}
