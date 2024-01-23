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
        Schema::create('cbg_equipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('equipments_type');
            $table->string('equipments_name');
            $table->string('equipments_total');
            $table->string('equipments_sof');
            $table->string('equipments_agency');
            $table->longText('equipments_details');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cbg_equipments');
    }
};
