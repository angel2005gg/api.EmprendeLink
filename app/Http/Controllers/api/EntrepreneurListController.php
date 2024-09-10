<?php

namespace App\Http\Controllers\Api;

use App\Models\EntrepreneurList;
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
        $entrepreneurLists = EntrepreneurList::all();

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

        $entrepreneurList = EntrepreneurList::create($request->all());

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
        $entrepreneurList = EntrepreneurList::findOrFail($id);

        return response()->json($entrepreneurList);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntrepreneurList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntrepreneurList $entrepreneurList)
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
     * @param  \App\Models\EntrepreneurList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntrepreneurList $entrepreneurList)
    {
        $entrepreneurList->delete();

        return response()->json($entrepreneurList);
    }
}
