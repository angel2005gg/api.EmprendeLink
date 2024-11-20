<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Connection;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connections = Connection::included()  // Usa el scope para incluir relaciones
                                ->filter()    // Aplica filtros si existen
                                ->sort()      // Aplica ordenamiento si existe
                                ->getOrPaginate(); // Obtiene todos los registros o los pagina

        return response()->json($connections);
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
            'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            'investors_id' => 'required|exists:investors,id',
        ]);

        $connection = Connection::create($request->all());

        // Carga las relaciones después de crear
        $connection->load(['entrepreneur', 'investor']);

        return response()->json($connection);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function show($id)
    {
        $connection = Connection::with(['entrepreneur', 'investor'])
                              ->findOrFail($id);
        return response()->json($connection);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Connection $connection)
    {
        $request->validate([
            'chat' => 'required|max:255',
            'entrepreneurs_id' => 'exists:entrepreneurs,id',
            'investors_id' => 'exists:investors,id',
        ]);

        $connection->update($request->all());

        // Recarga el modelo con sus relaciones
        $connection->load(['entrepreneur', 'investor']);

        return response()->json($connection);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Connection  $connection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Connection $connection)
    {
        $connection->delete();

    }
}
