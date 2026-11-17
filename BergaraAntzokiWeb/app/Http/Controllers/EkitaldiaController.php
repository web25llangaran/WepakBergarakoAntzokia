<?php

namespace App\Http\Controllers;

use App\Enums\EkitaldiMota;
use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EkitaldiaController extends Controller
{
    // Silver Economy sarrerak, sarrera arruntak baino zenbat euro merkeagoak diren.
    private const SILVER_ECONOMY_HOBARIA = 10.00;

    public function index()
    {
        $ekitaldiak = Ekitaldia::all(); // Datu basetik Ekitaldia taulako datu GUZTIAK hartzen ditugu.

        // echo $ekitaldiak;
        return view('welcome', ['ekitaldiak' => $ekitaldiak]); // "Ekitaldien zerrenda "Welcome" orrian sartzen ditugu, eta gainera, orria ikusi ahal izateko eskatzen dugu.
    }

    /**
     * Ekitaldi berria sortzeko formularioa erakutsi.
     */
    public function create()
    {
        $ekitaldiak = Ekitaldia::with('aretoa')->orderBy('data')->get();
        $aretoak = Aretoa::all();

        return view('admin.ekitaldiak.create', compact(['ekitaldiak', 'aretoak']));
    }

    /**
     * Ekitaldi berria datubasean gorde.
     */
    public function store(Request $request)
    {
        Ekitaldia::create($this->ekitaldiaBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo sortu da!');
    }

    /**
     * Sarrera baten xehetasunak erakutsi.
     */
    public function showAdmin(Ekitaldia $ekitaldia)
    {
        $ekitaldia->load(['aretoa', 'sarrerak']);

        return view('admin.ekitaldiak.show', compact('ekitaldia'));
    }

    /**
     * Sarrera bat editatzeko formularioa erakutsi.
     */
    public function edit(Ekitaldia $ekitaldia)
    {
        $aretoak = Aretoa::all();

        return view('admin.ekitaldiak.edit', compact(['ekitaldia', 'aretoak']));
    }

    /**
     * Sarrera baten datuak eguneratu.
     */
    public function update(Request $request, Ekitaldia $ekitaldia)
    {
        $ekitaldia->update($this->ekitaldiaBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo eguneratu da!');
    }

    /**
     * Sarrera bat ezabatu.
     */
    public function destroy(Ekitaldia $ekitaldia)
    {
        $ekitaldia->delete();

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo ezabatu da!');
    }

    /**
     * Ekitaldi baten datuak balidatu (sortzeko eta editatzeko) eta irudia gorde.
     *
     * @return array{izena: string, deskripzioa: ?string, ekitaldi_mota: string, id_aretoa: int, data: string, irudia?: string}
     */
    private function ekitaldiaBalidatu(Request $request): array
    {
        $datuak = $request->validate([
            'izena' => 'required|string|max:255',
            'deskripzioa' => 'nullable|string',
            'ekitaldi_mota' => ['required', Rule::enum(EkitaldiMota::class)],
            'id_aretoa' => 'required|exists:aretoak,id',
            'data' => 'required|date',
            'irudia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'izena.required' => 'Izena derrigorrezkoa da.',
            'izena.max' => 'Izenak gehienez 255 karaktere izan ditzake.',
            'ekitaldi_mota.required' => 'Mota aukeratu behar da.',
            'ekitaldi_mota.enum' => 'Aukeratutako mota ez da zuzena.',
            'id_aretoa.required' => 'Aretoa aukeratu behar da.',
            'id_aretoa.exists' => 'Aukeratutako aretoa ez da existitzen.',
            'data.required' => 'Data derrigorrezkoa da.',
            'data.date' => 'Datak data zuzena izan behar du.',
            'irudia.image' => 'Fitxategiak irudi bat izan behar du.',
            'irudia.mimes' => 'Irudiak JPG, PNG edo WEBP izan behar du.',
            'irudia.max' => 'Irudiak gehienez 2 MB izan ditzake.',
        ]);

        if ($request->hasFile('irudia')) {
            $path = $request->file('irudia')->store('Ekitaldiak', 'public');
            $datuak['irudia'] = Storage::url($path);
        }

        return $datuak;
    }

    // Ekitaldiaren informazio orria:
    public function show(Ekitaldia $ekitaldia)
    {
        return view('infoEkitaldia', ['ekitaldia' => $ekitaldia]);
    }

    // Eserlekuak aukeratzeko orria:
    public function eserlekuak(Ekitaldia $ekitaldia)
    {
        // Ekitaldiaren aretoko eserleku GUZTIAK hartzen ditugu, lerroka antolatuta (1. lerroa, 2. lerroa...) eta lerro bakoitzean eserlekuaren zenbakiaren arabera.
        $lerroak = $ekitaldia->aretoa->eserlekuak()
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get()
            ->groupBy('lerro_zenb');

        // Ekitaldi honetarako saldutako eserlekuen id-ak (sarrerak taulatik). Hauek beltzez agertuko dira.
        $okupatutakoEserlekuak = $ekitaldia->sarrerak->pluck('id_eserlekua')->all();

        // Prezioa: ekitaldiaren sarreren prezioa (hasierako orrian "Preziotik" ateratzen den berbera).
        $prezioa = (float) $ekitaldia->sarrerak->min('prezioa');
        $silverPrezioa = max($prezioa - self::SILVER_ECONOMY_HOBARIA, 0);

        return view('eserlekuak', [
            'ekitaldia' => $ekitaldia,
            'lerroak' => $lerroak,
            'okupatutakoEserlekuak' => $okupatutakoEserlekuak,
            'prezioa' => $prezioa,
            'silverPrezioa' => $silverPrezioa,
            'silverMota' => EserlekuMota::Silver_economy->value,
        ]);
    }

    public function erosketaProzezuak(Request $request, Ekitaldia $ekitaldia)
    {
        $eserlekuIds = $request->query('eserlekuak', '');

        if (! is_string($eserlekuIds) || $eserlekuIds === '') {
            abort(404);
        }

        $eserlekuIds = explode(',', $eserlekuIds);

        $aukeratutakoEserlekuak = $ekitaldia->aretoa->eserlekuak()
            ->whereIn('id', $eserlekuIds)
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get();

        if ($aukeratutakoEserlekuak->count() !== count($eserlekuIds)) {
            abort(404);
        }

        if ($ekitaldia->sarrerak()->whereIn('id_eserlekua', $eserlekuIds)->exists()) {
            abort(404);
        }

        $prezioa = (float) $ekitaldia->sarrerak->min('prezioa');
        $silverPrezioa = max($prezioa - self::SILVER_ECONOMY_HOBARIA, 0);
        $eserlekuPrezioak = [];
        $azpitotala = 0;

        foreach ($aukeratutakoEserlekuak as $eserlekua) {
            if ($eserlekua->eserleku_mota === EserlekuMota::Silver_economy->value) {
                $eserlekuPrezioak[$eserlekua->id] = $silverPrezioa;
            } else {
                $eserlekuPrezioak[$eserlekua->id] = $prezioa;
            }

            $azpitotala += $eserlekuPrezioak[$eserlekua->id];
        }

        $kopurua = $aukeratutakoEserlekuak->count();
        $kudeaketaGastuak = 1.50;
        $guztira = $azpitotala + $kudeaketaGastuak;

        return view('erosketaProzezua', compact(
            'ekitaldia',
            'aukeratutakoEserlekuak',
            'eserlekuPrezioak',
            'kopurua',
            'azpitotala',
            'kudeaketaGastuak',
            'guztira'
        ));
    }

    // Erosketaren berrespen orria (QR-a geroago automatikoki sortuko da):
    public function berrespena(Request $request, Ekitaldia $ekitaldia)
    {
        // Eserlekuak "?eserlekuak=ID,ID" bidez jasotzen dira (ordainketa orriak bidaliko ditu).
        $ids = explode(',', (string) $request->query('eserlekuak'));

        // Ekitaldiaren aretoko eserlekuak bakarrik onartzen dira.
        $eserlekuak = $ekitaldia->aretoa->eserlekuak()
            ->whereIn('id', $ids)
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get();

        if ($eserlekuak->isEmpty()) {
            abort(404);
        }

        return view('berrespena', [
            'ekitaldia' => $ekitaldia,
            'eserlekuak' => $eserlekuak,
        ]);
    }

    // "Onartu" sakatzean: sarrerak datubasean gorde (eserlekuak okupatuta agertzeko) eta hasierako orrira itzuli.
    public function berrespenaOnartu(Request $request, Ekitaldia $ekitaldia)
    {
        $datuak = $request->validate([
            'eserlekuak' => 'required|array',
            'eserlekuak.*' => [
                'integer',
                // Eserlekua ekitaldiaren aretokoa izan behar da.
                Rule::exists('eserlekuak', 'id')->where('id_aretoa', $ekitaldia->id_aretoa),
                // Eserleku bera ezin da bi aldiz saldu ekitaldi berean.
                Rule::unique('sarrerak', 'id_eserlekua')->where('id_ekitaldia', $ekitaldia->id),
            ],
        ], [
            'eserlekuak.required' => 'Eserleku bat aukeratu behar da gutxienez.',
            'eserlekuak.*.exists' => 'Aukeratutako eserlekua ez da existitzen.',
            'eserlekuak.*.unique' => 'Aukeratutako eserlekua dagoeneko salduta dago.',
        ]);

        // Prezioa: eserlekuak orrian erakusten den berbera.
        $prezioa = (float) $ekitaldia->sarrerak->min('prezioa');
        $silverPrezioa = max($prezioa - self::SILVER_ECONOMY_HOBARIA, 0);

        $eserlekuak = Eserlekua::whereIn('id', $datuak['eserlekuak'])->get();

        foreach ($eserlekuak as $eserlekua) {
            Sarrera::create([
                'id_ekitaldia' => $ekitaldia->id,
                'id_eserlekua' => $eserlekua->id,
                'id_user' => $request->user()->id,
                'prezioa' => $eserlekua->eserleku_mota === EserlekuMota::Silver_economy->value ? $silverPrezioa : $prezioa,
            ]);
        }

        // Saioa ez da ixten: erabiltzailea logeatuta jarraitzen du hasierako orrian.
        return redirect()->route('welcome');
    }
}
