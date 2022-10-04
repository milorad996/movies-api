<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre',
        
    ];

    public function movies(){
        return $this->hasMany(Movie::class);
    }


    public static function filterByGenre($term){
        return self::where('genre','like','%'. $term . '%')->with('movies');
     }



}
