<?php

namespace App\Http\Controllers\api;
use App\Models\Entrepreneur; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrepreneurs = Entrepreneur::all();
        return response()->json($entrepreneurs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate request inputs
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|max:255',
            'password' => 'required|max:255',
            'phone' => 'required|max:255',
            'image' => 'required|max:255',
            'email' => 'required|max:255',
            'location' => 'required|max:255',
            'number' => 'required|max:255',
        ]);
        // Create a new entrepreneur record
        $entrepreneur = Entrepreneur::create($request->all());

        return response()->json($entrepreneur);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function show($id) 
    {
        // Find an entrepreneur by ID
        $entrepreneur = Entrepreneur::findOrFail($id);
        return response()->json($entrepreneur);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrepreneur $entrepreneur)
    {
        // Validate request inputs
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|max:255',
            'password' => 'required|max:255',
            'phone' => 'required|max:255',
            'image' => 'required|max:255',
            'email' => 'required|max:255',
            'location' => 'required|max:255' . $entrepreneur->id,
        ]);

        // Update entrepreneur record
        $entrepreneur->update($request->all());

        return response()->json($entrepreneur);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrepreneur $entrepreneur)
    {
        // Delete the entrepreneur record
        $entrepreneur->delete();
        return response()->json($entrepreneur);
    }
}
