<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'genre_id'
        
    
        

    ];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public static function getByTerm($term){
       return self::where('title','like','%'. $term . '%')->with('genre','likes','dislikes','watchlists');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function dislikes(){
        return $this->hasMany(Dislike::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function watchlists(){
        return $this->hasMany(WatchList::class);
    }

    public static function filterByGenre($filterTerm){
        return self::with('genre','likes','dislikes','watchlists')->whereHas('genre', function ($genre) use ($filterTerm) {
            $genre->where('genre','like','%'. $filterTerm . '%');
        });
    }

    public static function getMoviesWithLikesAndDislikes(){
        return self::with('genre','likes','dislikes','watchlists')->get();
    }

    public static function getMovieById($movie){
        return self::with('genre','likes','dislikes','comments','watchlists')->where('id', $movie->id)->first();
    }

    public static function getMoviesByGenre($filterTerm){
        return self::with('genre','likes','dislikes','watchlists')->whereHas('genre', function ($genre) use ($filterTerm) {
            $genre->where('genre','like','%'. $filterTerm . '%');
        });
    }

    public static function getPopularMovies(){
        return self::with('genre','likes','dislikes')->paginate(10);
    }

    public static function getMoviesWithPagination($per_page){
        return self::with('genre','likes','dislikes','watchlists')->paginate($per_page);
    }

   

    

    

    

    

    
}