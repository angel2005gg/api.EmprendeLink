<?php

namespace App\Http\Controllers\Api;

use App\Models\PublishEntrepreneurships;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class PublishEntrepreneurshipsController extends RoutingController
{
    public function index()
    {
        $publishEntrepreneurships = PublishEntrepreneurships::all();
        // $publishEntrepreneurships = PublishEntrepreneurship::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();

        $publishEntrepreneurships = PublishEntrepreneurships::included()->get();
        return response()->json($publishEntrepreneurships);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'expiration_date' => 'required|max:255',
        ]);

        $publishEntrepreneurship = PublishEntrepreneurships::create($request->all());
        return response()->json($publishEntrepreneurship);
    }

    public function show($id)
    {
        $publishEntrepreneurship = PublishEntrepreneurships::included()->findOrFail($id);
        return response()->json($publishEntrepreneurship);
    }

    public function update(Request $request, PublishEntrepreneurships $publishEntrepreneurship)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'expiration_date' => 'required|max:255',
        ]);

        $publishEntrepreneurship->update($request->all());
        return response()->json($publishEntrepreneurship);
    }

    public function destroy(PublishEntrepreneurships $publishEntrepreneurship)
    {
        $publishEntrepreneurship->delete();
        return response()->json($publishEntrepreneurship);
    }
}
