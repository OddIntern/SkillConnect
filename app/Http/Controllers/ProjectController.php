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

        $recommendedProjects = collect(); // Start with an empty collection

        // Only run this logic if a user is logged in and has skills on their profile
        if (auth()->check() && auth()->user()->skills->isNotEmpty()) {
            $userSkills = auth()->user()->skills->pluck('name');

            $recommendedProjects = Project::query()
                ->where('user_id', '!=', auth()->id()) // Exclude the user's own projects
                ->where(function ($query) use ($userSkills) {
                    foreach ($userSkills as $skill) {
                        // Find projects where the skills_required text contains one of the user's skills
                        $query->orWhere('skills_required', 'like', '%' . $skill . '%');
                    }
                })
                ->inRandomOrder() // Show a random selection of matched projects
                ->take(3) 
                ->get();
        }

        return view('discovery', [
            'projects' => $projects,
            'recommendedProjects' => $recommendedProjects, // Pass the new data to the view
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
}
