<?php

namespace App\Http\Controllers\Api;

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
        $entrepreneurLists = EntrepreneursList::included()->filter()->sort()->getOrPaginate();
        return response()->json($entrepreneurLists);
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

        $entrepreneurList = EntrepreneursList::create($request->all());

        return response()->json($entrepreneurList);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrepreneurList = EntrepreneursList::included()->findOrFail($id);
        return response()->json($entrepreneurList);
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EntrepreneursList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EntrepreneursList $entrepreneurList)
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
     * @param  \App\Models\EntrepreneursList  $entrepreneurList
     * @return \Illuminate\Http\Response
     */
    public function destroy(EntrepreneursList $entrepreneurList)
    {
        $entrepreneurList->delete();

        return response()->json(null, 204);
    }
}
