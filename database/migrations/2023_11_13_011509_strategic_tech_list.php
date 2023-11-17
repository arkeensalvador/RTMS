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
        Schema::create('strategic_tech_list', function (Blueprint $table) {
            $table->id('id');
            $table->string('tech_type');
            $table->string('tech_title');
            $table->string('tech_desc');
            $table->string('tech_source');
            $table->string('tech_agency');
            $table->string('tech_researchers');
            $table->longText('tech_impact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('strategic_tech_list');
    }
};
