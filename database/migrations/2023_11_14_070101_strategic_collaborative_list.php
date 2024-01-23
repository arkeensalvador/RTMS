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
        Schema::create('strategic_collaborative_list', function (Blueprint $table) {
            $table->id('id');
            $table->string('str_collab_type');
            $table->string('str_collab_program')->nullable();
            $table->string('str_collab_project');
            $table->string('str_collab_imp_agency');
            $table->string('str_collab_agency');
            $table->string('str_collab_date');
            $table->string('str_collab_budget');
            $table->string('str_collab_sof');
            $table->longText('str_collab_roc');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_collaborative_list');
    }
};
