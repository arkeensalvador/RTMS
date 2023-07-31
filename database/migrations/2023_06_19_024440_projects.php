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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('programID')->nullable();
            // $table->string('projectID')->nullable();
            $table->string('agencyID')->nullable();
            $table->string('project_fund_code')->nullable();
            $table->string('project_category')->nullable();
            $table->string('project_status')->nullable();
            $table->string('project_agency')->nullable();
            $table->string('project_funding_duration')->nullable();
            $table->string('project_funding_years')->nullable();
            $table->text('project_title')->nullable();
            $table->string('project_leader')->nullable();
            $table->string('project_assistant_leader')->nullable();
            $table->string('project_start_date')->nullable();
            $table->string('project_end_date')->nullable();
            $table->string('project_extend_date')->nullable();
            $table->text('project_description')->nullable();
            $table->string('project_approved_budget')->nullable();
            $table->string('project_amount_released')->nullable();
            $table->string('project_budget_year')->nullable();
            $table->string('project_form_of_development')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('projects');
    }
};
