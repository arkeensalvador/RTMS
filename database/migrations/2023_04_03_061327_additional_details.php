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
        //
        Schema::create('additional_details', function (Blueprint $table) {
            $table->id();
            $table->string('no_of_publications');
            $table->string('tech_generated');
            $table->string('tech_adaptor');
            $table->string('patent');
            $table->string('scholarship_grant');
            $table->integer('programID');
            $table->timestamp('edited_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('additional_details');
    }
};
