<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $project->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->comment,
        ]);

        return redirect()->route('comments.show', $project)->with('success', 'Comment added!');
    }
}

