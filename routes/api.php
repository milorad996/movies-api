<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DislikeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/profile', [AuthController::class, 'getMyProfile'])->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('/refresh-token', [AuthController::class, 'refreshToken']);

Route::get('/movies',[MovieController::class,'index']);
Route::get('/movies/{movie}',[MovieController::class, 'show']);
Route::post('/movies',[MovieController::class,'store']);
Route::get('/movies-search',[MovieController::class,'search']);
Route::get('/movies-filter',[MovieController::class,'filter']);

Route::get('/movies-likes',[LikeController::class,'index']);
Route::post('/movies/{id}/likes',[LikeController::class,'createLike']);
Route::post('/movies/{id}/dislikes',[DislikeController::class,'createDislike']);

Route::post('/movies/{id}/comments',[CommentController::class,'store']);
Route::get('/comments/{id}',[CommentController::class,'index']);
Route::get('/movies/movies/comments/{id}',[CommentController::class,'index']);
