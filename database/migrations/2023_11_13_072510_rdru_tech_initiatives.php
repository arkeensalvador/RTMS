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
        Schema::create('rdru_tech_initiatives', function (Blueprint $table) {
            $table->id('id');
            $table->string('rdru_tech_ini_title');
            $table->string('rdru_tech_ini_type');
            $table->string('rdru_tech_ini_status');
            $table->string('rdru_tech_ini_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdru_tech_initiatives');
    }
};