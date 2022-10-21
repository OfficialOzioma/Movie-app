<?php

namespace App\Http\Controllers;

use App\Services\ActorsServices;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;

class ActorController extends Controller
{
    /**
     * @var ActorsServices
     */
    public $actorsServices;

    public function __construct()
    {

        $this->actorsServices = new ActorsServices();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index($page = 1)
    {
        $actorPopular =  Cache::remember($page, 60, function () use ($page) {
            return $this->actorsServices->getPopularActors($page);
        });

        $data['actors'] = $actorPopular;

        return view(
            'actor.index',
            $data
        );
    }

    /**
     * Display the details of a specified Actor.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        $actors =  Cache::remember($id, 60, function () use ($id) {
            return $this->actorsServices->showActorDetails($id);
        });

        $data['actors'] = $actors;

        dd($data);

        return view('actor.show', $data);
    }
}