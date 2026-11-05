<?php

namespace App\Http\Controllers;

use App\Models\Ekitaldia;
use App\Models\Sarrera;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $ekitaldiak = Ekitaldia::all();

        // Erabiltzaile guztiak (Erabiltzaileak fitxarako), bakoitzak erosi dituen sarreren kopuruarekin.
        $erabiltzaileak = User::withCount('erositako_sarrerak')->orderBy('user_izena')->get();
        // Erlazioak aldez aurretik kargatu. Honela orria kargatzen hasten danean datu guztiak eskura izango ditu. Bestela,
        // orria kargatu bitartean kontsultak banan banan egingo ditu eta hau makal joango da:
        // Hemen 5 kontsulta bakarrik egingo ditu. Dashboard-en tabla kargatzean egingo bagenitu, sarrera bakoitzeko
        // 4 kontsulta egin beharko genituzke.
        $sarrerak = Sarrera::with(['ekitaldia.aretoa', 'eroslea', 'eserlekua'])->get();

        return view('admin.admin', compact('ekitaldiak', 'erabiltzaileak', 'sarrerak'));
    }
}
