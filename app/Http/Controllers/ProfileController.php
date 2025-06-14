<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Str;


class ProfileController extends Controller
{

    /**
     * Display the user's public profile.
     */
    public function show(User $user): View
    {
        // Get the total counts first
        $followerCount = $user->followers()->count();
        $followingCount = $user->following()->count();
        

        // Eager load the relationships we need for the profile page
        $user->load([
            'projects.applications.user',
            'projects', 
            // We'll just load a preview of up to 8 users for each list
            'followers' => function ($query) {
                $query->take(8);
            }, 
            'following' => function ($query) {
                $query->take(8);
            }
        ]);

        $acceptedProjects = $user->applications()
            ->where('status', 'accepted')
            ->with('project')
            ->get()
            ->pluck('project')
            ->filter();

        return view('profile.show', [
            'user' => $user,
            'followerCount' => $followerCount,
            'followingCount' => $followingCount,
            'acceptedProjects' => $user->acceptedProjects,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        // 1. Authorization: Ensure the logged-in user is editing their OWN profile
        if (auth()->user()->isNot($user)) {
            abort(403); // Forbidden
        }

        // 2. Validation: Define the rules for the incoming data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'pronouns' => 'nullable|string|max:50',
            'headline' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
            'website_url' => 'nullable|url|max:255',
            'skills' => 'nullable|string',
        ]);

        // 3. Update User's Main Fields
        $user->update(\Illuminate\Support\Arr::except($validatedData, ['skills']));
        $user->name = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $user->save();

        // 4. Process and Sync Skills (This is the critical part)
        $skillIds = [];
        // Check if the 'skills' input was provided and is not empty
        if ($request->filled('skills')) {
            // Split the comma-separated string into an array
            $skillNames = explode(',', $request->input('skills'));

            foreach ($skillNames as $skillName) {
                // Clean up each skill name
                $trimmedName = trim($skillName);
                if ($trimmedName) { // Ensure it's not an empty string after trimming
                    // Find the skill by its name or create it if it doesn't exist
                    $skill = Skill::firstOrCreate(
                        ['slug' => Str::slug($trimmedName)],
                        ['name' => $trimmedName]
                    );
                    // Collect the ID of the skill
                    $skillIds[] = $skill->id;
                }
            }
        }

        // 5. Sync the collected IDs with the user's skills relationship
        // This command adds, removes, and updates the connections in the skill_user pivot table.
        $user->skills()->sync($skillIds);

        // 6. Redirect Back
        return redirect()->route('profile.show', $user)->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }



}
