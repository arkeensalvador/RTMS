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
        Schema::create('program_details', function (Blueprint $table) {
            $table->id();
            $table->string('budget')->nullable();
            $table->string('amount_release')->nullable();
            // $table->string('check_no')->nullable();
            // $table->string('or_no')->nullable();
            // $table->string('or_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('extend_date')->nullable();
            $table->string('status')->nullable();
            $table->string('programID');   
            $table->timestamp('edited_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('program_details');
    }
};
