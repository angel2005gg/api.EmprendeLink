<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\crear_resenas;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class CrearResenasController extends RoutingController
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$cear_resena=crear_resenas::all();
         $cear_resena = crear_resenas::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($cear_resena);
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

        $cear_resena = crear_resenas::create($request->all());

        return response()->json($cear_resena);
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
        $cear_resena = crear_resenas::included()->findOrFail($id);
        return response()->json($cear_resena);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, crear_resenas $cear_resena)
    {
        $request->validate([
            'qualification' => 'required|max:255',
            'comment' => 'required|max:255' . $cear_resena->id,

        ]);

        $cear_resena->update($request->all());

        return response()->json($cear_resena);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(crear_resenas $cear_resena)
    {
        $cear_resena->delete();
        return response()->json($cear_resena);
    }
}
