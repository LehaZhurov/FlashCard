<?php

namespace App\Gif;

use stdClass;

class Giphy
{
    private $token = 'oWdBUpIKGSnNMPKBQSR03Sj1WjTrcII8';
    private $url = 'https://api.giphy.com/v1/gifs/';

    private function search(string $q, int $limit = 50, int $ofset = 0, string $lang = 'en'): array
    {
        $q = str_replace(' ', '+', $q);
        $endpoint = $this->url .
        'search?api_key=' . $this->token .
            '&q=' . $q .
            '&limit=' . $limit .
            '&ofset=' . $ofset .
            '&rating=g' .
            '&lang=' . $lang;
        $searchResult = file_get_contents($endpoint);
        $result = $this->highlightRequiredFromSearchResult(json_decode($searchResult));
        return $result;
    }

    private function random(string $tag): array
    {
        $tag = str_replace(' ', '+', $tag);
        $endpoint = $this->url .
        'random?api_key=' . $this->token .
            '&tag=' . $tag .
            '&rating=g';
        $searchResult = file_get_contents($endpoint);
        $searchResult = json_decode($searchResult);
        $result = $this->highlightRequiredFromSearchedItem($searchResult->data);
        $result['meta'] = (array) $searchResult->meta;
        return $result;
    }

    private function highlightRequiredFromSearchedItem(stdClass $searchItem)
    {

        $srcs = $searchItem->images->original;
        if (isset($srcs->webp)) { 
            $src = $srcs->webp;
        }else{
            $src = $srcs->url;
        }

        $necessary['id'] = $searchItem->id;
        $necessary['page_url'] = $searchItem->url;
        $necessary['src'] = $src;
        $necessary['powered'] = 'GIPHY.com';
        return $necessary;
    }

    private function highlightRequiredFromSearchResult(stdClass $searchResult): array
    {
        foreach ($searchResult->data as $key => $item) {
            $necessary['data'][] = $this->highlightRequiredFromSearchedItem($item);
        }
        // $necessary['pagination'] = (array) $searchResult->pagination;
        $necessary['meta'] = (array) $searchResult->meta;
        return $necessary;
    }

    public static function searchGif(string $q, int $limit = 25, int $ofset = 0, string $lang = 'en'): array
    {
        return (new self)->search($q, $limit, $ofset, $lang);
    }

    public static function randomGif(string $tag): array
    {
        return (new self)->random($tag);
    }

}
