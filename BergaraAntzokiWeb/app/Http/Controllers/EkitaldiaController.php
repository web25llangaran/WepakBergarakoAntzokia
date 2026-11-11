<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Ekitaldia;
use Illuminate\Contracts\View\View;
use Illuminate\validation\Rule;
use App\Enums\EkitaldiMota;
use Illuminate\Support\Facades\Storage;
use App\Models\Aretoa;

class EkitaldiaController extends Controller
{
    function index(){
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
        $ekitaldi_berria = $request->validate([
            'izena' => 'required|string|max:255',
            'deskripzioa' => 'nullable|string',
            'ekitaldi_mota' => ['required', Rule::enum(EkitaldiMota::class)],
            'data' => 'required|date',
            'irudia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        if($request->hasFile('irudia')){
            $path = $request->file('irudia')->store('Ekitaldiak', 'public');
            $ekitaldi_berria['irudia'] = Storage::url($path);
        }
        Ekitaldia::create($ekitaldi_berria);
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
        $ekitaldi_aldatua = $request->validate([
            'izena' => 'required|string|max:255',
            'deskripzioa' => 'nullable|string',
            'ekitaldi_mota' => ['required', Rule::enum(EkitaldiMota::class)],
            'data' => 'required|date',
            'irudia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        
        if($request->hasFile('irudia')){
            $path = $request->file('irudia')->store('Ekitaldiak', 'public');
            $ekitaldi_aldatua['irudia'] = Storage::url($path);
        }

        $ekitaldia->update($ekitaldi_aldatua);

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

}