<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


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
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['sometimes', 'required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'pronouns' => 'nullable|string|max:50',
            'headline' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'about_me' => 'nullable|string',
            'website_url' => 'nullable|url|max:255',
            'skills' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Max 5MB
        ]);

        if ($request->hasFile('avatar')) {
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            $validatedData['avatar_path'] = $request->file('avatar')->store('avatars', 'public');
        }


        if ($request->hasFile('banner')) {
            if ($user->banner_path) {
                Storage::disk('public')->delete($user->banner_path);
            }
            $validatedData['banner_path'] = $request->file('banner')->store('banners', 'public');
        }

        $emailChanged = array_key_exists('email', $validatedData) && $validatedData['email'] !== $user->email;

        $user->fill(\Illuminate\Support\Arr::except($validatedData, ['skills', 'avatar', 'banner']));
        if ($emailChanged) {
            $user->email_verified_at = null;
        }
        $user->name = $validatedData['first_name'] . ' ' . $validatedData['last_name'];
        $user->save();

        $skillIds = [];
        if ($request->filled('skills')) {
            $skillNames = explode(',', $request->input('skills'));

            foreach ($skillNames as $skillName) {
                $trimmedName = trim($skillName);
                if ($trimmedName) {
                    $skill = Skill::firstOrCreate(
                        ['slug' => Str::slug($trimmedName)],
                        ['name' => $trimmedName]
                    );
                    $skillIds[] = $skill->id;
                }
            }
        }

        $user->skills()->sync($skillIds);

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
