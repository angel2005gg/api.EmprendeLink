<?php

namespace App\Http\Controllers\Api;

use App\Models\publish_Entrepreneurships;
use App\Models\PublishEntrepreneurships;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class PublishEntrepreneurshipsController extends RoutingController
{
    public function index()
    {
        $publishEntrepreneurships = publish_Entrepreneurships::all();
        // $publishEntrepreneurships = PublishEntrepreneurship::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();

        $publishEntrepreneurships = publish_Entrepreneurships::included()->get();
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

        $publishEntrepreneurship = publish_Entrepreneurships::create($request->all());
        return response()->json($publishEntrepreneurship);
    }

    public function show($id)
    {
        $publishEntrepreneurship = publish_Entrepreneurships::included()->findOrFail($id);
        return response()->json($publishEntrepreneurship);
    }

    public function update(Request $request, publish_Entrepreneurships $publishEntrepreneurship)
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

    public function destroy(publish_Entrepreneurships $publishEntrepreneurship)
    {
        $publishEntrepreneurship->delete();
        return response()->json($publishEntrepreneurship);
    }
}
