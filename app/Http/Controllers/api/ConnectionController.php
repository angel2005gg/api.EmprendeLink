<?php

namespace App\Http\Controllers\Api;

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
        $connection = Connection::all();
        return response()->json($connection);
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
            // 'entrepreneurs_id' => 'required|exists:entrepreneurs,id',  // Corregido
            // 'investors_id' => 'required|exists:investors,id',
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
    public function show($id)
    {

        $connection = Connection::findOrFail($id);
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
            // 'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            // 'investors_id' => 'required|exists:investors,id',
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
