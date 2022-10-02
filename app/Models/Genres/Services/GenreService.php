<?php



namespace App\Models\Genres\Services;

use App\Models\Genre;

class GenreService {
    public function create($data) {
        $genre = new Genre();
        $genre->genre = $data['genre'];
        $genre->save();

        return $genre;
    }
}