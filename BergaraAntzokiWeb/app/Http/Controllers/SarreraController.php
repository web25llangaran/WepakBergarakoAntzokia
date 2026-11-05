<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Http\Requests\StoreSarreraRequest;
use App\Http\Requests\UpdateSarreraRequest;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class SarreraController extends Controller
{
    /**
     * Sarrera berria sortzeko formularioa erakutsi.
     */
    public function create(): View
    {
        return view('admin.sarrerak.create', $this->formularioarenDatuak());
    }

    /**
     * Sarrera berria datu-basean gorde.
     */
    public function store(StoreSarreraRequest $request): RedirectResponse
    {
        Sarrera::create($request->validated());

        return $this->sarreretaraBideratu('Sarrera ondo sortu da!');
    }

    /**
     * Sarrera baten xehetasunak erakutsi.
     */
    public function show(Sarrera $sarrera): View
    {
        $sarrera->load(['ekitaldia.aretoa', 'eserlekua', 'eroslea']);

        return view('admin.sarrerak.show', compact('sarrera'));
    }

    /**
     * Sarrera bat editatzeko formularioa erakutsi.
     */
    public function edit(Sarrera $sarrera): View
    {
        return view('admin.sarrerak.edit', [
            'sarrera' => $sarrera,
            ...$this->formularioarenDatuak(),
        ]);
    }

    /**
     * Sarrera baten datuak eguneratu.
     */
    public function update(UpdateSarreraRequest $request, Sarrera $sarrera): RedirectResponse
    {
        $sarrera->update($request->validated());

        return $this->sarreretaraBideratu('Sarrera ondo eguneratu da!');
    }

    /**
     * Sarrera bat ezabatu.
     */
    public function destroy(Sarrera $sarrera): RedirectResponse
    {
        $sarrera->delete();

        return $this->sarreretaraBideratu('Sarrera ondo ezabatu da!');
    }

    /**
     * Sortu eta editatu formularioek behar dituzten zerrendak.
     *
     * @return array{erabiltzaileak: Collection<int, User>, ekitaldiak: Collection<int, Ekitaldia>, eserlekuak: Collection<int, Eserlekua>, saldutakoEserlekuak: Collection<int, Collection<int, int>>}
     */
    private function formularioarenDatuak(): array
    {
        return [
            'erabiltzaileak' => User::where('rola', Rola::Arrunta->value)->orderBy('user_izena')->get(),
            'ekitaldiak' => Ekitaldia::with('aretoa')->orderBy('data')->get(),
            'eserlekuak' => Eserlekua::orderBy('id_aretoa')->orderBy('lerro_zenb')->orderBy('eserleku_zenb')->get(),
            // Ekitaldi bakoitzean dagoeneko saldutako eserlekuak: [id_ekitaldia => [id_eserlekua => id_sarrera]].
            'saldutakoEserlekuak' => Sarrera::get(['id', 'id_ekitaldia', 'id_eserlekua'])
                ->groupBy('id_ekitaldia')
                ->map(fn ($sarrerak) => $sarrerak->pluck('id', 'id_eserlekua')),
        ];
    }

    /**
     * Admin dashboard-eko sarreren fitxara bideratu, flash mezu batekin.
     */
    private function sarreretaraBideratu(string $mezua): RedirectResponse
    {
        return redirect()->to(route('admin.dashboard').'#sarrerak')
            ->with('success', $mezua);
    }
}
