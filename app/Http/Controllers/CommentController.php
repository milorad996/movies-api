<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Comments\Services\CommentService;
use App\Models\Like;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public CommentService $comment_service;

    public function __construct(CommentService $comment_service)
    {
        $this->comment_service = $comment_service;
    }
    
    public function index(Request $request,$movieId)
    {

        $per_page = $request->query('per_page',5);

        $comments = Comment::getCommentsWithPagination($movieId,$per_page);

        return response()->json($comments);
    }

   
    public function store(CommentRequest $request,$movieId)
    {

        $data = $request->all();
        $this->comment_service->create($data,$movieId);

        $comments = Comment::getComments($movieId);


        return response()->json($comments);
    }

    
}
