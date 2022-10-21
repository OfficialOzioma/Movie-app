<?php

namespace App\Services;

use App\Helpers\Utils;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;

class ActorsServices
{
    /**
     * @var Repository|Application|mixed
     */
    protected $baseUrl;

    /**
     * @var Utils
     */
    protected $utils;
    /**
     * @var Repository|Application|mixed
     */
    protected $token;

    public function __construct()
    {
        $this->utils = new Utils();

        $this->baseUrl =config('movies.baseUrl');
        $this->token =  config('movies.token');
    }

    /**
     * @param $page
     * @return array
     */
    public function getPopularActors($page): array
    {
        return $this->utils->makeHTTPRequest($this->baseUrl . 'person/popular?page=' . $page, $this->token, 'get', 'results');
    }

    public function showActorDetails($id)
    {
        return $this->utils->makeHTTPRequest($this->baseUrl . 'person/' . $id . '?append_to_response=combined_credits', $this->token, 'get' );
    }
}
