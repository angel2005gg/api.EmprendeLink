<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\EntrepreneursList;
use Illuminate\Http\Request;

class EntrepreneurListController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurLists = EntrepreneursList::all();
        $EntrepreneurLists = EntrepreneursList::included()->get();
        $EntrepreneurLists = EntrepreneursList::included()->filter()->get();

        return response()->json($EntrepreneurLists);
    }

    /**
     * Store a newly created resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            'investors_id' => 'required|exists:investors,id',
        ]);

        $EntrepreneurLists = EntrepreneursList::create($request->all());

        return response()->json($EntrepreneurLists);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $EntrepreneurLists = EntrepreneursList::included()->findOrFail($id);
        return response()->json($EntrepreneurLists);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntrepreneursList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntrepreneursList $EntrepreneurLists)
    {
        $request->validate([
            'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            'investors_id' => 'required|exists:investors,id',
        ]);

        $EntrepreneurLists->update($request->all());

        return response()->json($EntrepreneurLists);
    }

    /**
     * Remove the specified resource from storage.
     * @param  \App\Models\EntrepreneursList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntrepreneursList $EntrepreneurLists)
    {
        $EntrepreneurLists->delete();

        return response()->json(null, 204);
    }
}
