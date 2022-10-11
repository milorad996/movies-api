<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'user_id',
        'movie_id'
        
    
        

    ];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function getLikes($userId,$movieId){
        return self::with('user')->where(['user_id' => $userId, 'movie_id' => $movieId, 'like' => true]);
    }

    
}
