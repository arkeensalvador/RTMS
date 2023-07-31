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
        Schema::create('results_ttm', function (Blueprint $table) {
            $table->id();
            $table->string('ttm_title');
            $table->string('ttm_type');
            $table->string('ttm_status');
            $table->string('ttm_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results_ttm');
    }
};
