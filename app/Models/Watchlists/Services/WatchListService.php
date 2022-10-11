<?php


namespace App\Models\Watchlists\Services;

use App\Models\WatchList;
use Illuminate\Support\Facades\Auth;

class WatchListService {
    public function create($data,$id){
        $watchlist = WatchList::find($id);
        
        $watch = WatchList::getWatchlistWithMovie($id);

        $watchlist->user_id = Auth::user()->id;
        $watchlist->watched = $data['watched'];

        if($watch->isEmpty()){
            $watchlist->save();
        }
    }

    public function createWatchlist($data,$movieId){

        $id = Auth::user()->id;


        $watchList = new WatchList();

        $watchList->user_id = Auth::user()->id;
        $watchList->movie_id = $movieId;
        $watchList->onWatchlist = $data['onWatchlist'];
        $watch = WatchList::getWatchlistWithUserMovie($movieId,$id);
        

        if($watch->isEmpty()){
            $watchList->save();

        }
    }
}