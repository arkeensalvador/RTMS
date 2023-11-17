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
        Schema::create('rdmc_regional', function (Blueprint $table) {
            $table->id('id');
            $table->string('regional_category');
            $table->string('regional_title');
            $table->string('regional_implementing_agency');
            $table->string('regional_researchers');
            $table->longText('regional_recommendations');
            $table->string('regional_winners');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdmc_regional');
    }
};
