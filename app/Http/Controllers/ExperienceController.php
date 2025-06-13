<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse; 
use Illuminate\View\View;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // This method simply returns the view for our form
        return view('profile.experience-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate the incoming data from the form
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // 2. Create the new experience associated with the logged-in user
        $request->user()->experiences()->create($validated);

        // 3. Redirect back to the user's profile with a success message
        return redirect()->route('profile.show', auth()->user())->with('success', 'Experience added successfully!');
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
    public function edit(Experience $experience): View
    {
        // Security Check: Make sure the logged-in user owns this experience
        $this->authorize('update', $experience);

        // Return the partial view with the experience data
        return view('profile.experience-edit', ['experience' => $experience]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience): RedirectResponse
    {
        // Security Check
        $this->authorize('update', $experience);

        // Validation
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'organization' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        // Update the record
        $experience->update($validated);

        // Redirect back to the profile with a success message
        return redirect()->route('profile.show', auth()->user())->with('success', 'Experience updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        // Security: Make sure the logged-in user owns this experience
        if (auth()->user()->isNot($experience->user)) {
            abort(403);
        }

        $experience->delete();

        return redirect()->route('profile.show', auth()->user())->with('success', 'Experience deleted successfully.');
    }
}
