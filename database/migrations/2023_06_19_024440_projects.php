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
            $table->timestamp('created_at');
            $table->string('programID')->nullable();
            // $table->string('projectID')->nullable();
            $table->string('agencyID')->nullable();
            $table->string('fund_code')->nullable();
            $table->string('category')->nullable();
            $table->string('project_status')->nullable();
            $table->string('agency')->nullable();
            $table->string('funding_duration')->nullable();
            $table->string('funding_years')->nullable();
            $table->text('project_title')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('extend_date')->nullable();
            $table->text('project_description')->nullable();
            $table->string('approved_budget')->nullable();
            $table->string('amount_released')->nullable();
            $table->string('budget_year')->nullable();
            $table->string('form_of_development')->nullable();
            $table->timestamp('edited_at')->useCurrent();
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
