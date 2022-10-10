<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Likes\Services\LikeService;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Array_;

class LikeController extends Controller
{
    public LikeService $like_service;

    public function __construct(LikeService $like_service)
    {
        $this->like_service = $like_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($movieId)
    {
        $userId = Auth::user()->id;


        $movie = Like::with('user')->where(['user_id' => $userId, 'movie_id' => $movieId, 'like' => true])->get();
        return response()->json($movie->isEmpty());
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createLike(Request $request,$movieId)
    {

        $data = $request->all();
    
        $this->like_service->createLike($data,$movieId);
        
         
        $movies = Movie::with('genre','likes','dislikes','watchlists')->get();
        
        return response()->json($movies);
    }
        

        //return response()->json($movie);


        


    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Like $like)
    {
        //
    }
}
