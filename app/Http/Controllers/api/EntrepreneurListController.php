<?php

namespace App\Http\Controllers\Api;

use App\Models\entrepreneursLists;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class EntrepreneurListController extends RoutingController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurLists = entrepreneursLists::all();

        return response()->json($entrepreneurLists);
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
            'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            'investors_id' => 'required|exists:investors,id',
        ]);

        $entrepreneurList = entrepreneursLists::create($request->all());

        return response()->json($entrepreneurList);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrepreneurList = entrepreneursLists::findOrFail($id);

        return response()->json($entrepreneurList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\entrepreneursLists  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, entrepreneursLists $entrepreneurList)
    {
        $request->validate([
            'entrepreneurs_id' => 'required|exists:entrepreneurs,id',
            'investors_id' => 'required|exists:investors,id',
        ]);

        $entrepreneurList->update($request->all());

        return response()->json($entrepreneurList);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\entrepreneursLists  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function destroy(entrepreneursLists $entrepreneurList)
    {
        $entrepreneurList->delete();

        return response()->json($entrepreneurList);
    }
}
