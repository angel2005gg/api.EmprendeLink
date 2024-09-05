<?php

namespace App\Http\Controllers\Api;
use App\Models\usuarios_invercionistas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class UsuariosInvercionistasController extends RoutingController
{

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios_invercionistas=usuarios_invercionistas::all();
        
        return response()->json($usuarios_invercionistas);
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
            'emprendedors_id'=> 'required|exists:emprendedors,id',
            'inversionistas_id'=> 'required|exists:inversionistas,id',
            

        ]);
        
        $usuarios_invercionistas = usuarios_invercionistas::create($request->all());

        return response()->json($usuarios_invercionistas);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprendedor  $Emprendedor
     * @return \Illuminate\Http\Response
     */
    public function show($id) //si se pasa $id se utiliza la comentada
    {  
        
       
        $usuarios_invercionistas = usuarios_invercionistas::findOrFail($id);
        return response()->json($usuarios_invercionistas);

        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprendedor  $Emprendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, usuarios_invercionistas $usuarios_invercionistas)
    {
        $request->validate([
          'emprendedors_id'=> 'required|exists:emprendedors,id',
            'inversionistas_id'=> 'required|exists:inversionistas,id',$usuarios_invercionistas->id,

        ]);

        $usuarios_invercionistas->update($request->all());

        return response()->json($usuarios_invercionistas);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(usuarios_invercionistas  $usuarios_invercionistas)
    {
        $usuarios_invercionistas->delete();
        return response()->json($usuarios_invercionistas);
    }
}
