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
            // $table->string('trust_fund_code');
            $table->string('agencyID');
            $table->string('program_title');
            $table->text('description');
            // $table->string('funding_agency');
            // $table->string('funding_agency_abbrev');
            // $table->string('approved_budget');
            // $table->string('amount_of_release');
            // $table->string('check_num');
            // $table->string('or_num');
            // $table->string('or_date');
            // $table->date('program_start_date');
            // $table->date('program_end_date');
            // $table->date('program_extension_date');
            // $table->string('memo_agreement_copy');
            // $table->string('line_item_budget_copy');
            // $table->string('notice_to_proceed_copy');
            // $table->string('no_of_publications');
            // $table->string('tech_generated');
            // $table->string('tech_adaptor');
            // $table->string('patent');
            // $table->string('terminal_report');
            // $table->string('scholarship_grant');
            // $table->string('financial_analyst_incharge');
            // $table->string('status');
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
