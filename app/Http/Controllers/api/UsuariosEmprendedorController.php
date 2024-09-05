<?php

namespace App\Http\Controllers\Api;

use App\Models\usuarios_emprendedors; 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController; 

class UsuariosEmprendedorController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuariosEmprendedores = usuarios_emprendedors::all();
        
        return response()->json($usuariosEmprendedores);
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
            'emprendedors_id' => 'required|exists:emprendedors,id',
            'inversionistas_id' => 'required|exists:inversionistas,id',
        ]);
        
        $usuariosEmprendedor = usuarios_emprendedors::create($request->all());

        return response()->json($usuariosEmprendedor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $usuariosEmprendedor = usuarios_emprendedors::findOrFail($id);
        return response()->json($usuariosEmprendedor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsuariosEmprendedor  $usuariosEmprendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuarios_emprendedors $usuariosEmprendedor)
    {
        $request->validate([
            'emprendedors_id' => 'required|exists:emprendedors,id',
            'inversionistas_id' => 'required|exists:inversionistas,id',
        ]);

        $usuariosEmprendedor->update($request->all());

        return response()->json($usuariosEmprendedor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuariosEmprendedor  $usuariosEmprendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuarios_emprendedors $usuariosEmprendedor)
    {
        $usuariosEmprendedor->delete();
        return response()->json($usuariosEmprendedor);
    }
}
