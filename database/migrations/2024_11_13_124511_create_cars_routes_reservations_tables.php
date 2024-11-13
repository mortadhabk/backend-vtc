<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsRoutesReservationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Création de la table `cities`
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        // Création de la table `cars`
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('seating_capacity')->default(4);
            $table->string('color', 20)->nullable();
            $table->string('image_url')->nullable();
            $table->decimal('price_per_km', 5, 2)->nullable();
            $table->timestamps();
        });

        // Création de la table `routes` (trajets)
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('departure_city_id');
            $table->unsignedBigInteger('arrival_city_id');
            $table->foreign('departure_city_id')->references('id')->on('cities');
            $table->foreign('arrival_city_id')->references('id')->on('cities');
            $table->decimal('distance_km', 6, 2)->nullable();
            $table->time('duration')->nullable();
            $table->timestamps();
        });

        // Création de la table `reservations`
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            // Informations sur l'utilisateur
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // Référence au trajet (route)
            $table->unsignedBigInteger('route_id');
            $table->foreign('route_id')->references('id')->on('routes');
            // Informations liées à la voiture
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id')->references('id')->on('cars');
            // Détails sur la réservation
            $table->dateTime('departure_datetime');
            $table->dateTime('arrival_datetime')->nullable();
            $table->text('additional_info')->nullable();
            $table->string('session_id', 100);
            $table->enum('payment_status', ['unpaid', 'paid', 'pending'])->default('unpaid');
            $table->decimal('price', 10, 2)->nullable();
            // Timestamps pour gérer création et mise à jour
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('routes');
        Schema::dropIfExists('cars');
        Schema::dropIfExists('cities');
    }
}
