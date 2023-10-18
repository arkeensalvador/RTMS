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
            $table->string('project_fund_code');
            $table->string('project_category');
            $table->string('project_status');
            $table->string('project_agency');
            $table->string('project_implementing_agency');
            $table->string('project_funding_duration');
            $table->string('project_funding_years');
            $table->text('project_title');
            $table->string('project_leader');
            $table->string('project_assistant_leader');
            $table->string('project_start_date');
            $table->string('project_end_date');
            $table->string('project_extend_date')->nullable();
            $table->text('project_description');
            $table->string('project_approved_budget');
            $table->string('project_amount_released');
            $table->string('project_budget_year');
            $table->string('project_form_of_development');
            $table->string('keywords');
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
