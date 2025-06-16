<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Comment;


class CommentController extends Controller
{
    public function store(Request $request, Project $project): RedirectResponse
    {

        $validated = $request->validate([
            'content' => 'required|string|max:2500',
        ]);

        // This part correctly creates the related comment.
        // It automatically sets the project_id.
        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'], 
        ]);

        // This will now work correctly.
        return back()->with('success', 'Comment posted successfully!');
    }
}

