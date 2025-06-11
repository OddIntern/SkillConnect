<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable // Or your base User class
{
    use HasFactory, Notifiable; // Add any other traits your User model uses

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // Add any other fillable attributes your User model might have
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected function casts(): array // For Laravel 10+
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // If you are on an older Laravel version, the casts property might look like:
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];


    /**
     * Get the projects for the user.
     */
    public function projects() // The method name 'projects' (plural) is by convention
    {
        return $this->hasMany(Project::class);
    }
}