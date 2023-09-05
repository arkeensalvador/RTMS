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
            $table->string('projectID')->nullable();
            $table->string('sub_project_fund_code')->nullable();
            $table->string('sub_project_category')->nullable();
            $table->string('sub_project_status')->nullable();
            $table->string('sub_project_agency')->nullable();
            $table->string('sub_project_funding_duration')->nullable();
            $table->string('sub_project_funding_years')->nullable();
            $table->text('sub_project_title')->nullable();
            $table->string('sub_project_leader')->nullable();
            $table->string('sub_project_assistant_leader')->nullable();
            $table->string('sub_project_start_date')->nullable();
            $table->string('sub_project_end_date')->nullable();
            $table->string('sub_project_extend_date')->nullable();
            $table->text('sub_project_description')->nullable();
            $table->string('sub_project_approved_budget')->nullable();
            $table->string('sub_project_amount_released')->nullable();
            $table->string('sub_project_budget_year')->nullable();
            $table->string('sub_project_form_of_development')->nullable();
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
