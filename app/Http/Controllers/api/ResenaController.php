<?php

namespace App\Http\Controllers\Api;

use App\Models\Resena;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class ResenaController extends RoutingController
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$resena=Resena::all();
        $resena = Resena::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($resena);
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
            'qualification' => 'required|max:255',
            'comment' => 'required|max:255',


        ]);

        $resena = Resena::create($request->all());

        return response()->json($resena);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id) //si se pasa $id se utiliza la comentada
    {  
        
       // $category = Category::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
        $resena = Resena::included()->findOrFail($id);
        return response()->json($resena);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resena $resena)
    {
        $request->validate([
            'qualification' => 'required|max:255',
            'comment' => 'required|max:255' . $resena->id,

        ]);

        $resena->update($request->all());

        return response()->json($resena);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resena $resena)
    {
        $resena->delete();
        return response()->json($resena);
    }
}
