<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\News;
use App\Models\Partner;
use App\Models\Project;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $heroSlides = HeroSlide::published()->ordered()->get();
        $projects = Project::published()->with('coverImage')->latest()->take(3)->get();
        $news = News::visible()->latest('published_at')->take(3)->get();
        $testimonials = Testimonial::published()->ordered()->take(3)->get();
        $partners = Partner::published()->ordered()->get();

        return view('home', compact('heroSlides', 'projects', 'news', 'testimonials', 'partners'));
    }
}
