<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CitiesTableSeeder extends Seeder
{
    public function run()
    {
        // Désactiver temporairement les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table 'routes'
        DB::table('cities')->truncate();
              
        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        DB::table('cities')->insert([
            ['name' => 'Paris'],
            ['name' => 'Marseille'],
            ['name' => 'Lyon'],
            ['name' => 'Toulouse'],
            ['name' => 'Nice'],
        ]);
    }
}