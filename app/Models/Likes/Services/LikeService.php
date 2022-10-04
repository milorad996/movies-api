<?php 



namespace App\Models\Likes\Services;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeService {


    public function createLike($data,$movieId){
        $newLike = new Like();
        $newLike->like = $data['likeDislike']['like'];
        $newLike->user_id = Auth::user()->id;
        $newLike->movie_id = $movieId;

        

        $newLike->save();
    }
    public function createDislike($data,$movieId){
        $newDislike = new Like();
        $newDislike->dislike = $data['likeDislike']['dislike'];
        $newDislike->user_id = Auth::user()->id;
        $newDislike->movie_id = $movieId;

        $newDislike->save();
    }
}