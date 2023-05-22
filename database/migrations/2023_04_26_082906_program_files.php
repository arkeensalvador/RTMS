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
        Schema::create('program_files', function (Blueprint $table) {
            $table->id();
            $table->boolean('memo_agreement_copy')->default('0')->nullable();
            $table->boolean('line_item_budget_copy')->default('0')->nullable();
            $table->boolean('notice_to_proceed_copy')->default('0')->nullable();
            $table->string('terminal_report')->default('0')->nullable();;
            $table->string('file_name')->nullable();
            $table->string('path')->nullable();
            $table->string('datetime')->nullable();
            $table->string('programID');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_files');
    }
};
