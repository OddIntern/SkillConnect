<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
public function up(): void
{
    Schema::table('projects', function (Blueprint $table) {
        // Add the new column right after the title for neatness
        $table->string('organization_name')->nullable()->after('title');
    });
}

public function down(): void
{
    Schema::table('projects', function (Blueprint $table) {
        $table->dropColumn('organization_name');
    });
}
};
