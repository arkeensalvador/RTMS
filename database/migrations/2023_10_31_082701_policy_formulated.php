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
        Schema::create('policy_formulated', function (Blueprint $table) {
            $table->id('id');
            $table->string('policy_type');
            $table->string('policy_agency');
            $table->string('policy_date');
            $table->string('policy_issues');
            $table->string('policy_resource');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policy_formulated');
    }
};
