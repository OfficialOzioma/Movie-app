<?php

namespace App\Services;

use App\Helpers\Utils;
use App\Models\MoviesList;

class MoviesServices
{
    protected $baseUrl;
//
    protected $token;

    protected $utils;

    public function __construct()
    {
        $this->utils = new Utils();

        $this->baseUrl =config('movies.baseUrl');
        $this->token =  config('movies.token');
    }

    public function getMovieFromAPI(): array
    {
        $popularMovies = $this->utils->makeHTTPRequest($this->baseUrl . 'movie/popular', $this->token, 'get', 'results');
        $upcomingMovies = $this->utils->makeHTTPRequest($this->baseUrl . 'movie/upcoming', $this->token, 'get', 'results');

        return [
            'popularMovies' => $popularMovies,
            'upcomingMovies' => $upcomingMovies
        ];
    }

    public function showMoviesDetails($id): array
    {
        $movie = $this->utils->makeHTTPRequest($this->baseUrl . 'movie/' . $id . '?append_to_response=credits,images,videos', $this->token, 'get');
        $movieRecommendations = $this->utils->makeHTTPRequest($this->baseUrl . 'movie/' . $id . '/recommendations', $this->token, 'get', 'results');

        return [
            'movie' => $movie,
            'movieRecommendations' => $movieRecommendations
        ];
    }

    public function addToList($data)
    {
        $getmoviesListCount = MoviesList::where('user_id', auth()->user()->id)->count();

        if ($getmoviesListCount == 10) {
            return [
                "status" => 'warning',
                "message" => "You can only save 10 movies",
            ];
        }
        $movie = new MoviesList();
        $movie->user_id = auth()->user()->id;
        $movie->movie_id = $data['movie_id'];
        $movie->title = $data['title'];
        $movie->poster_path = $data['poster_path'];
        $movie->vote_average = $data['vote_average'];
        $movie->release_date = $data['release_date'];
        $movie->overview = $data['overview'];
        $movie->backdrop_path = $data['backdrop_path'];

        $saveMovies =  $movie->save();

        if ($saveMovies) {
            return [
                "status" => 'success',
                "message" => "Movie saved successfully",
            ];
        } else {
            return [
                "status" => 'error',
                "message" => "Something went wrong",
            ];
        }
    }

    public function showMovie($movie_id)
    {
        $movie = MoviesList::where('movie_id', $movie_id)->first();

        if (empty($movie)) {
            return [
                "status" => 'error',
                "message" => "Movie not found",
            ];
        }

        return [
            "status" => 'success',
            "message" => "Movie found",
            "data" => $movie

        ];
    }


    public function deleteMovie($movie_id)
    {
        // $util = new Utils();
        $deleteMovie = MoviesList::where('movie_id', $movie_id)->first()->delete();

        if ($deleteMovie) {
            return [
                "status" => 'success',
                "message" => "Movie deleted successfully",
            ];
        } else {
            return [
                "status" => 'error',
                "message" => "Something went wrong",
            ];
        }
    }

    public  function getAllMovies()
    {
        $movies = MoviesList::where('user_id', auth()->user()->id)->get();

        if (empty($movies)) {
            return [
                "status" => 'warning',
                "message" => "No movies found",
            ];
        }

        return [
            "status" => 'success',
            "message" => "Movies found",
            "data" => $movies

        ];
    }
}
