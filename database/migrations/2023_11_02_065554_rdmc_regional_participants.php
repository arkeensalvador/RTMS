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
        Schema::create("rdmc_regional_participants", function (Blueprint $table) {
            $table->id("id");
            $table->string("rp_type");
            $table->string("rp_agency");
            $table->string("rp_no");
            $table->string("rp_remarks");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
