<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::visible()->with('images')->latest('published_at')->paginate(9);

        return view('news.index', compact('news'));
    }

    public function show(News $news): View
    {
        abort_unless($news->is_published && (!$news->published_at || $news->published_at <= now()), 404);
        $news->load('images');

        $related = News::visible()->where('id', '!=', $news->id)->latest('published_at')->take(3)->get();

        return view('news.show', compact('news', 'related'));
    }
}
