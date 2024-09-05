<?php

namespace App\Http\Controllers\Api;

use App\Models\Conexion;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class ConexionController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conexiones = Conexion::all();
        return response()->json($conexiones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat' => 'required|max:255',
            'emprendedors_id' => 'required|exists:emprendedors,id',
            'inversionistas_id' => 'required|exists:inversionistas,id',
        ]);

        $conexion = Conexion::create($request->all());

        return response()->json($conexion);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_conexion)
    {

        $conexion = Conexion::findOrFail($id_conexion);
        return response()->json($conexion);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conexion  $conexion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conexion $conexion)
    {
        $request->validate([
            'chat' => 'required|max:255',
            'emprendedors_id' => 'required|exists:emprendedors,id',
            'inversionistas_id' => 'required|exists:inversionistas,id',
        ]);

        $conexion->update($request->all());

        return response()->json($conexion);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conexion  $conexion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conexion $conexion)
    {
        $conexion->delete();
        return response()->json($conexion);
    }
}
