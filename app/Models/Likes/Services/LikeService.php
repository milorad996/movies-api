<?php 



namespace App\Models\Likes\Services;

use App\Models\Like;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeService {


    public function createLike($data,$movieId){

        
        $userId = Auth::user()->id;

        
        



        $newLike = new Like();
        $newLike->like = $data['likes']['like'];
        $newLike->user_id = Auth::user()->id;
        $newLike->movie_id = $movieId;
        
        $like = Like::getLikes($userId,$movieId)->get();
        $likes = Like::getLikes($userId,$movieId);
        if($like->isEmpty()){
            $newLike->save();

        }else{
            $likes->delete();
        }
        
        
        

        
    }
   
}