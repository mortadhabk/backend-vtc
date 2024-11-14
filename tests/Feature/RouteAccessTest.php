<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

beforeEach(function () {
    // Seed roles if not already seeded
    Role::firstOrCreate(['name' => 'Super Admin']);
    Role::firstOrCreate(['name' => 'Admin']);
    Role::firstOrCreate(['name' => 'User']);
});

function createUserWithRole(string $role): User {
    $user = User::factory()->create();
    $user->assignRole($role);
    return $user;
}

it('allows Super Admin to access super-admin-dashboard', function () {
    $user = createUserWithRole('Super Admin');
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/super-admin-dashboard');
    $response->assertStatus(200); // Adjust to expected status code
});

it('denies Admin access to super-admin-dashboard', function () {
    $user = createUserWithRole('Admin');
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/super-admin-dashboard');
    $response->assertStatus(403); // Adjust to expected status code
});

it('denies User access to super-admin-dashboard', function () {
    $user = createUserWithRole('User');
    Sanctum::actingAs($user);

    $response = $this->getJson('/api/super-admin-dashboard');
    $response->assertStatus(403); // Adjust to expected status code
});

it('denies unauthenticated access to super-admin-dashboard', function () {
    $response = $this->getJson('/api/super-admin-dashboard');
    $response->assertStatus(401); // Adjust to expected status code
});
