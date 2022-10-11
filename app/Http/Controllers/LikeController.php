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
    
    

   
    public function createLike(Request $request,$movieId)
    {

        $data = $request->all();
    
        $this->like_service->createLike($data,$movieId);
        
         
        $movies = Movie::getMoviesWithLikesAndDislikes();
        
        return response()->json($movies);
    }
        

    


        


    
    

    
}
