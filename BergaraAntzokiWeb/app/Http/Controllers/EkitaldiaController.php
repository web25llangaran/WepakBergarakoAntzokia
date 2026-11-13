<?php

namespace App\Http\Controllers;

use App\Enums\EkitaldiMota;
use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
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

    // Erosketaren berrespen orria (estetika bakarrik: QR-a eta erreferentzia geroago):
    public function berrespena(Request $request, Ekitaldia $ekitaldia)
    {
        // Eserlekua "?eserlekua=ID" bidez jasotzen da (ordainketa orriak bidaliko du).
        $eserlekua = Eserlekua::findOrFail($request->query('eserlekua'));

        return view('berrespena', [
            'ekitaldia' => $ekitaldia,
            'eserlekua' => $eserlekua,
        ]);
    }
}
