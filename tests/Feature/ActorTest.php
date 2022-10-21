<?php

namespace Tests\Feature;

use App\Http\Controllers\ActorController;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ActorTest extends TestCase
{
    public function testGetAllActors()
    {

        $response = $this->getJson(route('actor.index'))->assertOk();

        $this->assertIsArray(array($response));
    }
}
