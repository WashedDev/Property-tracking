<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');           // e.g., "Company Car"
            $table->string('model');          // e.g., "Toyota Corolla"
            $table->integer('quantity')->default(1);
            $table->string('type');           // e.g., "Vehicle" or "Electronics"
            $table->string('serial_number')->nullable();
            $table->string('license_plate')->nullable(); // Only for cars
            $table->string('status')->default('Pending Acknowledgment'); // Force acknowledgment workflow
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
