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
    


    public function createDislike(Request $request,$movieId)
    {

        $data = $request->all();
    
        $this->dislike_service->createDislike($data,$movieId);
          
        $movies = Movie::getMoviesWithLikesAndDislikes();
        
        return response()->json($movies);
    }

     

    
}
