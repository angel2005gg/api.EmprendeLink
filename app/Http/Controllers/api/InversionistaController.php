<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Inversionista;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class InversionistaController extends RoutingController
{
    public function index()
    {
        $inversionistas = Inversionista::all(); 
        // Puedes usar filtros, ordenamientos, etc. como se muestra en los ejemplos comentados:
        // $inversionistas = Inversionista::included()->get();
        // $inversionistas = Inversionista::included()->filter();
        // $inversionistas = Inversionista::included()->filter()->sort()->get();
        // $inversionistas = Inversionista::included()->filter()->sort()->getOrPaginate();

        return response()->json($inversionistas);
    }

    public function create()
    {
        return view('Inversionista.inversionistaC');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'Nacimiento' => 'required|date',
            'telefono' => 'required|max:20',
            'contraseña' => 'required|min:8',
            'correo' => 'required|email|unique:inversionistas',
            'ubicacion' => 'required|max:255',
        ]);

        $inversionista = Inversionista::create($request->all());
        return response()->json($inversionista);
    }

    public function show($id)
    {
        // Se pueden incluir relaciones en la consulta, como se muestra en los ejemplos comentados:
        // $inversionista = Inversionista::with(['relacion1', 'relacion2'])->findOrFail($id);
        // $inversionista = Inversionista::included()->findOrFail($id);
        
        $inversionista = Inversionista::findOrFail($id);
        return response()->json($inversionista);
        // Ejemplo de ruta: http://api.ejemplo.test/v1/inversionistas/1/?included=relacion1,relacion2
    }

    public function edit(Inversionista $inversionista)
    {
        return view('Inversionista.edit', compact('inversionista'));
    }

    public function update(Request $request, Inversionista $inversionista)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'Nacimiento' => 'required|max:255',
            'telefono' => 'required|max:20',
            'contraseña' => 'required|min:8',
            'correo' => 'required|email|unique:inversionistas,correo,' . $inversionista->id,
            'ubicacion' => 'required|max:255',
        ]);

        $inversionista->update($request->all());
        return response()->json($inversionista);
    }

    public function destroy(Inversionista $inversionista)
    {
        $inversionista->delete();
        return response()->json($inversionista);
    }
}

