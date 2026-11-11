<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
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
    public function store(Request $request): RedirectResponse
    {
        Sarrera::create($this->sarreraBalidatu($request));

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
    public function update(Request $request, Sarrera $sarrera): RedirectResponse
    {
        $sarrera->update($this->sarreraBalidatu($request, $sarrera));

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
     * Sarrera baten datuak balidatu (sortzeko eta editatzeko).
     * Editatzean, $sarrera pasatzen da unique arauak bere eserlekua ignora dezan.
     *
     * @return array{id_user: int, id_ekitaldia: int, id_eserlekua: int, prezioa: string}
     */
    private function sarreraBalidatu(Request $request, ?Sarrera $sarrera = null): array
    {
        $datuak = $request->validate([
            'id_user' => ['required', 'integer', Rule::exists('users', 'id')],
            'id_ekitaldia' => ['required', 'integer', Rule::exists('ekitaldiak', 'id')],
            'id_eserlekua' => [
                'required',
                'integer',
                Rule::exists('eserlekuak', 'id'),
                // Eserleku bera ezin da bi aldiz saldu ekitaldi berean.
                Rule::unique('sarrerak', 'id_eserlekua')
                    ->where('id_ekitaldia', $request->integer('id_ekitaldia'))
                    ->ignore($sarrera),
            ],
            'prezioa' => ['required', 'numeric', 'decimal:0,2', 'min:0', 'max:999999.99'],
        ], [
            'id_user.required' => 'Erabiltzailea aukeratu behar da.',
            'id_user.exists' => 'Aukeratutako erabiltzailea ez da existitzen.',
            'id_ekitaldia.required' => 'Ekitaldia aukeratu behar da.',
            'id_ekitaldia.exists' => 'Aukeratutako ekitaldia ez da existitzen.',
            'id_eserlekua.required' => 'Eserlekua aukeratu behar da.',
            'id_eserlekua.exists' => 'Aukeratutako eserlekua ez da existitzen.',
            'id_eserlekua.unique' => 'Eserleku hau dagoeneko salduta dago ekitaldi honetarako.',
            'prezioa.required' => 'Prezioa derrigorrezkoa da.',
            'prezioa.numeric' => 'Prezioak zenbaki bat izan behar du.',
            'prezioa.decimal' => 'Prezioak gehienez 2 hamartar izan ditzake.',
            'prezioa.min' => 'Prezioa ezin da negatiboa izan.',
            'prezioa.max' => 'Prezioa handiegia da.',
        ]);

        // Eserlekua ekitaldiaren aretokoa dela egiaztatu.
        $ekitaldia = Ekitaldia::find($datuak['id_ekitaldia']);
        $eserlekua = Eserlekua::find($datuak['id_eserlekua']);

        if ($ekitaldia->id_aretoa !== $eserlekua->id_aretoa) {
            throw ValidationException::withMessages([
                'id_eserlekua' => 'Eserlekua ez dago ekitaldiaren aretoan.',
            ]);
        }

        return $datuak;
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
