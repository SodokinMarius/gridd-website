<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    public function index(): View
    {
        $jobs = JobPosting::active()->latest()->paginate(9);

        return view('jobs.index', compact('jobs'));
    }

    public function show(JobPosting $job): View
    {
        abort_unless($job->is_published, 404);

        return view('jobs.show', compact('job'));
    }
}
