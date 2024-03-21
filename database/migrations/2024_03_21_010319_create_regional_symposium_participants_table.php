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
        Schema::create('regional_symposium_participants', function (Blueprint $table) {
            $table->id();
            $table->string('regional_id');
            $table->string('type_of_participants');
            $table->string('no_of_participants');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regional_symposium_participants');
    }
};
