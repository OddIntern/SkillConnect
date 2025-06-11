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
        Schema::table('projects', function (Blueprint $table) {
            // 1. Make the existing datetime columns optional (nullable)
            $table->dateTime('start_datetime')->nullable()->change();
            $table->dateTime('end_datetime')->nullable()->change();

            // 2. Add a new column for the flexible schedule description
            // We'll place it after the end_datetime column for neatness.
            $table->string('schedule_details')->nullable()->after('end_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // Revert the changes if we ever need to undo this migration
            $table->dropColumn('schedule_details');
            
            // Note: Reverting a ->nullable() change is complex and often not necessary.
            // For safety, we'll leave them nullable if rolled back.
        });
    }
};