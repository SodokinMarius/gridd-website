<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        // Envoi de l'email vers l'adresse professionnelle de GRIDD.
        // Créez resources/views/emails/contact.blade.php et un Mailable ContactMessageMail
        // si vous souhaitez un template plus riche. Ici on utilise Mail::raw pour rester simple.
        Mail::raw(
            "Nouveau message de contact\n\n"
            ."Nom : {$data['name']}\n"
            ."Email : {$data['email']}\n"
            ."Téléphone : ".($data['phone'] ?? '-')."\n"
            ."Sujet : {$data['subject']}\n\n"
            ."Message :\n{$data['message']}",
            function ($message) use ($data) {
                $message->to(config('mail.from.address'))
                    ->subject('Nouveau message de contact — '.$data['subject'])
                    ->replyTo($data['email'], $data['name']);
            }
        );

        return back()->with('status', 'Votre message a bien été envoyé. Nous vous répondrons dans les meilleurs délais.');
    }
}
