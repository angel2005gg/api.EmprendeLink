<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\create_reviews;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;

class CreateReviewsController extends RoutingController
{
    
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$create_review=create_reviews::all();
         $create_review = create_reviews::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();
        return response()->json($create_review);
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

        $create_review = create_reviews::create($request->all());

        return response()->json($create_review);
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
        $create_review = create_reviews::included()->findOrFail($id);
        return response()->json($create_review);
        //http://api.codersfree1.test/v1/categories/1/?included=posts.user

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, create_reviews $create_review)
    {
        $request->validate([
            'qualification' => 'required|max:255',
            'comment' => 'required|max:255' . $create_review->id,

        ]);

        $create_review->update($request->all());

        return response()->json($create_review);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(create_reviews $create_review)
    {
        $create_review->delete();
        return response()->json($create_review);
    }
}
