<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobPosting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class JobPostingController extends Controller
{
    public function index(): View
    {
        $jobs = JobPosting::latest()->paginate(15);

        return view('admin.jobs.index', compact('jobs'));
    }

    public function create(): View
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['slug'] = $this->uniqueSlug($data['title']);
        $data['is_published'] = $request->boolean('is_published');

        JobPosting::create($data);

        return redirect()->route('admin.jobs.index')->with('status', 'Offre publiée.');
    }

    public function edit(JobPosting $job): View
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, JobPosting $job): RedirectResponse
    {
        $data = $this->validateData($request, $job->id);
        $data['is_published'] = $request->boolean('is_published');

        if ($data['title'] !== $job->title) {
            $data['slug'] = $this->uniqueSlug($data['title'], $job->id);
        }

        $job->update($data);

        return redirect()->route('admin.jobs.index')->with('status', 'Offre mise à jour.');
    }

    public function destroy(JobPosting $job): RedirectResponse
    {
        $job->delete();

        return back()->with('status', 'Offre supprimée.');
    }

    private function validateData(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'contract_type' => ['nullable', 'string', 'max:100'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'deadline' => ['nullable', 'date'],
        ]);
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (JobPosting::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.(++$i);
        }

        return $slug;
    }
}
