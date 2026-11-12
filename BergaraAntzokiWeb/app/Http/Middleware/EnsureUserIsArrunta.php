<?php

namespace App\Http\Middleware;

use App\Enums\Rola;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsArrunta
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Erabiltzaile arruntek bakarrik erosi ditzakete sarrerak (adminek ez).
        if (! $request->user() || $request->user()->rola !== Rola::Arrunta->value) {
            abort(403, 'Administratzaileek ezin dute sarrerarik erosi.');
        }
        return $next($request);
    }
}
