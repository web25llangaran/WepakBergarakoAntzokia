<?php

namespace App\Http\Controllers;

use App\Enums\EkitaldiMota;
use App\Enums\EserlekuMota;
use App\Models\Aretoa;
use App\Models\Ekitaldia;
use App\Models\Eserlekua;
use App\Models\Sarrera;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

// Controlador de los eventos: página de inicio, info de evento, elegir butacas, compra y confirmación, y el CRUD de eventos del admin.
class EkitaldiaController extends Controller
{
    // Silver Economy sarrerak, sarrera arruntak baino zenbat euro merkeagoak diren.
    private const SILVER_ECONOMY_HOBARIA = 10.00;

    // Página de inicio: coge todos los eventos de la BD y los manda a la vista welcome.
    public function index()
    {
        $ekitaldiak = Ekitaldia::all(); // Datu basetik Ekitaldia taulako datu GUZTIAK hartzen ditugu.

        // echo $ekitaldiak;
        return view('welcome', ['ekitaldiak' => $ekitaldiak]); // "Ekitaldien zerrenda "Welcome" orrian sartzen ditugu, eta gainera, orria ikusi ahal izateko eskatzen dugu.
    }

    // ADMIN - Muestra el formulario para crear un evento (con la lista de salas para el desplegable).
    /**
     * Ekitaldi berria sortzeko formularioa erakutsi.
     */
    public function create()
    {
        // Coge todos los eventos con su sala ya cargada (with = eager loading) y ordenados por fecha. (Ojo: esta vista no la usa, sobra.)
        $ekitaldiak = Ekitaldia::with('aretoa')->orderBy('data')->get();
        // Coge todas las salas de la BD para rellenar el desplegable "Aretoa" del formulario.
        $aretoak = Aretoa::all();

        // Carga la vista resources/views/admin/ekitaldiak/create.blade.php y le pasa las variables $ekitaldiak y $aretoak (compact crea el array).
        return view('admin.ekitaldiak.create', compact(['ekitaldiak', 'aretoak']));
    }

