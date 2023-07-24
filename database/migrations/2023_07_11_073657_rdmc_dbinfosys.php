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
        Schema::create('rdmc_dbinfosys', function (Blueprint $table) {
            $table->id();
            $table->string('dbinfosys_category');
            $table->string('dbinfosys_type');
            $table->string('dbinfosys_title');
            $table->string('dbinfosys_date_created');
            $table->string('dbinfosys_purpose');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('rdmc_dbinfosys');
    }
};
