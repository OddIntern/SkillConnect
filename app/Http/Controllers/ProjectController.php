<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
        */
    public function index(Request $request): View
    {
        // This is the existing query for the main list of projects
        $projects = Project::with('user')
            ->filter($request->only(['search', 'categories', 'skills', 'location_type']))
            ->sort($request->get('sort'))
            ->paginate(10)
            ->withQueryString();

        $recommendedProjects = collect();
        $savedProjectIds = [];
        $savedProjectsForSidebar = collect();

        // Only run this logic if a user is logged in
        if (auth()->check()) {
            $user = auth()->user();

                // --- NEW: Logic for the Save Feature ---
            $savedProjectIds = $user->savedProjects()->pluck('projects.id')->toArray();

            // Fetch the 5 most recently saved projects and include their author's data
            $savedProjectsForSidebar = $user->savedProjects()
                                            ->with('user') // Eager load the user for the "Posted by" info
                                            ->latest('project_saves.created_at')
                                            ->take(5)
                                            ->get();

                // --- Your existing recommendation logic ---
            if ($user->skills->isNotEmpty()) {
                $userSkills = $user->skills->pluck('name');

                $recommendedProjects = Project::query()
                    ->where('user_id', '!=', $user->id)
                    ->where(function ($query) use ($userSkills) {
                        foreach ($userSkills as $skill) {
                            $query->orWhere('skills_required', 'like', '%' . $skill . '%');
                        }
                    })
                    ->inRandomOrder()
                    ->take(3)
                    ->get();
                
                // NEW: Find which skill matched for each recommended project
                foreach ($recommendedProjects as $project) {
                    // Create an array of skills required by the project
                    $projectSkills = collect(explode(',', $project->skills_required))->map('trim');
                    
                    // Find the first skill that the user has and the project requires
                    $project->matched_skill = $userSkills->intersect($projectSkills)->first();
                }
            }
        }

        return view('discovery', [
            'projects' => $projects,
            'recommendedProjects' => $recommendedProjects,
            'savedProjectIds' => $savedProjectIds, 
            'savedProjectsForSidebar' => $savedProjectsForSidebar, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'organization_name' => 'nullable|string|max:255', // Validation for the new field
            'description' => 'required|string',
            'status' => 'required|string|max:100',
            'schedule_details' => 'required|string|max:255',
            'location_address' => 'required|string',
            'volunteers_needed' => 'required|integer|min:1',
            'skills_required' => 'nullable|string',
        ]);

        $request->user()->projects()->create([
            'title' => $validatedData['title'],
            'organization_name' => $validatedData['organization_name'], // Saving the new field
            'description' => $validatedData['description'],
            'status' => $validatedData['status'],
            'schedule_details' => $validatedData['schedule_details'],
            'location_address' => $validatedData['location_address'],
            'volunteers_needed' => $validatedData['volunteers_needed'],
            'skills_required' => $validatedData['skills_required'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Project created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        // Eager load the project's user and its comments with their users
        $project->load('user', 'comments.user');

        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function apply(Request $request, Project $project): RedirectResponse
    {
        // 1. Prevent users from applying to their own project (Important!)
        if ($project->user_id === auth()->id()) {
            return back()->with('error', 'You cannot apply to your own project.');
        }

        // 2.A clean check using the relationship and exists()
        if ($project->applications()->where('user_id', auth()->id())->exists()) {
            return back()->with('info', 'You have already applied for this project.');
        }

        
        $project->applications()->create([
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Your application has been submitted!');
    }



        /**
     * Toggles the saved state of a project for the authenticated user.
     */
    public function toggleSave(Request $request, Project $project)
    {
        $user = Auth::user();
        
        // The toggle() method is perfect for this.
        // It attaches if not attached, and detaches if already attached.
        $user->savedProjects()->toggle($project);

        // We check if the project is now in the saved list to return the current state
        $isSaved = $user->savedProjects()->where('project_id', $project->id)->exists();

        return response()->json([
            'success' => true,
            'is_saved' => $isSaved
        ]);
    }

}
