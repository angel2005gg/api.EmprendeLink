<?php

namespace App\Http\Controllers\Api;

use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class InvestorController extends RoutingController
{
    public function index()
    {
        $investors = Investor::included()->filter()->sort()->getOrPaginate();
        return response()->json($investors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|date',
            'investment_number' => 'required',
            'password' => 'required|min:8',
            'document' => 'required',
            'phone' => 'required|max:20',
            'image' => 'nullable',
            'email' => 'required|email|unique:investors',
            'location' => 'required|max:255',
        ]);

        $investor = Investor::create($request->all());
        return response()->json($investor);
    }

    public function show($id)
    {
        $investor = Investor::included()->findOrFail($id);
        return response()->json($investor);
    }

    public function update(Request $request, Investor $investor)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|date',
            'investment_number' => 'required',
            'password' => 'required|min:8',
            'document' => 'required',
            'phone' => 'required|max:20',
            'image' => 'nullable',
            'email' => 'required|email|unique:investors,email,' . $investor->id,
            'location' => 'required|max:255',
        ]);

        $investor->update($request->all());
        return response()->json($investor);
    }

    public function destroy(Investor $investor)
    {
        $investor->delete();
        return response()->json($investor);
    }
}