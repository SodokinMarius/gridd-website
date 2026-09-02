<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $country = $request->query('pays');

        $projects = Project::published()
            ->country($country)
            ->with('coverImage')
            ->latest('year')
            ->paginate(9)
            ->withQueryString();

        $countries = Project::published()->distinct()->pluck('country')->sort()->values();

        return view('projects.index', compact('projects', 'countries', 'country'));
    }

    public function show(Project $project): View
    {
        abort_unless($project->is_published, 404);

        $project->load('images');

        return view('projects.show', compact('project'));
    }
}
