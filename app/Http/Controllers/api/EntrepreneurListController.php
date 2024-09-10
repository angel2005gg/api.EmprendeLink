<?php

namespace App\Http\Controllers\Api;

use App\Models\UserEntrepreneur; 
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController; 

class UserEntrepreneurController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userEntrepreneurs = UserEntrepreneur::all();
        
        return response()->json($userEntrepreneurs);
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
            'entrepreneur_id' => 'required|exists:entrepreneurs,id',
            'investor_id' => 'required|exists:investors,id',
        ]);
        
        $userEntrepreneur = UserEntrepreneur::create($request->all());

        return response()->json($userEntrepreneur);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $userEntrepreneur = UserEntrepreneur::findOrFail($id);
        return response()->json($userEntrepreneur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEntrepreneur  $userEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEntrepreneur $userEntrepreneur)
    {
        $request->validate([
            'entrepreneur_id' => 'required|exists:entrepreneurs,id',
            'investor_id' => 'required|exists:investors,id',
        ]);

        $userEntrepreneur->update($request->all());

        return response()->json($userEntrepreneur);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEntrepreneur  $userEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEntrepreneur $userEntrepreneur)
    {
        $userEntrepreneur->delete();
        return response()->json($userEntrepreneur);
    }
}
