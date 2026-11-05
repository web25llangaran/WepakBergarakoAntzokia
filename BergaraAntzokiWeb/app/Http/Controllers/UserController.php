<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Erabiltzaile berria sortzeko formularioa erakutsi.
     */
    public function create(): View
    {
        return view('admin.erabiltzaileak.create', ['rolak' => Rola::cases()]);
    }

    /**
     * Erabiltzaile berria datu-basean gorde.
     * Pasahitza modeloko 'hashed' cast-ak zifratzen du automatikoki.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        User::create([
            ...$request->validated(),
            'alta_data' => now(),
        ]);

        return $this->erabiltzaileetaraBideratu('Erabiltzailea ondo sortu da!');
    }

    /**
     * Erabiltzaile baten xehetasunak eta erositako sarrerak erakutsi.
     */
    public function show(User $erabiltzailea): View
    {
        $erabiltzailea->load(['erositako_sarrerak.ekitaldia.aretoa', 'erositako_sarrerak.eserlekua']);

        return view('admin.erabiltzaileak.show', compact('erabiltzailea'));
    }

    /**
     * Erabiltzaile bat editatzeko formularioa erakutsi.
     */
    public function edit(User $erabiltzailea): View
    {
        return view('admin.erabiltzaileak.edit', compact('erabiltzailea'));
    }

    /**
     * Erabiltzaile baten datuak eguneratu.
     * Pasahitza hutsik uzten bada, zaharra mantentzen da. Rola ezin da aldatu (ez dago validated()-en).
     */
    public function update(UpdateUserRequest $request, User $erabiltzailea): RedirectResponse
    {
        $datuak = $request->validated();

        if (blank($datuak['password'] ?? null)) {
            unset($datuak['password']);
        }

        $erabiltzailea->update($datuak);

        return $this->erabiltzaileetaraBideratu('Erabiltzailea ondo eguneratu da!');
    }

    /**
     * Erabiltzaile bat ezabatu (bere sarrerak ere ezabatzen dira, cascadeOnDelete).
     * Administratzaileak ezin du bere burua ezabatu.
     */
    public function destroy(Request $request, User $erabiltzailea): RedirectResponse
    {
        if ($erabiltzailea->is($request->user())) {
            return redirect()->to(route('admin.dashboard').'#erabiltzaileak')
                ->with('error', 'Ezin duzu zure erabiltzailea ezabatu.');
        }

        $erabiltzailea->delete();

        return $this->erabiltzaileetaraBideratu('Erabiltzailea ondo ezabatu da!');
    }

    /**
     * Admin dashboard-eko erabiltzaileen fitxara bideratu, flash mezu batekin.
     */
    private function erabiltzaileetaraBideratu(string $mezua): RedirectResponse
    {
        return redirect()->to(route('admin.dashboard').'#erabiltzaileak')
            ->with('success', $mezua);
    }
}
