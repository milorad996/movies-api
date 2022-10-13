<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Http\Requests\MovieRequest;
use App\Mail\MovieMail;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Movies\Services\MovieService;
use ArrayObject;
use Doctrine\DBAL\Schema\View;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\Cast\Object_;

class MovieController extends Controller
{
    public MovieService $movie_service;
    public function __construct(MovieService $movie_service)
    {
        $this->movie_service = $movie_service;
    }
    
    public function index(Request $request)
    {
       
        $per_page = $request->query('per_page',10);
        $movies = Movie::getMoviesWithPagination($per_page);
        

        return response()->json($movies);
       
        
    }
    public function popular(){
        $movies = Movie::getPopularMovies();
        
        
        $newMovies = $movies->sortBy('likes', SORT_REGULAR, true );

        
    
        return response()->json($newMovies->values());
    }

    public function movieByGenre(Request $request){

        $filterTerm = $request->query('genre');
        
    
        $movies = Movie::getMoviesByGenre($filterTerm);
    
           
        
           
    

        return response()->json($movies->get());
    
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
        
       
       
        $movies = Movie::filterByGenre($filterTerm)->paginate($per_page);
        $count = $movies->count();
        
        return response()->json([
            "movies" => $movies,
            "count" => $count
        ]);
    }
       
    
    public function store(Request $request)
    {
        
        

        $data = $request->all();
        $movie = $this->movie_service->create($data);
         
        Movie::addAllToIndex();

    
    	Mail::to('a0e81d5f81-52b522@inbox.mailtrap.io')->send(new MovieMail($movie));
    

        

        return response()->json($movie->with('genre','likes','dislikes','watchlists')->get()->last());
    }

    
    public function show(Request $request,Movie $movie)
    {   
        $url = $request->url();
        if(!!$url){
           $movie->review = $movie->review + 1;
           $movie->save();
           
        }
        $movie = Movie::getMovieById($movie);
        
        return response()->json($movie);
    }

    

    public function elasticSearch(Request $request){

        $term = $request->query('term');
        $movie = Movie::addAllToIndex();
        
    
        $movies = Movie::getMoviesByElasticsearch($term);
        

        foreach($movies as $movie){

            $newMovies[] = Movie::getMovie($movie);
            

        
            
        }
        $count = $movies->count();


        
        
        return response()->json([
            "movies" => $newMovies,
            "count" => $count
        ]);
    }

    
    
}
