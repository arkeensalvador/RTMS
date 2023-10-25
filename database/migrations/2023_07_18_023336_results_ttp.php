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
        Schema::create('results_ttp', function (Blueprint $table) {
            $table->id();
            $table->string('ttp_type');
            $table->string('ttp_title');
            $table->string('ttp_budget');
            $table->string('ttp_sof');
            $table->string('ttp_proponent');
            $table->string('ttp_researchers');
            $table->string('ttp_start_date');
            $table->string('ttp_end_date');
            $table->string('ttp_priorities');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results_ttp');
    }
};
