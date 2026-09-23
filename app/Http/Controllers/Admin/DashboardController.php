<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\HeroSlide;
use App\Models\JobPosting;
use App\Models\News;
use App\Models\Project;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'projects' => Project::count(),
            'projects_published' => Project::published()->count(),
            'gallery' => GalleryImage::count(),
            'news' => News::count(),
            'news_published' => News::visible()->count(),
            'jobs_active' => JobPosting::active()->count(),
            'team' => TeamMember::published()->count(),
            'testimonials' => Testimonial::published()->count(),
            'hero_slides' => HeroSlide::published()->count(),
        ];

        $latestNews = News::latest('created_at')->take(5)->get();
        $latestProjects = Project::latest('created_at')->take(5)->get();
        $latestJobs = JobPosting::active()->latest('created_at')->take(4)->get();

        $projectCountries = Project::published()
            ->get(['country'])
            ->groupBy(fn (Project $project) => $project->country ?: 'Non renseigné')
            ->map(fn ($projects) => $projects->count())
            ->sortDesc()
            ->take(6);

        $newsByMonth = News::query()
            ->whereNotNull('published_at')
            ->where('published_at', '>=', now()->subMonths(5)->startOfMonth())
            ->get(['published_at'])
            ->groupBy(fn (News $article) => $article->published_at->format('Y-m'))
            ->map(fn ($articles) => $articles->count());

        $newsTimeline = collect(range(5, 0))->map(function (int $monthsAgo) use ($newsByMonth) {
            $date = now()->startOfMonth()->subMonths($monthsAgo);
            $key = $date->format('Y-m');

            return [
                'label' => $date->translatedFormat('M'),
                'count' => $newsByMonth->get($key, 0),
            ];
        });

        $newsChartMax = max($newsTimeline->max('count'), 1);
        $countryChartMax = max($projectCountries->max(), 1);

        $contentHealth = [
            ['label' => 'Projets publiés', 'value' => $stats['projects_published'], 'total' => max($stats['projects'], 1), 'tone' => 'green'],
            ['label' => 'Actualités visibles', 'value' => $stats['news_published'], 'total' => max($stats['news'], 1), 'tone' => 'clay'],
            ['label' => 'Slides actives', 'value' => $stats['hero_slides'], 'total' => max(HeroSlide::count(), 1), 'tone' => 'ink'],
        ];

        return view('admin.dashboard', compact(
            'stats',
            'latestNews',
            'latestProjects',
            'latestJobs',
            'projectCountries',
            'countryChartMax',
            'newsTimeline',
            'newsChartMax',
            'contentHealth',
        ));
    }
}
