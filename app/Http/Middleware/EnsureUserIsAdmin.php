<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Restreint l'accès à certaines pages du back-office au rôle Administrateur
     * (par exemple la gestion des utilisateurs). Les Éditeurs gardent l'accès
     * aux modules de contenu (via le middleware "auth" seul).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isAdmin()) {
            abort(403, "Accès réservé aux administrateurs.");
        }

        return $next($request);
    }
}
