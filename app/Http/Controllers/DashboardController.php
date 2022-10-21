<?php

namespace App\Http\Controllers;

use App\Models\MoviesList;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Traits\RequestResponse;
use App\Services\MoviesServices;
use Illuminate\Routing\Redirector;


class DashboardController extends Controller
{
    use RequestResponse;

    public $moviesServices;

    public function __construct()
    {
        $this->moviesServices = new MoviesServices();
    }


    /**
     *  This get all the movie saved by the user
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        // GET ALL THE SAVED MOVIES FOR THIS USER
        $data = [];

        $allMovies = $this->moviesServices->getAllMovies();

        if ($allMovies['status'] == 'success') {
            $data['movies'] = $allMovies['data'];
        } else {
            $data['movies'] = [];
        }

        return view('dashboard.index', $data);
    }

    /**
     *  This method stores a movie in the users movie list
     *
     * @param Request $request
     * @return array
     */
    public function save(Request $request): array
    {
        // SAVE A MOVIE IN THE MOVIE LIST

        $data = [
            'movie_id' => $request->movie_id,
            'title' => $request->title,
            'poster_path' => $request->poster_path,
            'vote_average' => $request->vote_average,
            'release_date' => $request->release_date,
            'overview' => $request->overview,
            'backdrop_path' => $request->backdrop_path,
        ];

        $saveMovie = $this->moviesServices->addToList($data);

        if ($saveMovie['status'] == 'error') {

            return [
                "status" => 'error',
                "message" => $saveMovie['message'],

            ];
        }

        if ($saveMovie['status'] == 'warning') {

            return [
                "status" => 'warning',
                "message" => $saveMovie['message'],

            ];
        }


        return [
            "status" => 'success',
            "message" => $saveMovie['message'],
        ];
    }

    /**
     * This deletes a movie from the users Movie list
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function delete(Request $request)
    {
        // DELETE A MOVIE WITH THE ID OF $request->movie_id
        $movie_id = $request->movie_id;

        $deleteMovie = $this->moviesServices->deleteMovie($movie_id);

        if ($deleteMovie['status'] == 'error') {

            return $this->error($deleteMovie['message'], []);
        }

        return $this->success($deleteMovie['message'], [], '/dashboard');
    }
}
