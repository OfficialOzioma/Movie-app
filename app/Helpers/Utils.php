<?php

namespace App\Helpers;

use App\Models\MoviesList;
use Illuminate\Support\Facades\Http;

class Utils
{
    public $response;

    public function checkMoviesList($movie_id): bool
    {
        $movie = MoviesList::where('movie_id', $movie_id)->first();

        if ($movie == null) {
            return false;
        }

        return true;
    }

    public function makeHTTPRequest($url, $token, $method, $data =null)
    {
        if($data !== null){
            $this->response = Http::withToken($token)->$method($url, $data)->json()[$data];
        }else{
            $this->response = Http::withToken($token)->$method($url, $data)->json();
        }

        return $this->response;
    }
}
