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
        Schema::create('policy_prc', function (Blueprint $table) {
            $table->id('id');
            $table->string('prc_title');
            $table->string('prc_agency');
            $table->string('prc_author');
            $table->longText('prc_issues');
            $table->string('prc_date');
            $table->string('encoder_agency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_prc');
    }
};
