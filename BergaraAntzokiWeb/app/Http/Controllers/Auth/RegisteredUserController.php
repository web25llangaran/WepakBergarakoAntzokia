<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

// Controlador de registro (viene de Breeze, pero lo adaptamos a nuestra tabla users).
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    // Recibe el formulario de registro del popup: valida los datos, crea el usuario, inicia sesión y redirige.
    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // Taula aldatu dugunez, balidazioa ere aldatuko da:
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_izena' => ['required', 'string', 'max:20', 'unique:users'],
            'izena' => ['required', 'string', 'max:50'],
            'abizena' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'nan' => ['nullable', 'string', 'size:9', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Creamos el usuario con nuestros campos (contraseña cifrada, fecha de alta = hoy y rol normal).
        $user = User::create([
            // Taula aldatu denez erabiltzailearen sortzeko funtzioa ere aldatu behar da.
            // 'name' => $request->name,
            // 'email' => $request->email,
            // 'password' => Hash::make($request->password),
            'user_izena' => $request->user_izena,
            'izena' => $request->izena,
            'abizena' => $request->abizena,
            'email' => $request->email,
            'nan' => $request->nan,
            'password' => Hash::make($request->password),
            'alta_data' => now(),
            'rola' => 'arrunta', // erabiltzailea defectuz arrunta izango da.
        ]);

        // Lanzamos el evento de "usuario registrado" e iniciamos sesión automáticamente con el nuevo usuario.
        event(new Registered($user));

        Auth::login($user);

        // Popup-ak gordetako orrira joan (adib. eserlekuak aukeratzekoa); bestela hasierako orrira.
        return redirect()->intended(route('welcome', absolute: false));
    }
}
