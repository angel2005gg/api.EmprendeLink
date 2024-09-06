<?php

namespace App\Http\Controllers\Api;

use App\Models\Connection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class ConnectionController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $connections = Connection::all();
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
            'emprendedors_id',
            'inversionistas_id',
        ]);

        $connection = Connection::create($request->all());

        return response()->json($connection);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_connection)
    {

        $connection = Connection::findOrFail($id_connection);
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
            'emprendedors_id' => 'required|exists:emprendedors,id',
            'inversionistas_id' => 'required|exists:inversionistas,id',
        ]);

        $connection->update($request->all());

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
        return response()->json($connection);
    }
}
