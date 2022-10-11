<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;


    protected $fillable = [
        'content',
        
    ];

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    public static function getCommentsWithPagination($movieId,$per_page){
        return self::where(['movie_id' => $movieId])->paginate($per_page);
    }

    public static function getComments($movieId){
        return self::where(['movie_id' => $movieId])->get();
    }
}
