<?php

namespace App\Http\Controllers;

use App\Enums\EkitaldiMota;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EkitaldiaController extends Controller
{
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
    public function show(Ekitaldia $ekitaldia)
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
}
