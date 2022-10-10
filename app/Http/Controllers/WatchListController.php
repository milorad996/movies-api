<?php

namespace App\Http\Controllers;

use App\Http\Requests\WatchListRequest;
use App\Models\Movie;
use App\Models\WatchList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WatchListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;

        $lists = WatchList::with('movie')->where(['user_id' => $id, 'onWatchlist' => true] )->get();

        return response()->json($lists);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function watched(WatchListRequest $request,$id)
    {

        $userId = Auth::user()->id;
        


        $watchlist = WatchList::find($id);
        
        $watch = WatchList::with('movie')->where(['id' => $id, 'watched' => true])->get();

        $watchlist->user_id = Auth::user()->id;
        $watchlist->watched = $request->watched;

        if($watch->isEmpty()){
            $watchlist->save();
        }

        $lists = WatchList::with('movie')->where(['user_id' => $userId, 'onWatchlist' => true] )->get();


        return response()->json($lists);
    }

    public function addToWatchlist(WatchListRequest $request,$movieId){


        $id = Auth::user()->id;


        $watchList = new WatchList();

        $watchList->user_id = Auth::user()->id;
        $watchList->movie_id = $movieId;
        $watchList->onWatchlist = $request->onWatchlist;
        $watch = WatchList::with('movie')->where(['movie_id' => $movieId, 'onWatchlist' => true, 'user_id' => $id])->get();
        

        if($watch->isEmpty()){
            $watchList->save();

        }

        
        


        $lists = WatchList::with('movie')->where(['user_id' => $id, 'onWatchlist' => true] )->get();

        return response()->json($lists);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function removeFromWatchlist($movieId){

        $id = Auth::user()->id;

        WatchList::with('movie')->where(['movie_id' => $movieId ,'user_id' => $id] )->delete();
        $lists = WatchList::with('movie')->where(['user_id' => $id, 'onWatchlist' => true] )->get();
        return response()->json($lists);
    }


    public function show(WatchList $watchList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WatchList $watchList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function destroy(WatchList $watchList)
    {
        //
    }
}
