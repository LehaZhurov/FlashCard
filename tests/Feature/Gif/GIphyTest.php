<?php

namespace Tests\Feature\Gif;

use App\Gif\Giphy;
use Tests\TestCase;

class GiphyTest extends TestCase
{


    public function test_general_search()
    {
        $count = 30;
        $result = Giphy::newClient()->generalSearch('add',$count);
        $index = rand(0,($count-1));
        $this->assertEquals($count, count($result));
        $this->assertIsArray($result);
        $this->assertIsArray($result[$index]);
        $this->assertIsString($result[$index]['id']);
        $this->assertIsString($result[$index]['page_url']);
        $this->assertIsString($result[$index]['src']);
        $this->assertIsString($result[$index]['powered']);
    }

    public function test_search_gif()
    {
        $count = 30;
        $result = Giphy::newClient()->searchGifs('add',$count);
        $index = rand(0,($count-1));
        $this->assertEquals($count, count($result));
        $this->assertIsArray($result);
        $this->assertIsArray($result[$index]);
        $this->assertIsString($result[$index]['id']);
        $this->assertIsString($result[$index]['page_url']);
        $this->assertIsString($result[$index]['src']);
        $this->assertIsString($result[$index]['powered']);
    }

    public function test_search_stikers()
    {
        $count = 30;
        $result = Giphy::newClient()->searchStikers('add',$count);
        $index = rand(0,($count-1));
        $this->assertEquals($count, count($result));
        $this->assertIsArray($result);
        $this->assertIsArray($result[$index]);
        $this->assertIsString($result[$index]['id']);
        $this->assertIsString($result[$index]['page_url']);
        $this->assertIsString($result[$index]['src']);
        $this->assertIsString($result[$index]['powered']);
    }

    public function test_random_gif_and_stikers()
    {
        $result = Giphy::newClient()->random('add');
        $this->assertIsArray($result);
        $this->assertIsString($result['id']);
        $this->assertIsString($result['page_url']);
        $this->assertIsString($result['src']);
        $this->assertIsString($result['powered']);
    }

    public function test_random_stiker()
    {
        $result = Giphy::newClient()->randomStiker('add');
        $this->assertIsArray($result);
        $this->assertIsString($result['id']);
        $this->assertIsString($result['page_url']);
        $this->assertIsString($result['src']);
        $this->assertIsString($result['powered']);
    }

    public function test_random_gif()
    {
        $result = Giphy::newClient()->randomGif('add');
        $this->assertIsArray($result);
        $this->assertIsString($result['id']);
        $this->assertIsString($result['page_url']);
        $this->assertIsString($result['src']);
        $this->assertIsString($result['powered']);
    }
}
