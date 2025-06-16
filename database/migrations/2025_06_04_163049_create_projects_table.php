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
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Creator
        $table->string('title');
        $table->text('description');
        $table->text('skills_required')->nullable();
        $table->string('status')->nullable(); // e.g., 'Urgent', 'Open', 'Upcoming'
        $table->text('location_address')->nullable(); // Simplified textual address
        $table->dateTime('start_datetime')->nullable();
        $table->dateTime('end_datetime')->nullable();
        $table->unsignedInteger('volunteers_needed')->nullable();
        $table->timestamps();
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::dropIfExists('projects');
}
};
