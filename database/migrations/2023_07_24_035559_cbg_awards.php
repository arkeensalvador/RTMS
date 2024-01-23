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
        Schema::create('cbg_awards', function (Blueprint $table) {
            $table->id();
            $table->string('awards_type');
            $table->string('awards_agency');
            $table->string('awards_date');
            $table->string('awards_title');
            $table->string('awards_recipients');
            $table->string('awards_sponsor');
            $table->string('awards_event');
            $table->string('awards_place');
            $table->string('awards_ceremony');
            $table->string('certificate');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('cbg_awards');
    }
};
