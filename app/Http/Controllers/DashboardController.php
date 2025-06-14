<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{

    public function __invoke(Request $request): View
    {
        $user = auth()->user();

        // Query for the main project feed (this part is the same)
        $projects = Project::with('user')->latest()->paginate(5);

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


        return view('home', [
            'projects' => $projects,
            'recommendedUsers' => $recommendedUsers,
        ]);
    }
}