<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        // Désactiver temporairement les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table 'routes'
        DB::table('reservations')->truncate();
              
        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('reservations')->insert([
            ['user_id' => 1, 'route_id' => 1, 'car_id' => 1, 'departure_datetime' => '2024-11-15 08:00:00', 'arrival_datetime' => '2024-11-15 15:30:00', 'additional_info' => 'Voiture de type économique', 'session_id' => 'session_1', 'payment_status' => 'unpaid', 'price' => 150.00],
            ['user_id' => 2, 'route_id' => 2, 'car_id' => 3, 'departure_datetime' => '2024-11-16 09:00:00', 'arrival_datetime' => '2024-11-16 13:30:00', 'additional_info' => 'Réservation de dernière minute', 'session_id' => 'session_2', 'payment_status' => 'paid', 'price' => 250.00],
            ['user_id' => 3, 'route_id' => 3, 'car_id' => 2, 'departure_datetime' => '2024-11-17 10:00:00', 'arrival_datetime' => '2024-11-17 15:00:00', 'additional_info' => 'Trajet relaxant', 'session_id' => 'session_3', 'payment_status' => 'pending', 'price' => 140.00],
            ['user_id' => 4, 'route_id' => 4, 'car_id' => 4, 'departure_datetime' => '2024-11-18 11:00:00', 'arrival_datetime' => '2024-11-18 16:00:00', 'additional_info' => 'Pour un voyage professionnel', 'session_id' => 'session_4', 'payment_status' => 'unpaid', 'price' => 300.00],
            ['user_id' => 5, 'route_id' => 5, 'car_id' => 5, 'departure_datetime' => '2024-11-19 07:30:00', 'arrival_datetime' => '2024-11-19 12:30:00', 'additional_info' => 'Voiture pour une visite familiale', 'session_id' => 'session_5', 'payment_status' => 'paid', 'price' => 200.00],
        ]);
    }
}