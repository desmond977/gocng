<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('useds', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique(); // Unique email column
            $table->string('salutation')->nullable(); // Optional column
            $table->string('first_name')->nullable(); // Optional column
            $table->string('last_name')->nullable(); // Optional column
            $table->string('gender_c')->nullable(); // Optional column
            $table->string('phone_mobile')->nullable(); // Optional column
            $table->string('employment_status_c')->nullable(); // Optional column
            $table->string('state_c')->nullable(); // Optional column
            $table->string('vehicle_current_fuel_type_c')->nullable(); // Optional column
            $table->string('age_range_c')->nullable(); // Optional column
            $table->string('vehicle_make_c')->nullable(); // Optional column
            $table->string('year_of_manufacture_c')->nullable(); // Optional column
            $table->string('vehicle_registration_number_c')->nullable(); // Optional column
            $table->string('vehicle_vin_c')->nullable(); // Optional column
            $table->date('date_entered')->nullable(); // Optional column
            $table->string('workplace')->nullable(); // Optional column
            $table->string('engine')->nullable(); // Optional column
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('useds');
    }
};
