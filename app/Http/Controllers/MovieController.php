<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Requests\MovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Movies\Services\MovieService;
use ArrayObject;

class MovieController extends Controller
{
    public MovieService $movie_service;

    public function __construct(MovieService $movie_service)
    {
        $this->movie_service = $movie_service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
        $per_page = $request->query('per_page',10);
        $movies = Movie::with('genre','likes','dislikes')->paginate($per_page);
        

        return response()->json($movies);
       
        
    }
    public function popular(){
        $movies = Movie::with('genre','likes','dislikes')->paginate(10);
        
        
        $newMovies = $movies->sortBy('likes', SORT_REGULAR, true );

        
    
        return response()->json($newMovies->values());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function search(Request $request){
          $term = $request->query('title');
          $per_page = $request->query('per_page',10);
        
          $movies = Movie::getByTerm($term)->paginate($per_page);
          $count = $movies->count();
          return response()->json([
            "movies" => $movies,
            "count" => $count,
    
          ]);
    }

    public function filter(Request $request){
        $filterTerm = $request->query('genre');
        $per_page = $request->query('per_page',10);
        
        $genre = Genre::filterByGenre($filterTerm)->paginate($per_page);
        
        
        return response()->json($genre);
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        

        $data = $request->all();
        $movie = $this->movie_service->create($data);
         
        return response()->json($movie->with('genre')->get()->last());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Movie $movie)
    {   
        $url = $request->url();
        if(!!$url){
           $movie->review = $movie->review + 1;
           $movie->save();
           
        }
        $movie = Movie::with('genre','likes','dislikes','comments')->where('id', $movie->id)->first();
        
        return response()->json($movie);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
