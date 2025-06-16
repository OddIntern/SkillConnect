<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        'is_remote',
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

    public function scopeFilter(Builder $query, array $filters): void
    {
        // Filter by text search (title or description)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        // Filter by multiple categories (from checkboxes)
        $query->when($filters['categories'] ?? false, function ($query, $categories) {
            $query->whereIn('status', $categories);
        });

        // Filter by skills (simple text search)
        $query->when($filters['skills'] ?? false, function ($query, $skill) {
            $query->where('skills_required', 'like', '%' . $skill . '%');
        });

        // Filter by Location Type (In-person vs. Virtual)
        $query->when($filters['location_type'] ?? false, function ($query, $type) {
            if ($type === 'virtual') {
                $query->where('is_remote', true);
            } elseif ($type === 'in-person') {
                $query->where('is_remote', false);
            }
        });
    }


    public function scopeSort(Builder $query, ?string $sortBy): void
    {
        $query->when($sortBy === 'urgent', function ($query) {
            // This puts projects with 'Urgent' status first, then sorts by newest
            $query->orderByRaw("CASE WHEN status = 'Urgent' THEN 1 ELSE 2 END, created_at DESC");
        })->when($sortBy === 'oldest', function ($query) {
            // Sort by oldest
            $query->orderBy('created_at', 'asc');
        }, function ($query) {
            // Default sort: newest first
            $query->latest();
        });
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function savers()
    {
        return $this->belongsToMany(User::class, 'project_saves')->withTimestamps();
    }

    public function likers()
{
    return $this->belongsToMany(User::class, 'project_likes')->withTimestamps();
}
}