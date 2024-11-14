<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Create roles
                Role::create(['name' => 'Super Admin']);
                Role::create(['name' => 'Admin']);
                Role::create(['name' => 'User']);
                // Assign "Super Admin" role to a specific user
                $user = User::where('email','mortadhaboubaker12@gmail.com'); // Find the user with this email
                $user->assignRole('Super Admin');

                // Assign "Admin" role to another user
                $user = User::find(2);
                $user->assignRole('Admin');

                // Assign "User" role to another user
                $user = User::find(3);
                $user->assignRole('User');
    }
}
