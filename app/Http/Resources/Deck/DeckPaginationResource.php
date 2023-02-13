<?php

namespace App\Http\Resources\Deck;

use App\Http\Resources\Deck\DeckResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DeckPaginationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [

            'data' => DeckResource::collection($this['data']),
            'pagination' => $this['pagination'],
        ];
    }
}
