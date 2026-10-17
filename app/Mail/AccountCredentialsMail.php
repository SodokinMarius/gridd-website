<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Envoie à un utilisateur ses identifiants provisoires, à la création de son compte
 * ou après une réinitialisation de son mot de passe par un administrateur.
 */
class AccountCredentialsMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public string $temporaryPassword,
        public bool $isNewAccount = true,
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->isNewAccount
                ? 'Votre accès à l’espace d’administration GRIDD'
                : 'Votre mot de passe GRIDD a été réinitialisé',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.account-credentials',
            text: 'emails.account-credentials-text',
            with: [
                // L'email dans le lien permet de détecter une session ouverte avec un autre compte.
                'loginUrl' => route('admin.login', ['email' => $this->user->email]),
                'roleLabel' => $this->user->isAdmin() ? 'Administrateur' : 'Éditeur de contenu',
            ],
        );
    }
}
