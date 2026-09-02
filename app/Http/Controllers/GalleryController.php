<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('categorie');

        $images = GalleryImage::published()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->orderBy('order')
            ->paginate(24)
            ->withQueryString();

        $categories = GalleryImage::published()->distinct()->pluck('category')->filter()->sort()->values();

        return view('gallery.index', compact('images', 'categories', 'category'));
    }
}
