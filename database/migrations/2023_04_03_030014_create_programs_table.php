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
        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('programID')->unique();
            $table->string('fund_code');
            $table->text('program_title');
            $table->string('program_status');
            $table->string('program_category');
            $table->string('funding_agency');
            $table->string('implementing_agency');
            $table->string('research_center');
            // $table->string('coordination_fund');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('extend_date')->nullable();
            $table->string('program_leader');
            $table->string('assistant_leader');
            $table->text('program_description');
            $table->string('approved_budget');
            $table->string('amount_released');
            $table->string('budget_year');
            $table->string('form_of_development');
            $table->string('keywords');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
