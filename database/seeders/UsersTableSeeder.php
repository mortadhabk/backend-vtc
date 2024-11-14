<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver temporairement les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Vider la table 'routes'
        DB::table('users')->truncate();

        // Réactiver les vérifications des clés étrangères
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            ['name' => 'Mortadha Boubaker', 'email' => 'mortadhaboubaker12@gmail.com', 'password' => bcrypt('12022000$')],
            ['name' => 'Bob', 'email' => 'bob@example.com', 'password' => bcrypt('password')],
            ['name' => 'Charlie', 'email' => 'charlie@example.com', 'password' => bcrypt('password')],
            ['name' => 'David', 'email' => 'david@example.com', 'password' => bcrypt('password')],
            ['name' => 'Eve', 'email' => 'eve@example.com', 'password' => bcrypt('password')],
        ]);
    }
}
