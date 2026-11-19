<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

// Controlador del CRUD de usuarios para el administrador: crear, ver, editar y borrar usuarios.
class UserController extends Controller
{
    // Muestra el formulario para crear un usuario.
    /**
     * Erabiltzaile berria sortzeko formularioa erakutsi.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    // Valida los datos, crea el usuario y vuelve al panel (pestaña usuarios).
    /**
     * Erabiltzaile berria datu-basean gorde.
     */
    public function store(Request $request)
    {
        User::create($this->userBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo sortu da!');
    }

    // Muestra el detalle de un usuario.
    /**
     * Erabiltzaile baten xehetasunak erakutsi.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    // Muestra el formulario para editar un usuario.
    /**
     * Erabiltzaile bat editatzeko formularioa erakutsi.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    // Valida y actualiza los datos del usuario.
    /**
     * Erabiltzaile baten datuak eguneratu.
     */
    public function update(Request $request, User $user)
    {
        $user->update($this->userBalidatu($request, $user));

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo eguneratu da!');
    }

    // Borra el usuario.
    /**
     * Erabiltzaile bat ezabatu.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo ezabatu da!');
    }

    // Función de validación reutilizable para crear y editar usuarios.
    /**
     * Erabiltzaile baten datuak balidatu (sortzeko eta editatzeko).
     * Editatzean, $user pasatzen da unique arauek bere datuak ignora ditzaten,
     * eta pasahitza hutsik badago uneko pasahitza mantentzen da.
     *
     * @return array{user_izena: string, izena: string, abizena: string, email: string, nan: ?string, rola: string, alta_data: string, baja_data: ?string, password?: string}
     */
    private function userBalidatu(Request $request, ?User $user = null)
    {
        // Reglas: nombre de usuario, email y DNI únicos, rol válido, fechas correctas y contraseña (obligatoria solo al crear).
        $datuak = $request->validate([
            'user_izena' => ['required', 'string', 'max:255', Rule::unique('users', 'user_izena')->ignore($user)],
            'izena' => 'required|string|max:255',
            'abizena' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user)],
            'nan' => ['nullable', 'string', 'size:9', Rule::unique('users', 'nan')->ignore($user)],
            'rola' => ['required', Rule::enum(Rola::class)],
            'alta_data' => 'required|date',
            'baja_data' => 'nullable|date|after_or_equal:alta_data',
            'password' => [$user ? 'nullable' : 'required', 'confirmed', Password::defaults()],
        // Mensajes de error en euskera.
        ], [
            'user_izena.required' => 'Erabiltzaile izena derrigorrezkoa da.',
            'user_izena.unique' => 'Erabiltzaile izen hori dagoeneko erabilita dago.',
            'izena.required' => 'Izena derrigorrezkoa da.',
            'abizena.required' => 'Abizena derrigorrezkoa da.',
            'email.required' => 'Emaila derrigorrezkoa da.',
            'email.email' => 'Emailak email zuzena izan behar du.',
            'email.unique' => 'Email hori dagoeneko erabilita dago.',
            'nan.size' => 'NAN-ak 9 karaktere izan behar ditu.',
            'nan.unique' => 'NAN hori dagoeneko erabilita dago.',
            'rola.required' => 'Rola aukeratu behar da.',
            'rola.enum' => 'Aukeratutako rola ez da zuzena.',
            'alta_data.required' => 'Alta data derrigorrezkoa da.',
            'alta_data.date' => 'Alta datak data zuzena izan behar du.',
            'baja_data.date' => 'Baja datak data zuzena izan behar du.',
            'baja_data.after_or_equal' => 'Baja datak ezin du alta data baino lehenagokoa izan.',
            'password.required' => 'Pasahitza derrigorrezkoa da.',
            'password.confirmed' => 'Pasahitzak ez datoz bat.',
        ]);

        // Editatzean pasahitza hutsik utzi bada, uneko pasahitza mantendu.
        if (empty($datuak['password'])) {
            unset($datuak['password']);
        }

        return $datuak;
    }
}
