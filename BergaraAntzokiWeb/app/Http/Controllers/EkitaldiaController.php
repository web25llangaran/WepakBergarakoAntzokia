<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;


class EkitaldiaController extends Controller
{
    function index(){
        $ekitaldiak = Ekitaldia::all(); // Datu basetik Ekitaldia taulako datu GUZTIAK hartzen ditugu.
        return view('welcome', ['ekitaldiak' => $ekitaldiak]); // "Ekitaldien zerrenda "Welcome" orrian sartzen ditugu, eta gainera, orria ikusi ahal izateko eskatzen dugu.

        $aretoak = Aretoa::all();
        return view('welcome', ['aretoak' => $aretoak]);

        $sarrerak = Sarrera::all();
        return view('welcome', ['sarrerak' => $sarrera]);

    }
}