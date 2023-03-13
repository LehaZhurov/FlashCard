<?php

namespace Tests\Feature\Gif;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GifControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_success_search()
    {
        $path = 'api/gif/search/add/10';
        $response = $this->get($path);
        $response->assertStatus(200);
    }

    public function test_empty_search()
    {
        $path = 'api/gif/search';
        $response = $this->get($path);
        $response->assertStatus(404);
    }

    public function test_success_random(){
        $path = 'api/gif/random';
        $response = $this->get($path);
        $response->assertStatus(200);
    }
}