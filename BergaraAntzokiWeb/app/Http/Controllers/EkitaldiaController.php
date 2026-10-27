<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\EkitaldiaController;
use App\Models\Ekitaldia;


class EkitaldiaController extends Controller
{
    function index(){
        $ekitaldiak = Ekitaldia::all(); // Datu basetik Ekitaldia taulako datu GUZTIAK hartzen ditugu.
        return view('welcome', ['ekitaldiak' => $ekitaldiak]); // "Ekitaldien zerrenda "Welcome" orrian sartzen ditugu, eta gainera, orria ikusi ahal izateko eskatzen dugu.
    }
}