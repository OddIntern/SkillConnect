<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'organization_name',
        'description',
        'skills_required',
        'status',
        'schedule_details',
        'location_address',
        'start_datetime',
        'end_datetime',
        'volunteers_needed',
    ];

    /**
     * Get the user that owns the project.
     */
    public function user() // The method name 'user' is by convention
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}