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
        Schema::create('strategic_activities', function (Blueprint $table) {
            $table->id();
            $table->string('strategic_program');
            $table->string('strategic_title');
            $table->string('strategic_start');
            $table->string('strategic_end');
            $table->string('strategic_researcher');
            $table->string('strategic_implementing_agency');
            $table->string('strategic_funding_agency');
            $table->string('strategic_budget');
            $table->string('strategic_commodities');
            $table->string('strategic_consortium_role');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_activities');
    }
};
