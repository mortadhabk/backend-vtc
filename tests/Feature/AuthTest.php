<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

uses(RefreshDatabase::class);

// Seed roles before each test
beforeEach(function () {
    // Seed roles if not already seeded
    Role::firstOrCreate(['name' => 'Super Admin']);
    Role::firstOrCreate(['name' => 'Admin']);
    Role::firstOrCreate(['name' => 'User']);
});


// Registration Tests
it('can register a new user with valid data', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'password123',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName',
    ]);  

    $response->assertStatus(201)
             ->assertJson(['success' => true]);

    // Verify that the user was created in the database
    $this->assertDatabaseHas('users', ['email' => 'johndoe@example.com']);
});

it('fails to register when required fields are missing', function () {
    $response = $this->postJson('/api/register', [
        'email' => 'invalid-email',  // Invalid email format
    ]);

    $response->assertStatus(422)
             ->assertJson([
                 'success' => false,
                 'message' => 'Validation errors',
             ]);
});

it('fails to register when password confirmation does not match', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'mismatched_password',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName',
    ]);

    $response->assertStatus(422);
});

it('fails to register when user already exists', function () {
    // Register the user for the first time
    $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'password123',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName'
    ])->assertStatus(201);

    // Attempt to register the same user again
    $response = $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'password123',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName'
    ]);

    $response->assertStatus(422);
});

// Login Tests
it('can login with valid credentials', function () {
    // Register a new user
    $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'password123',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName'
    ])->assertStatus(201);

    // Attempt to log in with the registered credentials
    $response = $this->postJson('/api/login', [
        'email' => 'johndoe@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
             ->assertJsonStructure([
                 'success',
                 'data' => [
                     'access_token',
                     'user' => [
                         'id', 'name', 'email', 'address', 'postal_code', 'phone', 'country', 'city', 'role'
                     ]
                 ],
                 'message'
             ]);
});

it('fails to login with invalid credentials', function () {
    // Register a new user
    $this->postJson('/api/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
        'c_password' => 'password123',
        'address' => '123 Main St',
        'postal_code' => '12345',
        'phone' => '123-456-7890',
        'country' => 'CountryName',
        'city' => 'CityName'
    ])->assertStatus(201);

    // Attempt to log in with incorrect password
    $response = $this->postJson('/api/login', [
        'email' => 'johndoe@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertStatus(401)
             ->assertJson([
                 'success' => false,
                 'message' => 'The provided credentials are incorrect.'
             ]);
});

it('fails to login when the user does not exist', function () {
    // Attempt to log in with an unregistered email
    $response = $this->postJson('/api/login', [
        'email' => 'nonexistent@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(401)
             ->assertJson([
                 'success' => false,
                 'message' => 'The provided credentials are incorrect.'
             ]);
});
