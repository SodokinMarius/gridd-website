<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        $slides = HeroSlide::ordered()->paginate(15);

        return view('admin.hero.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.hero.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $data['is_published'] = $request->boolean('is_published');
        $data['image'] = $request->file('image')->store('hero', 'public');

        HeroSlide::create($data);

        return redirect()->route('admin.hero.index')->with('status', 'Slide ajoutée.');
    }

    public function edit(HeroSlide $hero): View
    {
        return view('admin.hero.edit', ['slide' => $hero]);
    }

    public function update(Request $request, HeroSlide $hero): RedirectResponse
    {
        $data = $this->validateData($request, false);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('image')) {
            if ($hero->image) {
                Storage::disk('public')->delete($hero->image);
            }
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $hero->update($data);

        return redirect()->route('admin.hero.index')->with('status', 'Slide mise à jour.');
    }

    public function destroy(HeroSlide $hero): RedirectResponse
    {
        if ($hero->image) {
            Storage::disk('public')->delete($hero->image);
        }
        $hero->delete();

        return back()->with('status', 'Slide supprimée.');
    }

    private function validateData(Request $request, bool $imageRequired = true): array
    {
        return $request->validate([
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:1000'],
            'button_text' => ['nullable', 'string', 'max:100'],
            'button_url' => ['nullable', 'string', 'max:255'],
            'order' => ['nullable', 'integer', 'min:0'],
            'image' => [$imageRequired ? 'required' : 'nullable', 'image', 'max:5120'],
        ]);
    }
}
