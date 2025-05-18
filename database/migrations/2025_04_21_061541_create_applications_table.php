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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('type'); // FLAM, ON DUTY, etc.
            $table->string('application_id');
            $table->string('applicant_name');
            $table->string('gender');
            $table->string('contact');
            $table->string('designation')->nullable();

            $table->string('department_id')->nullable();
            $table->string('department_approval')->nullable();

            $table->string('location')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
