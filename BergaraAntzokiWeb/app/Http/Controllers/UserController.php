<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Erabiltzaile berria sortzeko formularioa erakutsi.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Erabiltzaile berria datu-basean gorde.
     */
    public function store(Request $request)
    {
        User::create($this->userBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo sortu da!');
    }

    /**
     * Erabiltzaile baten xehetasunak erakutsi.
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Erabiltzaile bat editatzeko formularioa erakutsi.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Erabiltzaile baten datuak eguneratu.
     */
    public function update(Request $request, User $user)
    {
        $user->update($this->userBalidatu($request, $user));

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo eguneratu da!');
    }

    /**
     * Erabiltzaile bat ezabatu.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')->with('success', 'Erabiltzailea, ondo ezabatu da!');
    }

    /**
     * Erabiltzaile baten datuak balidatu (sortzeko eta editatzeko).
     * Editatzean, $user pasatzen da unique arauek bere datuak ignora ditzaten,
     * eta pasahitza hutsik badago uneko pasahitza mantentzen da.
     *
     * @return array{user_izena: string, izena: string, abizena: string, email: string, nan: ?string, rola: string, alta_data: string, baja_data: ?string, password?: string}
     */
    private function userBalidatu(Request $request, ?User $user = null)
    {
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
