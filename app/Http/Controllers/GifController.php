<?php

namespace App\Http\Controllers;

use App\Gif\Giphy;

class GifController extends Controller
{

    public function search(string $word, int $limit = 25, int $offset = 0, string $lang = "en"): array
    {
        return Giphy::searchGif($word, $limit, $offset, $lang);
    }

    public function random(string $tag = ''): array
    {
        return Giphy::randomGif($tag);
    }

}
