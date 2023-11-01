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
        Schema::create('results_tpa', function (Blueprint $table) {
            $table->id();
            $table->string('tpa_title');
            $table->string('tpa_date');
            $table->string('tpa_details');
            $table->string('tpa_remarks');
            $table->string('tpa_approaches');
            $table->string('is_others')->nullable();
            $table->string('tpa_activity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results_tpa');
    }
};
