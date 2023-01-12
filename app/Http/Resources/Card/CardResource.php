<?php

namespace App\Http\Resources\Card;

use Illuminate\Http\Resources\Json\JsonResource;

class CardResource extends JsonResource
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
            'id' => $this->id,
            'src' => $this->url,
            'word' => $this->value,
            'info' => json_decode($this->data),
            'repeats' => $this->repeats,
            'level' => $this->level,
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at))
        ];
    }
}
