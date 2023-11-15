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
        Schema::create('strategic_program_list', function (Blueprint $table) {
            $table->id('id');
            $table->string('str_p_type');
            $table->string('str_p_title');
            $table->string('str_p_researchers');
            $table->string('str_p_imp_agency');
            $table->string('str_p_collab_agency');
            $table->string('str_p_date');
            $table->string('str_p_budget');
            $table->string('str_p_sof');
            // $table->string('str_p_roc');
            $table->string('str_p_regional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_program_list');
    }
};
