<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'like',
        'dislike',
        'user_id',
        'movie_id'
        
    
        

    ];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    
}
