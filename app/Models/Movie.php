<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

use PDO;



class Movie extends Model 
{
    use ElasticquentTrait;
    use HasFactory;

    


    protected $fillable = [
        'title',
        'description',
        'image',
        'genre_id'
        
    
        

    ];

    public function genre(){
        return $this->belongsTo(Genre::class);
    }

    public static function getByTerm($term){
       return self::where('title','like','%'. $term . '%')->with('genre','likes','dislikes','watchlists');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function dislikes(){
        return $this->hasMany(Dislike::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function watchlists(){
        return $this->hasMany(WatchList::class);
    }

    public static function filterByGenre($filterTerm){
        return self::with('genre','likes','dislikes','watchlists')->whereHas('genre', function ($genre) use ($filterTerm) {
            $genre->where('genre','like','%'. $filterTerm . '%');
        });
    }

    public static function getMoviesWithLikesAndDislikes(){
        return self::with('genre','likes','dislikes','watchlists')->get();
    }

    public static function getMovieById($movie){
        return self::with('genre','likes','dislikes','comments','watchlists')->where('id', $movie->id)->first();
    }

    public static function getMoviesByGenre($filterTerm){
        return self::with('genre','likes','dislikes','watchlists')->whereHas('genre', function ($genre) use ($filterTerm) {
            $genre->where('genre','like','%'. $filterTerm . '%');
        });
    }

    public static function getMovie($movie){
        return self::with('genre','likes','dislikes','watchlists')->find($movie->id);
    }

    public static function getPopularMovies(){
        return self::with('genre','likes','dislikes')->paginate(10);
    }

    public static function getMoviesWithPagination($per_page){
        return self::orderBy('created_at','desc')->with('genre','likes','dislikes','watchlists')->paginate($per_page);
    }

    public static function getMoviesByElasticsearch($term){
        return self::complexSearch(array(
            'body' => array(
                'query' => array(
                    'bool' => array(
                        'must' => array(
                            'multi_match' => array(
                                'query' => $term,
                                'fields' => ['title']
                            )
                               
                                
                        
                            ),
                        )
                        )
                        )
               ),
               
                
            );
    }


    protected $indexSettings = [
        'analysis' => [
            'char_filter' => [
                'replace' => [
                    'type' => 'mapping',
                    'mappings' => [
                        '&=> and ',
                    
                    ],
                ],
            ],
            'filter' => [
                'word_delimiter' => [
                    'type' => 'word_delimiter',
                    'split_on_numerics' => false,
                    'split_on_case_change' => true,
                    'generate_word_parts' => true,
                    'generate_number_parts' => true,
                    'catenate_all' => true,
                    'preserve_original' => true,
                    'catenate_numbers' => true,
                ]
            ],
            'analyzer' => [
                'default' => [
                    'type' => 'custom',
                    'char_filter' => [
                        'html_strip',
                        'replace',
                    ],
                    'tokenizer' => 'whitespace',
                    'filter' => [
                        'lowercase',
                        'word_delimiter',
                    ],
                ],
            ],
        ],
    ];

    protected $mappingProperties = array(
        'title' => array(
             'type' => 'string',
             'analyzer' => 'standard'
         )
     );

   

    

    

    

    

    
}