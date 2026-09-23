<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        $news = News::with('images')->latest()->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create(): View
    {
        return view('admin.news.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request, true);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $news = News::create($data);
        $this->storeImages($request, $news);

        return redirect()->route('admin.news.index')->with('status', 'Actualité créée.');
    }

    public function edit(News $news): View
    {
        $news->load('images');

        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $data = $this->validateData($request, ! $news->cover_image);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['title'] !== $news->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $news->id);
        }

        if ($request->hasFile('cover_image')) {
            if ($news->cover_image) {
                Storage::disk('public')->delete($news->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('news', 'public');
        }

        $news->update($data);
        $this->storeImages($request, $news);

        return redirect()->route('admin.news.index')->with('status', 'Actualité mise à jour.');
    }

    public function destroyImage(NewsImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('status', 'Image supprimée.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if ($news->cover_image) {
            Storage::disk('public')->delete($news->cover_image);
        }

        foreach ($news->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $news->delete();

        return back()->with('status', 'Actualité supprimée.');
    }

    private function validateData(Request $request, bool $coverRequired = false): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'cover_image' => [$coverRequired ? 'required' : 'nullable', 'image', 'max:4096'],
            'images' => ['nullable', 'array', 'max:12'],
            'images.*' => ['image', 'max:4096'],
        ]);
    }

    private function storeImages(Request $request, News $news): void
    {
        $nextOrder = ((int) $news->images()->max('order')) + 1;

        foreach ($request->file('images', []) as $image) {
            $news->images()->create([
                'path' => $image->store('news/gallery', 'public'),
                'order' => $nextOrder++,
            ]);
        }
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (News::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
