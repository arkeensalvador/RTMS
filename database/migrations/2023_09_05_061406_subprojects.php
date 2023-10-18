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
        Schema::create('sub_projects', function (Blueprint $table) {
            $table->id();
            $table->string('programID')->nullable();
            $table->string('projectID');
            $table->string('sub_project_fund_code');
            $table->string('sub_project_category');
            $table->string('sub_project_status');
            $table->string('sub_project_agency');
            $table->string('sub_project_implementing_agency');
            $table->string('sub_project_funding_duration');
            $table->string('sub_project_funding_years');
            $table->text('sub_project_title');
            $table->string('sub_project_leader');
            $table->string('sub_project_assistant_leader');
            $table->string('sub_project_start_date');
            $table->string('sub_project_end_date');
            $table->string('sub_project_extend_date')->nullable();
            $table->text('sub_project_description');
            $table->string('sub_project_approved_budget');
            $table->string('sub_project_amount_released');
            $table->string('sub_project_budget_year');
            $table->string('sub_project_form_of_development');
            $table->string('keywords');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_projects');
    }
};
