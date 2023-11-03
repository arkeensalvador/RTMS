<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cbg_meetings', function (Blueprint $table) {
            $table->id();
            $table->string('meeting_type');
            $table->string('meeting_venue');
            $table->string('meeting_date');
            $table->string('meeting_host');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // if (Schema::hasTable('cbg_meetings')) {
        //     DB::table('cbg_meetings')->truncate();
        // }
        Schema::dropIfExists('cbg_meetings');
    }
};
