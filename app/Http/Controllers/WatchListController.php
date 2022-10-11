<?php

namespace App\Http\Controllers;

use App\Http\Requests\WatchListRequest;
use App\Models\Movie;
use App\Models\WatchList;
use App\Models\Watchlists\Services\WatchListService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchListController extends Controller
{
    public WatchListService $watchlist_service;

    public function __construct(WatchListService $watchlist_service)
    {
        $this->watchlist_service = $watchlist_service;
    }
    
    public function index()
    {
        $id = Auth::user()->id;

        $lists = WatchList::getUniqueWatchlist($id);

        return response()->json($lists);
    }

   
    public function watched(WatchListRequest $request,$id)
    {

        $userId = Auth::user()->id;
        
        $data = $request->all();

        $this->watchlist_service->create($data,$id);

        $lists = WatchList::getWatchlist($userId);


        return response()->json($lists);
    }

    public function addToWatchlist(WatchListRequest $request,$movieId){

        $data = $request->all();

        $this->watchlist_service->createWatchlist($data,$movieId);
        

        $userId = Auth::user()->id;
        $lists = WatchList::getWatchlist($userId);

        return response()->json($lists);
    }

   
    public function removeFromWatchlist($movieId){

        $userId = Auth::user()->id;

        WatchList::deleteWatchlist($movieId,$userId);
        $lists = WatchList::getWatchlist($userId);
        return response()->json($lists);
    }


    
}
