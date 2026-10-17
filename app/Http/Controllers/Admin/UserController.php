<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\AccountCredentialsMail;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;
use Throwable;

/**
 * Réservé au rôle Administrateur (voir middleware EnsureUserIsAdmin sur ces routes).
 */
class UserController extends Controller
{
    public function index(): View
    {
        $users = User::latest()->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::defaults()],
            'role' => ['required', 'in:admin,editor'],
        ]);

        $temporaryPassword = $data['password'];
        $data['password'] = Hash::make($data['password']);
        // Mot de passe provisoire : l'utilisateur choisira le sien à sa première connexion.
        $data['must_change_password'] = true;

        $user = User::create($data);

        $status = 'Utilisateur créé.';
        if ($request->boolean('send_credentials')) {
            $status .= $this->sendCredentials($user, $temporaryPassword, true);
        }

        return redirect()->route('admin.users.index')->with('status', $status);
    }

    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$user->id],
            'role' => ['required', 'in:admin,editor'],
            'password' => ['nullable', Password::defaults()],
        ]);

        $isOtherUser = $user->id !== $request->user()->id;
        $temporaryPassword = $data['password'] ?? null;

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
            // Réinitialisation par un administrateur : nouveau changement obligatoire
            // (sauf s'il modifie son propre compte).
            $data['must_change_password'] = $isOtherUser;
        } else {
            unset($data['password']);
        }

        $user->update($data);

        $status = 'Utilisateur mis à jour.';
        if ($temporaryPassword && $isOtherUser && $request->boolean('send_credentials')) {
            $status .= $this->sendCredentials($user, $temporaryPassword, false);
        }

        return redirect()->route('admin.users.index')->with('status', $status);
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        abort_if($user->id === $request->user()->id, 403, 'Vous ne pouvez pas supprimer votre propre compte.');

        $user->delete();

        return back()->with('status', 'Utilisateur supprimé.');
    }

    /**
     * Envoie les identifiants provisoires par email et renvoie le complément du message de statut.
     */
    private function sendCredentials(User $user, string $temporaryPassword, bool $isNewAccount): string
    {
        try {
            Mail::to($user->email)->send(new AccountCredentialsMail($user, $temporaryPassword, $isNewAccount));
        } catch (Throwable $e) {
            report($e);

            return " L’email n’a pas pu être envoyé à {$user->email} : communiquez-lui le mot de passe provisoire vous-même.";
        }

        return " Ses identifiants lui ont été envoyés par email à {$user->email}.";
    }
}
