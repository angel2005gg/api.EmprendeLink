<?php

namespace App\Http\Controllers\api;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review=Review::all();
        $review = Review::included()->get();
        $review = Review ::included()->filter()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($review);
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
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
            'Entrepreneurships_id' => 'nullable|exists:Entrepreneurships,id',
            'investor_id' => 'nullable|exists:investors,id',

        ]);

        $review = Review::create($request->all());

        return response()->json($review);
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
        $review = Review::included()->findOrFail($id);
        return response()->json($review);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'qualification' => 'required|max:255',
            'comment' => 'required|max:255' . $review->id,
            'entrepreneur_id' => 'nullable|exists:entrepreneurs,id',
            'Entrepreneurships_id' => 'nullable|exists:Entrepreneurships,id',
            'investor_id' => 'nullable|exists:investors,id',

        ]);

        $review->update($request->all());

        return response()->json($review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return response()->json($review);
    }
}
