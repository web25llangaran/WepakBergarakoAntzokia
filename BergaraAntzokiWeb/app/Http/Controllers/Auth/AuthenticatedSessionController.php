<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

// Controlador de inicio y cierre de sesión (viene de Breeze; cambiamos a dónde redirige).
class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    // Recibe el formulario de login del popup: comprueba email y contraseña e inicia sesión.
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Vuelve a la página guardada por el popup (ej. elegir butacas); si no hay ninguna, va a la página de inicio.
        return redirect()->intended(route('welcome', absolute: false));
    }

    // Cierra la sesión: desloguea al usuario, invalida la sesión, regenera el token CSRF y vuelve al inicio.
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
