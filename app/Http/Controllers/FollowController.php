<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class FollowController extends Controller
{
        /**
     * Follow or unfollow the given user.
     */
    public function toggle(User $user): RedirectResponse
    {
        $follower = auth()->user();

        // Prevent users from following themselves
        if ($follower->id === $user->id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        // Use the toggle() method to attach or detach the relationship
        $follower->following()->toggle($user->id);

        // Redirect the user back to the page they came from
        return back()->with('success', 'Follow status updated!');
    }
}
