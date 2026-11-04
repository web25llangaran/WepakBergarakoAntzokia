<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekitaldia;
use App\Models\User;
use App\Models\Sarrera;
use App\Enums\Rola;

class AdminController extends Controller
{
    function index(){
        $ekitaldiak = Ekitaldia::all();
        // $erabiltzaileak = User::where('rola', 'admin')->get();
        // if ($request->user()->rola === Rola::Admin->value) {
        //     return redirect()->route('admin.dashboard');
        // }
        // erabiltzaile arrunten zerrenda eskatu:
        $erabiltzaileak = User::where('rola', Rola::Arrunta->value)->get();
        $sarrerak = Sarrera::all();
        return view('admin.admin', compact('ekitaldiak', 'erabiltzaileak', 'sarrerak'));
    }
}
