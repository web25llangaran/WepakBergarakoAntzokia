<?php

namespace App\Http\Middleware;

use App\Enums\Rola;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware (filtro de rutas): solo deja pasar a los usuarios con rol admin. Si no, error 403 (prohibido).
class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Si no hay sesión o el usuario no es admin, error 403
        if (! $request->user() || $request->user()->rola !== Rola::Admin->value) {
            abort(403, 'Ez duzu baimenik orri hau ikusteko.');
        }

        // Si es admin, la petición sigue su camino normal.
        return $next($request);
    }
}
