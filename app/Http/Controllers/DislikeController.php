<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use App\Models\Dislikes\Services\DislikeService;
use App\Models\Movie;
use Illuminate\Http\Request;

class DislikeController extends Controller
{

    public DislikeService $dislike_service;

    public function __construct(DislikeService $dislike_service)
    {
        $this->dislike_service = $dislike_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function createDislike(Request $request,$movieId)
    {

        $data = $request->all();
    
        $this->dislike_service->createDislike($data,$movieId);
          
        $movies = Movie::with('genre','likes','dislikes')->get();
        
        return response()->json($movies);
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dislike  $dislike
     * @return \Illuminate\Http\Response
     */
    public function show(Dislike $dislike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dislike  $dislike
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dislike $dislike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dislike  $dislike
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dislike $dislike)
    {
        //
    }
}
