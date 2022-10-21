<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use App\Services\MoviesServices;
use Illuminate\Support\Facades\Cache;


class MovieController extends Controller
{
    public $moviesServices;

    public function __construct()
    {
        $this->moviesServices = new MoviesServices();
    }
    /**
     * Display a listing of the movies.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // $movies = Cache::remember('movies', 30, function () {
        //     return $this->moviesServices->getMovieFromAPI();
        // });

        $movies =  $this->moviesServices->getMovieFromAPI();

        return view('movie.index', [
            'popularMovies' => $movies['popularMovies'],
            'upcomingMovies' => $movies['upcomingMovies']
        ]);
    }

    /**
     * Display the specified movie.
     * It accepts the movie id as parameter
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $showMovies =  Cache::remember($id, 60, function () use ($id) {
            return $this->moviesServices->showMoviesDetails($id);
        });

        return view('movie.show', [
            'movie' => $showMovies['movie'],
            'movieRecommendations' => $showMovies['movieRecommendations']
        ]);
    }
}