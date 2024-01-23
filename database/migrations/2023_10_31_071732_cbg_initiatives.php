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
        Schema::create('cbg_initiatives', function (Blueprint $table) {
            $table->id('id');
            $table->string('ini_initiates');
            $table->string('ini_agency')->nullable();
            $table->string('ini_date');
            $table->string('encoder_agency');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbg_initiatives');
    }
};
