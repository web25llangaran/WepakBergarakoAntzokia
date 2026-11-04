<?php

namespace App\Http\Controllers;

use App\Models\Sarrera;
use Illuminate\Http\Request;

class SarreraController extends Controller
{
   
    // public function create()
    // {
    //     return view('admin.sarrerak.sarreraCreate');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Datuen balidazioa
        // $validatedData = $request->validate([
        //     'izenburua'    => 'required|string|max:255',
        //     'deskribapena' => 'required|string',
        //     'data'         => 'required|date',
        //     'aretoa'       => 'required|string|max:255',
        //     'edukiera'     => 'required|integer|min:1',
        //     'prezioa'      => 'required|numeric|min:0',
        //     'kategoria_id' => 'required|exists:kategoriak,id',
        //     'irudia'       => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        // ]);

        // if ($request->hasFile('irudia')) {
        //     //Non gorde irudi berria:/storage/app/public/ekitaldiak
        //     $path = $request->file('irudia')->store('ekitaldiak', 'public');
        //     // /public/storage/ekitaldiak/*.jpg
        //     $validatedData['irudia'] = Storage::url($path);
        // }

        // 2. Datu-basean ekitaldi berria sortu
        Sarrera::create($request);


        // 3. Ekitaldien zerrendara bideratu (flash mezu batekin)
        return redirect()->route('dashboard')
            ->with('success', 'Sarrera ondo sortu da!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sarrera $sarrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sarrera $sarrera)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sarrera $sarrera)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sarrera $sarrera)
    {
        //
    }
}
