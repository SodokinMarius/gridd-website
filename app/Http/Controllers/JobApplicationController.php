<?php

namespace App\Http\Controllers;

use App\Models\JobPosting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class JobApplicationController extends Controller
{
    public function create(JobPosting $job): View
    {
        abort_unless($job->is_published && ! $job->isExpired(), 404);

        return view('jobs.apply', compact('job'));
    }

    public function store(Request $request, JobPosting $job): RedirectResponse
    {
        abort_unless($job->is_published && ! $job->isExpired(), 404);

        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'cover_letter' => ['nullable', 'string', 'max:5000'],
            'cv' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $cvPath = $request->file('cv')->store('applications', 'public');

        $fullName = trim("{$data['first_name']} {$data['last_name']}");

        Mail::raw(
            "Nouvelle candidature — {$job->title}\n\n"
            ."Nom : {$fullName}\n"
            ."Email : {$data['email']}\n"
            ."Téléphone : {$data['phone']}\n"
            ."Poste : {$job->title}\n\n"
            ."Lettre de motivation :\n".($data['cover_letter'] ?? '(non renseignée)')."\n\n"
            ."CV joint : storage/app/public/{$cvPath}",
            function ($message) use ($data, $job, $fullName, $request) {
                $message->to(config('mail.from.address'))
                    ->subject("Candidature — {$job->title} — {$fullName}")
                    ->replyTo($data['email'], $fullName)
                    ->attach($request->file('cv')->getRealPath(), [
                        'as' => $request->file('cv')->getClientOriginalName(),
                    ]);
            }
        );

        return redirect()
            ->route('jobs.show', $job)
            ->with('status', 'Votre candidature a bien été envoyée. Nous vous contacterons si votre profil correspond à nos besoins.');
    }
}
