<?php

namespace App\Http\Resources\Word;

use Illuminate\Http\Resources\Json\JsonResource;

class WordResource extends JsonResource
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
            'word' => str_replace('_',' ',$this->value),
            'audio' => $this->audio,
            'info' => json_decode($this->data),
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at))
        ];
    }
}
