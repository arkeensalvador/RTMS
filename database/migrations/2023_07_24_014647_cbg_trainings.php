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
        Schema::create('cbg_trainings', function (Blueprint $table) {
            $table->id();
            $table->string('trainings_sof');
            $table->string('trainings_agency');
            $table->string('trainings_title');
            $table->string('trainings_expenditures');
            $table->string('trainings_start');
            $table->string('trainings_end')->nullable();
            $table->string('trainings_no_participants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbg_trainings');
    }
};
