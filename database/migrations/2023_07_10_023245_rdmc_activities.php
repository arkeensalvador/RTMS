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
        Schema::create('rdmc_activities', function (Blueprint $table) {
            $table->id();
            $table->string('donor');
            $table->string('activity_type');
            $table->longText('activity_title');
            $table->string('shared_amount');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdmc_activities');
    }
};
