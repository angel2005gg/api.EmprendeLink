<?php

namespace App\Http\Controllers\api;

use App\Models\Myentrepreneurship;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MyentrepreneurshipController extends Controller
{
    public function index()
    {
        $myentrepreneurships = Myentrepreneurship::included()->filter()->sort()->getOrPaginate();
        $myentrepreneurships = Myentrepreneurship::included()->get();
        $myentrepreneurships=Myentrepreneurship::included()->filter();
        $myentrepreneurships=Myentrepreneurship::included()->filter()->sort()->get();
        $myentrepreneurships=Myentrepreneurship::included()->filter()->sort()->getOrPaginate();
        return response()->json($myentrepreneurships);
    }

    public function create()
    {
        return view('Myentrepreneurship.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
           'publish_Entrepreneurships_id' => 'nullable|exists:publish_Entrepreneurships,id',
            'investor_id' => 'nullable|exists:investors,id',
            'Review_id' => 'nullable|exists:Review,id',
        ]);

        $myentrepreneurship = Myentrepreneurship::create($request->all());
        return response()->json($myentrepreneurship);
    }

    public function show($id)
    {
        $myentrepreneurship = Myentrepreneurship::included()->findOrFail($id);
        return response()->json($myentrepreneurship);

        
    }

    public function edit(Myentrepreneurship $myentrepreneurship)
    {
        return view('Myentrepreneurship.edit', compact('myentrepreneurship'));
    }

    public function update(Request $request, Myentrepreneurship $myentrepreneurship)
    {
        $request->validate([
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
            'publish_Entrepreneurships_id' => 'nullable|exists:publish_Entrepreneurships,id',
            'investor_id' => 'nullable|exists:investors,id',
            'Review_id' => 'nullable|exists:Review,id',
        ]);

        $myentrepreneurship->update($request->all());
        return response()->json($myentrepreneurship);
    }

    public function destroy(Myentrepreneurship $myentrepreneurship)
    {
        $myentrepreneurship->delete();
        return response()->json(null, 204);
    }
}
