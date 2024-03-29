<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_project_budget', function (Blueprint $table) {
            $table->id('id');
            $table->string('projectID');
            $table->string('sub_projectID');
            $table->string('approved_budget');
            $table->string('grant_type');
            $table->string('budget_year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_project_budget');
    }
};
