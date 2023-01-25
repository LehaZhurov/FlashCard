<?php

namespace App\Gif;

use stdClass;

class Giphy
{
    private $token = 'oWdBUpIKGSnNMPKBQSR03Sj1WjTrcII8';
    private $url = 'https://api.giphy.com/v1/';

    public function generalSearch(string $q, int $limit = 25, int $ofset = 0, string $lang = 'en'): array
    {
        $gifs = $this->searchGifs($q, $limit, $ofset, $lang);
        $stikers = $this->searchStikers($q, $limit, $ofset, $lang);
        $result = array_merge($gifs, $stikers);
        shuffle($result);
        $sliceResult = array_slice($result, 0, $limit);
        return $sliceResult;
    }

    public function searchGifs(string $q, int $limit = 25, int $ofset = 0, string $lang = 'en'): array
    {
        $q = str_replace(' ', '+', $q);
        $endpoint = $this->url .
        'gifs/search?api_key=' . $this->token .
            '&q=' . $q .
            '&limit=' . $limit .
            '&ofset=' . $ofset .
            '&rating=g' .
            '&lang=' . $lang;
        $searchResult = file_get_contents($endpoint);
        $result = $this->highlightRequiredFromSearchResult(json_decode($searchResult));
        return $result;
    }

    public function searchStikers(string $q, int $limit = 50, int $ofset = 0, string $lang = 'en'): array
    {
        $q = str_replace(' ', '+', $q);
        $endpoint = $this->url .
        'stickers/search?api_key=' . $this->token .
            '&q=' . $q .
            '&limit=' . $limit .
            '&ofset=' . $ofset .
            '&rating=g' .
            '&lang=' . $lang;
        $searchResult = file_get_contents($endpoint);
        $result = $this->highlightRequiredFromSearchResult(json_decode($searchResult));
        return $result;
    }

    public function random(string $tag): array
    {
        $zeroOrOne = rand(0, 1);
        if ($zeroOrOne == 1){
            return $this->randomGif($tag);
        }
        if ($zeroOrOne == 0) {
            return $this->randomStiker($tag);
        }
    }

    public function randomGif(string $tag): array
    {

        $tag = str_replace(' ', '+', $tag);
        $endpoint = $this->url .
        'gifs/random?api_key=' . $this->token .
            '&tag=' . $tag .
            '&rating=g';
        $searchResult = file_get_contents($endpoint);
        $searchResult = json_decode($searchResult);
        $result = $this->highlightRequiredFromSearchedItem($searchResult->data);
        return $result;
    }

    public function randomStiker(string $tag): array
    {
        $tag = str_replace(' ', '+', $tag);
        $endpoint = $this->url .
        'stickers/random?api_key=' . $this->token .
            '&tag=' . $tag .
            '&rating=g';
        $searchResult = file_get_contents($endpoint);
        $searchResult = json_decode($searchResult);
        $result = $this->highlightRequiredFromSearchedItem($searchResult->data);
        return $result;
    }

    private function highlightRequiredFromSearchedItem(stdClass $searchItem): array
    {

        $srcs = $searchItem->images->original;
        if (isset($srcs->webp)) {
            $src = $srcs->webp;
        } else {
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
            $necessary[] = $this->highlightRequiredFromSearchedItem($item);
        }
        return $necessary;
    }

    public static function newClient()
    {
        return (new self());
    }

}
