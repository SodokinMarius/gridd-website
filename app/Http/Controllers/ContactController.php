<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        // Champ piège invisible : les robots le remplissent, pas les humains.
        if (filled($request->input('website'))) {
            return back()->with('status', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        try {
            Mail::to(config('mail.contact_recipient'))->send(new ContactMessageMail($data));
        } catch (Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('contact_error', "Votre message n'a pas pu être envoyé pour le moment. Veuillez réessayer plus tard ou nous écrire directement à contact@gridd-cs.com.");
        }

        return back()->with('status', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
