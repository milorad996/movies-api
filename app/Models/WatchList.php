<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    use HasFactory;

    protected $fillable = [
        'watched'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function movie(){
        return $this->belongsTo(Movie::class);
    }

    public static function getUniqueWatchlist($id){
        return self::with('movie')->where(['user_id' => $id, 'onWatchlist' => true] )->get();
    }

    public static function getWatchlist($userId){
        return self::with('movie')->where(['user_id' => $userId, 'onWatchlist' => true] )->get();
    }

    public static function deleteWatchlist($movieId,$userId){
        return self::with('movie')->where(['movie_id' => $movieId ,'user_id' => $userId] )->delete();
    }

    public static function getWatchlistWithMovie($id){
        return self::with('movie')->where(['id' => $id, 'watched' => true])->get();
    }

    public static function getWatchlistWithUserMovie($movieId,$id){
        return self::with('movie')->where(['movie_id' => $movieId, 'onWatchlist' => true, 'user_id' => $id])->get();
    }


}
