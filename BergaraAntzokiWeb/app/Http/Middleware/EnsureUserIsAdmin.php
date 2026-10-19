<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        if (! $request->user() || ! $request->user()->rola === 'admin') {
            abort(403, 'Ez duzu baimenik orri hau ikusteko.');
        }
        return $next($request);
    }
}
