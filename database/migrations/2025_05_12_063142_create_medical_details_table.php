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
        Schema::create('medical_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');

            $table->enum('category', ['Patient', 'Attendant']);
            $table->enum('service', ['Govt', 'Non-Govt']);

            $table->string('name');
            $table->string('gender');
            $table->string('contact');

            // Only for Govt
            $table->string('designation')->nullable();
            $table->string('department_id')->nullable();

            $table->string('file_path')->nullable(); // File upload

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_details');
    }
};
