<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use App\Models\Application;

use Illuminate\Support\Carbon; 
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke(Request $request): View
    {
        $user = auth()->user();

        // Query for the main project feed (this part is the same)
        $projects = Project::with('user')->withCount(['comments', 'likers'])->latest()->paginate(5);

        // --- START: New Query for Recommended Users ---

        // 1. Get the IDs of users the current user is already following.
        $followingIds = $user->following()->pluck('users.id');

        // 2. Add the current user's own ID to the list to exclude themselves.
        $excludeIds = $followingIds->push($user->id);

        // 3. Fetch up to 5 random users, excluding the IDs from our list.
        $recommendedUsers = User::whereNotIn('id', $excludeIds)
                                ->inRandomOrder()
                                ->take(5)
                                ->get();

            //  Query for Accepted Projects & Pending---
        $acceptedProjects = $user->acceptedProjects()
                         ->wherePivot('status', 'accepted')
                         ->with('user') 
                         ->latest('pivot_updated_at') 
                         ->get();
        $pendingProjects = $user->pendingProjects()->with('user')->get();

        //  incoming applicants for the user's own projects
        $myProjectIds = $user->projects()->pluck('id');
        $incomingApplicants = Application::whereIn('project_id', $myProjectIds)
                                               ->where('status', 'pending')
                                               ->with('user', 'project') 
                                               ->latest()
                                               ->get()
                                               ->groupBy('project.title');
                                               
        $upcomingEvents = $user->acceptedProjects()
                                ->wherePivot('status', 'accepted')
                                ->whereNotNull('schedule_details')
                                ->latest('pivot_updated_at')
                                ->take(3)
                                ->get();

        $likedProjectIds = auth()->check() ? auth()->user()->likedProjects()->pluck('projects.id')->toArray() : [];

        return view('home', [
            'projects' => $projects,
            'recommendedUsers' => $recommendedUsers,
            'acceptedProjects' => $acceptedProjects,
            'pendingProjects' => $pendingProjects,
            'incomingApplicants' => $incomingApplicants,
            'upcomingEvents' => $upcomingEvents,
            'likedProjectIds' => $likedProjectIds,
        ]);
    }
}