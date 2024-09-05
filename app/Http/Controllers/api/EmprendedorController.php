<?php

namespace App\Http\Controllers\Api;
use App\Models\Emprendedor; 
use App\models\user;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Controller as RoutingController;


class EmprendedorController extends RoutingController
{

   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$Emprendedor=Emprendedor::all();
        $Emprendedor = Emprendedor::included()->get();
        //$categories=Category::included()->filter();
        //$categories=Category::included()->filter()->sort()->get();
        //$categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($Emprendedor);
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
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'fecha_nacimiento'=> 'required|max:255',
            'password'=> 'required|max:255',
            'telefono'=> 'required|max:255',
            'imagen'=> 'required|max:255',
            'correo'=> 'required|max:255',
            'ubicacion'=> 'required|max:255',
            'numero'=> 'required|max:255',

        ]);

        $Emprendedor = Emprendedor::create($request->all());

        return response()->json($Emprendedor);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Emprendedor  $Emprendedor
     * @return \Illuminate\Http\Response
     */
    public function show($id) //si se pasa $id se utiliza la comentada
    {  
        
       // $category = Category::findOrFail($id);
        // $category = Category::with(['posts.user'])->findOrFail($id);
        // $category = Category::with(['posts'])->findOrFail($id);
        // $category = Category::included();
        $Emprendedor = Emprendedor::included()->findOrFail($id);
        return response()->json($Emprendedor);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Emprendedor  $Emprendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Emprendedor $Emprendedor)
    {
        $request->validate([
           'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'fecha_nacimiento'=> 'required|max:255',
            'password'=> 'required|max:255',
            'telefono'=> 'required|max:255',
            'imagen'=> 'required|max:255',
            'correo'=> 'required|max:255',
            'ubicacion'=> 'required|max:255'. $Emprendedor->id,

        ]);

        $Emprendedor->update($request->all());

        return response()->json($Emprendedor);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Emprendedor $Emprendedor)
    {
        $Emprendedor->delete();
        return response()->json($Emprendedor);
    }
}