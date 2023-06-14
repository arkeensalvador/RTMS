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
            $table->timestamp('created_at');
            $table->string('programID')->unique();
            $table->string('agencyID');
            $table->string('fundingAgencyID');
            $table->string('researcherID');
            $table->string('fund_code');
            $table->text('program_title');
            $table->string('program_status');
            $table->string('category');
            $table->string('funding_agency');
            $table->string('coordination_fund');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('extend_date');
            $table->string('program_leader');
            $table->string('assistant_leader');
            $table->text('program_description');
            $table->string('approved_budget');
            $table->string('amount_released');
            $table->string('budget_year');
            $table->string('form_of_development');
            $table->timestamp('edited_at')->useCurrent();
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
