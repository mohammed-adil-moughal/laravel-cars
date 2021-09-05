<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarImageResource extends JsonResource
{
    use DelegatesToResource;

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
            'file_key'=> $this->file_key,
            'description'=> $this->description
        ];
    }
}
