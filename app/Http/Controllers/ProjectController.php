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
    public function index(): View
    {
    // Fetch projects from the database.
    // We use with('user') to prevent the N+1 problem by eager-loading the user data.
    // We use latest() to show the newest projects first.
    // We use paginate() to automatically handle pagination.
    $projects = \App\Models\Project::with('user')->latest()->paginate(10);

    return view('discovery', [
        'projects' => $projects,
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
    public function show(string $id)
    {
        //
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
