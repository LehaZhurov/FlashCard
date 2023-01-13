<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Card\CardResource;
class CardPaginationResource extends JsonResource
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

            'data' => CardResource::collection($this['data']),
            'pagination' => $this['pagination'],
        ];
    }
}
