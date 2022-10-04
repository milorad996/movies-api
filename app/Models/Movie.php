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
       return self::where('title','like','%'. $term . '%')->with('genre');
    }

    public function likeDislike() {
        return $this->hasMany(Like::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

   

    

    

    

    

    
}