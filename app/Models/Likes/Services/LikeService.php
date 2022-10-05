<?php 



namespace App\Models\Likes\Services;

use App\Models\Like;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LikeService {


    public function createLike($data,$movieId){

        
        //$id = Auth::user()->id;

        
        // $user = new User();
        // $user = User::where(['id' => $id])->with('likeDislike')->get();
        //$movie = Movie::where(['id' => $movieId]);
        // $movie = Movie::where(['id' => $movieId])->with('likeDislike')->get();
        //$like = Like::where(['user_id' => $id])->get();




        //$movie = Movie::find($movieId)->likeDislike('like','dislike')->first();
        //$movie->likeDislike()->get();

        // return response()->json([
        //     "user" => $user[0]->first_name,
        //     "like" => $like[0]->like,
        //     "movie" => $movie[0]->like
        // ]);



        $newLike = new Like();
        $newLike->like = $data['likes']['like'];
        $newLike->user_id = Auth::user()->id;
        $newLike->movie_id = $movieId;
        $newLike->save();
        
        
        

        
    }
   
}