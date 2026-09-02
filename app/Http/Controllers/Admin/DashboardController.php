<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use App\Models\News;
use App\Models\Project;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'news' => News::count(),
            'jobs_active' => JobPosting::active()->count(),
            'news_published' => News::visible()->count(),
        ];

        $latestNews = News::latest()->take(5)->get();
        $latestProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestNews', 'latestProjects'));
    }
}
