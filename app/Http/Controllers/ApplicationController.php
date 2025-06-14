<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function update(Request $request, Application $application)
    {
        // Pastikan hanya owner project yang bisa update
        if ($application->project->user_id !== auth()->id()) {
            abort(403);
        }

        // Validasi status
        $validated = $request->validate([
            'status' => 'required|in:accepted,declined',
        ]);

        // Update status
        $application->status = $validated['status'];
        $application->save();

        return back()->with('success', 'Application status updated.');
    }
}
