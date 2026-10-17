<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(Request $request): View|RedirectResponse
    {
        $email = $request->query('email');
        $user = $request->user();

        if ($user) {
            // Déjà connecté avec le bon compte (ou sans précision) : direction le tableau de bord.
            if (! $email || strcasecmp($email, $user->email) === 0) {
                return redirect()->route('admin.dashboard');
            }

            // Lien destiné à un autre compte : on propose de fermer la session en cours.
            return view('admin.auth.login', ['email' => $email, 'connectedUser' => $user]);
        }

        return view('admin.auth.login', ['email' => $email, 'connectedUser' => null]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'email' => 'Identifiants incorrects.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Changement de compte depuis la page de connexion : on garde l'email prérempli.
        $email = $request->input('switch_to');

        return redirect()->route('admin.login', filter_var($email, FILTER_VALIDATE_EMAIL) ? ['email' => $email] : []);
    }
}
