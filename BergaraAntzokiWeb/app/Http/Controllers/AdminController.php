<?php

namespace App\Http\Controllers;

use App\Enums\Rola;
use App\Models\Ekitaldia;
use App\Models\Sarrera;
use App\Models\User;

// Controlador del panel de administración: prepara todos los datos que se muestran en el dashboard del admin.
class AdminController extends Controller
{
    // Carga eventos, usuarios y entradas y los manda a la vista admin.admin (el panel con pestañas).
    public function index()
    {
        $ekitaldiak = Ekitaldia::all();

        // erabiltzaile arrunten zerrenda eskatu, administratzaileak ezin bait du sarrerarik erosi.
        $erabiltzaileak = User::where('rola', Rola::Arrunta->value)->get();
        // Erabiltzaileen fitxarako erabiltzaile guztiak (adminak barne), erabiltzaile izenaren arabera ordenatuta.
        $users = User::orderBy('user_izena')->get();
        // Erlazioak aldez aurretik kargatu. Honela orria kargatzen hasten danean datu guztiak eskura izango ditu. Bestela,
        // orria kargatu bitartean kontsultak banan banan egingo ditu eta hau makal joango da:
        // Hemen 5 kontsulta bakarrik egingo ditu. Dashboard-en tabla kargatzean egingo bagenitu, sarrera bakoitzeko
        // 4 kontsulta egin beharko genituzke.
        $sarrerak = Sarrera::with(['ekitaldia.aretoa', 'eroslea', 'eserlekua'])->get();

        // Devolvemos la vista del panel pasándole todas las listas.
        return view('admin.admin', compact('ekitaldiak', 'erabiltzaileak', 'users', 'sarrerak'));
    }
}
