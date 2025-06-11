<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        // Fetch the latest projects, with their associated user, and paginate the results.
        $projects = Project::with('user')->latest()->paginate(5); 

        return view('home', [
            'projects' => $projects,
        ]);
    }
}