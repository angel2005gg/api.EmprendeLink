<?php

namespace App\Http\Controllers\Api;

use App\Models\Publicar_Emprendimiento;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class PublicarEmprendimientoController extends RoutingController
{
    public function index()
    {
        $publicar_emprendimiento=Publicar_Emprendimiento::all();
        // $publicar_emprendimiento = Publicar_Emprendimiento::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();

        $publicarEmprendimiento = Publicar_Emprendimiento::included()->get();
        return response()->json($publicarEmprendimiento);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'mail' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'date_exp' => 'required|max:255',
        ]);

        $publicarEmprendimiento = Publicar_Emprendimiento::create($request->all());
        return response()->json($publicarEmprendimiento);
    }

    public function show($id)
    {
        $publicarEmprendimiento = Publicar_Emprendimiento::included()->findOrFail($id);
        return response()->json($publicarEmprendimiento);
    }

    public function update(Request $request, Publicar_Emprendimiento $publicarEmprendimiento)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'mail' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'date_exp' => 'required|max:255',
        ]);

        $publicarEmprendimiento->update($request->all());
        return response()->json($publicarEmprendimiento);
    }

    public function destroy(Publicar_Emprendimiento $publicarEmprendimiento)
    {
        $publicarEmprendimiento->delete();
        return response()->json($publicarEmprendimiento);
    }
}
