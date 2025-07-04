<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('follower_user', function (Blueprint $table) {
            // This composite key prevents a user from following the same person more than once
            $table->primary(['follower_id', 'following_id']);

            // The ID of the user who is doing the following
            $table->foreignId('follower_id')->constrained('users')->onDelete('cascade');

            // The ID of the user who is being followed
            $table->foreignId('following_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('follower_user_pivot');
    }
};
