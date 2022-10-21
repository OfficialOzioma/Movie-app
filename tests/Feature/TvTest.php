<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class TvTest extends TestCase
{

    public function testGetAllTv()
    {
        // test get all tv
        $response = $this->getJson(route('tv.index'))->assertOk();

        $this->assertIsArray(array($response));
    }
}