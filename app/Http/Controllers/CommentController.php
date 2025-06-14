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
            'content' => 'required|string',
        ]);

        // This is the elegant way to create a related model.
        // It automatically sets the project_id for the comment.
        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        // The success message is now in English
        return back()->with('success', 'Comment posted successfully!');
    }
}

