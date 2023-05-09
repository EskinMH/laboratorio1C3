<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModeloTienda;
use App\Models\Owner;

class TiendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tiendas = tienda::paginate();
        return view('tienda.index', compact('tiendas'))
        ->with('i', (request()->input('page', 1)-1)* $tiendas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $owners = Owner::all();
        return view('tienda.create', compact('owners' ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validar
        request()->validate(tienda::$rules);

        //recepcionar todos los datos
        $tiendaData = request()->except("_token");
        tienda::insert($tiendaData);
        return redirect()->route('tienda.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //recuperar los datos
        $pet=Pet::findOrFail($id);
        $owners=Owner::all();
        return view('pet.edit', compact('pet','owners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $petData=request()->except(['_token', '_method']);
        Pet::where('id', '=', $id)->update($petData);
        return redirect('pet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Pet::destroy($id);
        return redirect('pet');
    }
}