<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\DashboardController;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MoviesTest extends TestCase
{

    public function testGetAllMoviesList()
    {
        // test get all movies
        $response = $this->getJson(route('movie.index'))->assertOk();

        $this->assertIsArray(array($response));
    }
}