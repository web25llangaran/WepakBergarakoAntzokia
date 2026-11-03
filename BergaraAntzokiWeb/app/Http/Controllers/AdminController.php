<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ekitaldia;
use App\Models\User;
use App\Models\Sarrera;

class AdminController extends Controller
{
    function index(){
        $ekitaldiak = Ekitaldia::all();
        $erabiltzaileak = User::all();
        $sarrerak = Sarrera::all();
        return view('admin.admin', ['ekitaldia'=>$ekitaldiak, 'erabiltzailea'=>$erabiltzaileak, 'sarrerak'=>$sarrerak]);
    }
}
