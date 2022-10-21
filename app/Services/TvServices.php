<?php

namespace App\Services;

use App\Helpers\Utils;

class TvServices
{
    protected $baseUrl;
    //
    protected $token;

    protected $utils;

    public function __construct()
    {
        $this->utils = new Utils();

        $this->baseUrl = config('movies.baseUrl');
        $this->token =  config('movies.token');
    }

    public function getAllTvs(): array
    {
        $popularTv = $this->utils->makeHTTPRequest($this->baseUrl . 'tv/popular', $this->token, 'get', 'results');
        $topRatedTv = $this->utils->makeHTTPRequest($this->baseUrl . 'tv/top_rated', $this->token, 'get', 'results');

        return [
            'popularTv' => $popularTv,
            'topRatedTv' => $topRatedTv
        ];
    }

    public function showTvDetails($id)
    {
        $tvDetails = $this->utils->makeHTTPRequest($this->baseUrl . 'tv/' . $id . '?append_to_response=credits,images,videos', $this->token, 'get');
        $tvRecommendations = $this->utils->makeHTTPRequest($this->baseUrl . 'tv/' . $id . '/recommendations', $this->token, 'get', 'results');

        return [
            'tvDetails' => $tvDetails,
            'tvRecommendations' => $tvRecommendations
        ];
    }
}