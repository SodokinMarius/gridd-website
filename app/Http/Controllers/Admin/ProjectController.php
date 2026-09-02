<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::latest()->paginate(15);

        return view('admin.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('admin.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['is_published'] = $request->boolean('is_published');

        $data['slug'] = $this->uniqueSlug($data['title']);

        $project = Project::create($data);

        $this->storeImages($request, $project);

        return redirect()->route('admin.projects.index')->with('status', 'Projet créé avec succès.');
    }

    public function edit(Project $project): View
    {
        $project->load('images');

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $data = $this->validateData($request, $project->id);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['title'] !== $project->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $project->id);
        }

        $project->update($data);

        $this->storeImages($request, $project);

        return redirect()->route('admin.projects.index')->with('status', 'Projet mis à jour.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $project->delete();

        return back()->with('status', 'Projet supprimé.');
    }

    public function destroyImage(ProjectImage $image): RedirectResponse
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('status', 'Photo supprimée.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:100'],
            'client' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:2000', 'max:'.(date('Y') + 1)],
            'description' => ['nullable', 'string'],
            'is_published' => ['sometimes', 'boolean'],
            'photos.*' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    private function storeImages(Request $request, Project $project): void
    {
        if (! $request->hasFile('photos')) {
            return;
        }

        $order = $project->images()->max('order') ?? 0;

        foreach ($request->file('photos') as $photo) {
            $path = $photo->store('projects', 'public');
            $project->images()->create([
                'path' => $path,
                'order' => ++$order,
            ]);
        }
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (Project::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
