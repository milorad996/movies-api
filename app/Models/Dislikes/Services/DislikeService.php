<?php



namespace App\Models\Dislikes\Services;

use App\Models\Dislike;
use Illuminate\Support\Facades\Auth;

class DislikeService {
    public function createDislike($data,$movieId){


        $userId = Auth::user()->id;

        $newDislike = new Dislike();
        $newDislike->dislike = $data['dislikes']['dislike'];
        $newDislike->user_id = Auth::user()->id;
        $newDislike->movie_id = $movieId;

        $dislike = Dislike::with('user')->where(['user_id' => $userId, 'movie_id' => $movieId, 'dislike' => true])->get();
        $dislikes = Dislike::with('user')->where(['user_id' => $userId, 'movie_id' => $movieId, 'dislike' => true]);
        if($dislike->isEmpty()){
            $newDislike->save();

        }else{
            $dislikes->delete();
        }
    }
}