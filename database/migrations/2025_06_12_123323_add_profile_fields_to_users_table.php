<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Splitting 'name' into first and last name after the 'id' column
        $table->string('first_name')->nullable()->after('id');
        $table->string('last_name')->nullable()->after('first_name');

        // Adding the other profile fields after the 'email' column
        $table->string('pronouns')->nullable()->after('email');
        $table->string('headline')->nullable()->after('pronouns');
        $table->string('location')->nullable()->after('headline');
        $table->text('about_me')->nullable()->after('location');
        $table->string('phone_number')->nullable()->after('about_me');
        $table->date('birthday')->nullable()->after('phone_number');
        $table->string('website_url')->nullable()->after('birthday');
        $table->string('avatar_path')->nullable()->after('website_url');
        $table->string('banner_path')->nullable()->after('avatar_path');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Define the columns to drop in an array
        $columnsToDrop = [
            'first_name', 'last_name', 'pronouns', 'headline', 
            'location', 'about_me', 'phone_number', 'birthday', 
            'website_url', 'avatar_path', 'banner_path'
        ];
        $table->dropColumn($columnsToDrop);
    });
}
};
