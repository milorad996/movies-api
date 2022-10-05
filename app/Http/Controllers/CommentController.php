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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$movieId)
    {

        $per_page = $request->query('per_page',5);

        $comments = Comment::where(['movie_id' => $movieId])->paginate($per_page);

        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request,$movieId)
    {

        $data = $request->all();
        $this->comment_service->create($data,$movieId);

        //$comment = Movie::with('genre','likes','dislikes','comments')->find($movieId);
        $comments = Comment::where(['movie_id' => $movieId])->get();


        return response()->json($comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
