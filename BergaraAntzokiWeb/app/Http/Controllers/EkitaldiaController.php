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
            'deskripzioa' => 'nullable|text',
            'ekitaldi_mota' => ['required', Rule::enum(EkitaldiMota::class)],
            'data' => 'required|date',
            'irudia' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        $ekitaldiak = Ekitaldia::with('aretoa')->orderBy('data')->get();
        if($request->hasFile('irudia')){
            $path = $request->file('irudia')->store('Ekitaldiak', 'public');
            $ekitaldi_berria['irudia'] = Storage::url($path);
        }
        Ekitaldia::create($ekitaldi_berria);
        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo sortu da!');
    }
    

}