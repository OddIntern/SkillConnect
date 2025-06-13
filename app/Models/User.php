<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


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
        'first_name', // New
        'last_name',  // New
        'email',
        'password',
        'pronouns',   // New
        'headline',   // New
        'location',   // New
        'about_me',   // New
        'phone_number',// New
        'birthday',    // New
        'website_url', // New
        'avatar_path', // New
        'banner_path', // New
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
    /**
     * The skills that the user has.
     */
    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }

        /**
     * The conversations that the user participates in.
     */
    public function conversations(): BelongsToMany
    {
        return $this->belongsToMany(Conversation::class, 'conversation_user');
    }

        /**
     * Find a one-on-one conversation with another user.
     */
    public function findConversationWith(User $otherUser)
    {
        return $this->conversations()
            ->whereHas('participants', function ($query) use ($otherUser) {
                $query->where('user_id', $otherUser->id);
            })
            ->whereHas('participants', null, '=', 2) // Ensures it's a 1-on-1 chat
            ->first();
    }
}