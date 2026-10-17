<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

/**
 * Changement de mot de passe par l'utilisateur connecté (admin ou éditeur).
 */
class PasswordController extends Controller
{
    public function edit(): View
    {
        return view('admin.password.edit');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'regex:/[A-Za-z]/', 'regex:/[0-9]/', 'confirmed', 'different:current_password'],
        ], [
            'current_password.required' => 'Saisissez votre mot de passe actuel.',
            'current_password.current_password' => 'Le mot de passe actuel est incorrect.',
            'password.required' => 'Saisissez un nouveau mot de passe.',
            'password.min' => 'Le nouveau mot de passe doit contenir au moins 8 caractères.',
            'password.regex' => 'Le nouveau mot de passe doit contenir au moins une lettre et un chiffre.',
            'password.confirmed' => 'La confirmation ne correspond pas au nouveau mot de passe.',
            'password.different' => 'Le nouveau mot de passe doit être différent de l’actuel.',
        ]);

        $user = $request->user();
        $user->forceFill([
            'password' => Hash::make($request->input('password')),
            'must_change_password' => false,
        ])->save();

        // Déconnecte les autres sessions ouvertes avec l'ancien mot de passe.
        Auth::logoutOtherDevices($request->input('password'));
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('status', 'Votre mot de passe a été modifié.');
    }
}
