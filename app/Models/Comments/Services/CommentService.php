<?php



namespace App\Models\Comments\Services;

use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentService {
    public function create($data,$movieId){
        $comment = new Comment();
        $comment->content = $data['content'];
        $comment->user_id = Auth::user()->id;
        $comment->movie_id = $movieId;
        $comment->save();
    }
}