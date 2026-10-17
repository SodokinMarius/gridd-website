<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Oblige l'utilisateur à choisir son propre mot de passe lorsque celui-ci
 * a été défini par un administrateur (création du compte ou réinitialisation).
 */
class EnsurePasswordIsChanged
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()?->must_change_password && ! $request->routeIs('admin.password.*', 'admin.logout')) {
            return redirect()->route('admin.password.edit');
        }

        return $next($request);
    }
}