    // ADMIN - Valida los datos del formulario, crea el evento y vuelve al panel con mensaje de éxito.
    /**
     * Ekitaldi berria datubasean gorde.
     */
    public function store(Request $request)
    {
        Ekitaldia::create($this->ekitaldiaBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo sortu da!');
    }

    // ADMIN - Muestra el detalle de un evento (cargando su sala y sus entradas).
    /**
     * Sarrera baten xehetasunak erakutsi.
     */
    public function showAdmin(Ekitaldia $ekitaldia)
    {
        $ekitaldia->load(['aretoa', 'sarrerak']);

        return view('admin.ekitaldiak.show', compact('ekitaldia'));
    }

    // ADMIN - Muestra el formulario para editar un evento ya existente.
    /**
     * Sarrera bat editatzeko formularioa erakutsi.
     */
    public function edit(Ekitaldia $ekitaldia)
    {
        $aretoak = Aretoa::all();

        return view('admin.ekitaldiak.edit', compact(['ekitaldia', 'aretoak']));
    }

    // ADMIN - Valida los datos y actualiza el evento en la BD.
    /**
     * Sarrera baten datuak eguneratu.
     */
    public function update(Request $request, Ekitaldia $ekitaldia)
    {
        $ekitaldia->update($this->ekitaldiaBalidatu($request));

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo eguneratu da!');
    }

    // ADMIN - Borra el evento y vuelve al panel.
    /**
     * Sarrera bat ezabatu.
     */
    public function destroy(Ekitaldia $ekitaldia)
    {
        $ekitaldia->delete();

        return redirect()->to(route('admin.dashboard').'#ekitaldiak')->with('success', 'Ekitaldia, ondo ezabatu da!');
    }

    // Función reutilizable para crear y editar: valida los campos del evento y, si se sube imagen, la guarda.
    /**
     * Ekitaldi baten datuak balidatu (sortzeko eta editatzeko) eta irudia gorde.
     *
     * @return array{izena: string, deskripzioa: ?string, ekitaldi_mota: string, id_aretoa: int, data: string, irudia?: string}
     */
    private function ekitaldiaBalidatu(Request $request): array
    {
        // Reglas de validación (izquierda) y mensajes de error en euskera que verá el usuario (derecha).
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

        // Si se ha subido una imagen, se guarda en storage/public/Ekitaldiak y se guarda su URL en el evento.
        if ($request->hasFile('irudia')) {
            $path = $request->file('irudia')->store('Ekitaldiak', 'public');
            $datuak['irudia'] = Storage::url($path);
        }

        return $datuak;
    }

    // Ekitaldiaren informazio orria:
    // Página pública con la información de un evento concreto.
    public function show(Ekitaldia $ekitaldia)
    {
        return view('infoEkitaldia', ['ekitaldia' => $ekitaldia]);
    }

    // Eserlekuak aukeratzeko orria:
    // Página para elegir butacas: prepara el plano de la sala, las butacas ocupadas y los precios.
    public function eserlekuak(Ekitaldia $ekitaldia)
    {
        // Ekitaldiaren aretoko eserleku GUZTIAK hartzen ditugu, lerroka antolatuta (1. lerroa, 2. lerroa...) eta lerro bakoitzean eserlekuaren zenbakiaren arabera.
        $lerroak = $ekitaldia->aretoa->eserlekuak()
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get()
            ->groupBy('lerro_zenb');

        // Ekitaldi honetarako saldutako eserlekuen id-ak (sarrerak taulatik). Hauek beltzez agertuko dira.
        // pluck('id_eserlekua') recorre todas las entradas del evento y saca SOLO el valor de la columna id_eserlekua de cada una (ej. [5, 12, 13]); ->all() lo convierte de colección a array normal de PHP.
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

    // Página del proceso de compra (resumen y pago): recibe las butacas elegidas por la URL y calcula los precios.
    public function erosketaProzezuak(Request $request, Ekitaldia $ekitaldia)
    {
        // Leemos las butacas de la URL (?eserlekuak=1,2,3). Si no viene nada, error 404.
        $eserlekuIds = $request->query('eserlekuak', '');

        if (! is_string($eserlekuIds) || $eserlekuIds === '') {
            abort(404);
        }

        // Pasamos el texto "1,2,3" a un array [1,2,3].
        $eserlekuIds = explode(',', $eserlekuIds);

        // Buscamos esas butacas, pero solo las que pertenecen a la sala del evento.
        $aukeratutakoEserlekuak = $ekitaldia->aretoa->eserlekuak()
            ->whereIn('id', $eserlekuIds)
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get();

        // Seguridad: si alguna butaca no existe en esa sala, error 404.
        if ($aukeratutakoEserlekuak->count() !== count($eserlekuIds)) {
            abort(404);
        }

        // Seguridad: si alguna de las butacas ya está vendida para este evento, error 404.
        if ($ekitaldia->sarrerak()->whereIn('id_eserlekua', $eserlekuIds)->exists()) {
            abort(404);
        }

        // Cálculo de precios: precio normal y precio Silver (10 € más barato, nunca menos de 0).
        $prezioa = (float) $ekitaldia->sarrerak->min('prezioa');
        $silverPrezioa = max($prezioa - self::SILVER_ECONOMY_HOBARIA, 0);
        $eserlekuPrezioak = [];
        $azpitotala = 0;

        // Recorremos cada butaca, le ponemos su precio según su tipo y lo vamos sumando al subtotal.
        foreach ($aukeratutakoEserlekuak as $eserlekua) {
            if ($eserlekua->eserleku_mota === EserlekuMota::Silver_economy->value) {
                $eserlekuPrezioak[$eserlekua->id] = $silverPrezioa;
            } else {
                $eserlekuPrezioak[$eserlekua->id] = $prezioa;
            }

            $azpitotala += $eserlekuPrezioak[$eserlekua->id];
        }

        // Total final = subtotal + 1,50 € de gastos de gestión.
        $kopurua = $aukeratutakoEserlekuak->count();
        $kudeaketaGastuak = 1.50;
        $guztira = $azpitotala + $kudeaketaGastuak;

        // Mandamos todos los datos a la vista erosketaProzezua.
        return view('erosketaProzezua', compact(
            'ekitaldia',
            'aukeratutakoEserlekuak',
            'eserlekuPrezioak',
            'kopurua',
            'azpitotala',
            'kudeaketaGastuak',
            'guztira'
        ));
    }

    // Erosketaren berrespen orria (QR-a geroago automatikoki sortuko da):
    // Página de confirmación de la compra (con el QR y el resumen de butacas).
    public function berrespena(Request $request, Ekitaldia $ekitaldia)
    {
        // Eserlekuak "?eserlekuak=ID,ID" bidez jasotzen dira (ordainketa orriak bidaliko ditu).
        $ids = explode(',', (string) $request->query('eserlekuak'));

        // Ekitaldiaren aretoko eserlekuak bakarrik onartzen dira.
        $eserlekuak = $ekitaldia->aretoa->eserlekuak()
            ->whereIn('id', $ids)
            ->orderBy('lerro_zenb')
            ->orderBy('eserleku_zenb')
            ->get();

        if ($eserlekuak->isEmpty()) {
            abort(404);
        }

        // Mandamos el evento y las butacas a la vista berrespena.
        return view('berrespena', [
            'ekitaldia' => $ekitaldia,
            'eserlekuak' => $eserlekuak,
        ]);
    }

    // "Onartu" sakatzean: sarrerak datubasean gorde (eserlekuak okupatuta agertzeko) eta hasierako orrira itzuli.
    // Al pulsar "Onartu" (aceptar): valida las butacas y guarda una entrada (Sarrera) por cada butaca en la BD.
    public function berrespenaOnartu(Request $request, Ekitaldia $ekitaldia)
    {
        // Validación: tiene que llegar al menos una butaca, que sea de la sala del evento y que no esté ya vendida.
        $datuak = $request->validate([
            'eserlekuak' => 'required|array',
            'eserlekuak.*' => [
                'integer',
                // Eserlekua ekitaldiaren aretokoa izan behar da.
                Rule::exists('eserlekuak', 'id')->where('id_aretoa', $ekitaldia->id_aretoa),
                // Eserleku bera ezin da bi aldiz saldu ekitaldi berean.
                Rule::unique('sarrerak', 'id_eserlekua')->where('id_ekitaldia', $ekitaldia->id),
            ],
        ], [
            'eserlekuak.required' => 'Eserleku bat aukeratu behar da gutxienez.',
            'eserlekuak.*.exists' => 'Aukeratutako eserlekua ez da existitzen.',
            'eserlekuak.*.unique' => 'Aukeratutako eserlekua dagoeneko salduta dago.',
        ]);

        // Prezioa: eserlekuak orrian erakusten den berbera.
        $prezioa = (float) $ekitaldia->sarrerak->min('prezioa');
        $silverPrezioa = max($prezioa - self::SILVER_ECONOMY_HOBARIA, 0);

        // Buscamos las butacas elegidas para saber de qué tipo es cada una.
        $eserlekuak = Eserlekua::whereIn('id', $datuak['eserlekuak'])->get();

        // Creamos una entrada por cada butaca con el precio que le corresponde (normal o Silver).
        foreach ($eserlekuak as $eserlekua) {
            Sarrera::create([
                'id_ekitaldia' => $ekitaldia->id,
                'id_eserlekua' => $eserlekua->id,
                'id_user' => $request->user()->id,
                'prezioa' => $eserlekua->eserleku_mota === EserlekuMota::Silver_economy->value ? $silverPrezioa : $prezioa,
            ]);
        }

        // Saioa ez da ixten: erabiltzailea logeatuta jarraitzen du hasierako orrian.
        return redirect()->route('welcome');
    }
}
