<?php

namespace App\Http\Controllers;

use App\Gif\Giphy;
use App\Http\Resources\Gif\GIFResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GifController extends Controller
{

    public function search(string $word, int $limit = 25, int $offset = 0, string $lang = "en"): AnonymousResourceCollection
    {
        $gifs = Giphy::newClient()->generalSearch($word, $limit, $offset, $lang);
        return GIFResource::collection($gifs);
    }

    public function random(string $tag = ''): GIFResource
    {
        $gif = Giphy::newClient()->random($tag);
        return new GIFResource($gif);
    }

}
