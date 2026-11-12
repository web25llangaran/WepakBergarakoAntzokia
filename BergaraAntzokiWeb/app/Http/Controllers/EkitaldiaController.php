<?php

namespace App\Http\Controllers;

use App\Enums\EserlekuMota;
use App\Models\Ekitaldia;

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
}
