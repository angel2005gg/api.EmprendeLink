<?php

namespace App\Http\Controllers\api;

use App\Models\Entrepreneurship; // Actualizado el nombre del modelo
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EntrepreneurshipController extends Controller
{
    public function index()
    {
        $entrepreneurships=Entrepreneurship::included()->get(); // Actualizado el nombre del modelo
        $entrepreneurships=Entrepreneurship::included()->filter()->sort()->get();
        $entrepreneurships=Entrepreneurship::included()->filter()->sort()->getOrPaginate();
        return response()->json($entrepreneurships);
    }

    public function create()
    {
        return view('Entrepreneurship.create'); // Actualizado el nombre del modelo
    }

    public function store(Request $request)
    {
        $request->validate([
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
            'investor_id' => 'nullable|exists:investors,id',
            'publish_Entrepreneurships_id' => 'nullable|exists:publish_Entrepreneurships,id',
        ]);

        $entrepreneurship = Entrepreneurship::create($request->all());
        return response()->json($entrepreneurship);
    }

    public function show($id)
    {
        $entrepreneurship = Entrepreneurship::included()->findOrFail($id); // Actualizado el nombre del modelo
        return response()->json($entrepreneurship);
    }

    public function edit(Entrepreneurship $entrepreneurship)
    {
        return view('Entrepreneurship.edit', compact('entrepreneurship')); // Actualizado el nombre del modelo
    }

    public function update(Request $request, Entrepreneurship $entrepreneurship)
    {
        $request->validate([
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
            'investor_id' => 'nullable|exists:investors,id',
            'publish_Entrepreneurships_id' => 'nullable|exists:publish_Entrepreneurships,id',
        ]);

        $entrepreneurship->update($request->all());
        return response()->json($entrepreneurship);
    }

    public function destroy(Entrepreneurship $entrepreneurship)
    {
        $entrepreneurship->delete();
        return response()->json(null, 204);
    }
}
