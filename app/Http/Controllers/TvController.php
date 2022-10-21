<?php

namespace App\Http\Controllers;

use App\Services\TvServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class TvController extends Controller
{
    /**
     * @var TvServices
     */
    public $tv_services;

    public function __construct()
    {
        $this->tv_services = new TvServices();
    }


    /**
     * Display a listing of all Tv shows.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $tvs =  Cache::remember('Tvs', 30, function () {
            return $this->tv_services->getAllTvs();
        });

        return view('tv.index', [
            'popularTv' => $tvs['popularTv'],
            'topRatedTv' => $tvs['topRatedTv']
        ]);
    }


    /**
     * This show details of a TV shows
     *  it uses the Tv id as a parameter
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $tv =  Cache::remember($id, 60, function () use ($id) {
            return $this->tv_services->showTvDetails($id);
        });

        return view('tv.show', [
            'tvDetails' => $tv['tvDetails'],
            'tvRecommendations' => $tv['tvRecommendations']
        ]);
    }
}
