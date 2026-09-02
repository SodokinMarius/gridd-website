<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $images = GalleryImage::latest()->paginate(24);

        return view('admin.gallery.index', compact('images'));
    }

    public function create(): View
    {
        $projects = Project::orderBy('title')->get();

        return view('admin.gallery.create', compact('projects'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'photos' => ['required', 'array', 'min:1'],
            'photos.*' => ['image', 'max:4096'],
            'category' => ['nullable', 'string', 'max:100'],
            'project_id' => ['nullable', 'exists:projects,id'],
        ]);

        $order = GalleryImage::max('order') ?? 0;

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('gallery', 'public');
            GalleryImage::create([
                'path' => $path,
                'category' => $data['category'] ?? null,
                'project_id' => $data['project_id'] ?? null,
                'order' => ++$order,
                'is_published' => true,
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('status', 'Photos ajoutées à la galerie.');
    }

    public function update(Request $request, GalleryImage $image): RedirectResponse
    {
        $data = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
            'is_published' => ['sometimes', 'boolean'],
        ]);

        $data['is_published'] = $request->boolean('is_published');

        $image->update($data);

        return back()->with('status', 'Photo mise à jour.');
    }

    public function destroy(GalleryImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('status', 'Photo supprimée.');
    }
}
