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
            $table->string('agencyID')->nullable();
            $table->string('fundingAgencyID')->nullable();
            $table->string('researcherID')->nullable();
            $table->string('fund_code')->nullable();
            $table->text('program_title')->nullable();
            $table->string('program_status')->nullable();
            $table->string('program_category')->nullable();
            $table->string('funding_agency')->nullable();
            $table->string('coordination_fund')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('extend_date')->nullable();
            $table->string('program_leader')->nullable();
            $table->string('assistant_leader')->nullable();
            $table->text('program_description')->nullable();
            $table->string('approved_budget')->nullable();
            $table->string('amount_released')->nullable();
            $table->string('budget_year')->nullable();
            $table->string('form_of_development')->nullable();
            /* The line `// Schema::dropIfExists('agency');` is commented out, which means it is not being
            executed. */
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
    */
    public function down(): void
    {
        // Schema::dropIfExists('programs');
    }
};
