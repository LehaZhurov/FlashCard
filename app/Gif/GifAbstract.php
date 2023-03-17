<?php

namespace App\Gif;

abstract class GifAbstract
{
    abstract public static function newClient();

    abstract public function generalSearch(string $q, int $limit, int $ofset, string $lang): array;

    abstract public function searchGifs(string $q, int $limit, int $ofset, string $lang): array;

    abstract public function searchStikers(string $q, int $limit, int $ofset, string $lang): array;

    abstract public function random(string $tag): array;

    abstract public function randomGif(string $tag): array;

    abstract public function randomStiker(string $tag): array;
}
