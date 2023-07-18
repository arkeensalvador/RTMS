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
        Schema::create('rdmc_linkages', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('year');
            $table->string('form_of_development');
            $table->string('address');
            $table->string('nature_of_assistance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rdmc_linkages');
    }
};
