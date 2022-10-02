<?php 


namespace App\Models\Movies\Services;

use App\Models\Genres\Services\GenreService;
use App\Models\Movie;

class MovieService {

    public GenreService $genre_service;

    public function __construct(GenreService $genre_service)
    {
        $this->genre_service = $genre_service;
    }


    public function create($data) {
        
        $genre = $this->genre_service->create($data);
        // $this->genre_service->create(Arr::get('genre'));

        // Genre::create([ 
        //     'genre' => $genre_name
        // ]);
        $movie = new Movie();
        
        $movie->title = $data['movies']['title'];
        $movie->description = $data['movies']['description'];
        $movie->image = $data['movies']['image'];
        
        $genre->movies()->save($movie);

        return $movie;
    }
}