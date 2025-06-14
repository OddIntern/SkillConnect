<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function __invoke(): View
    {
        $featuredProjects = Project::latest()->take(3)->get();

        return view('welcome', [
            'projects' => $featuredProjects,
        ]);
    }
}