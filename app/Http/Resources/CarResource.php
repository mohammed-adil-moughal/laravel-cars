<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\DelegatesToResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'name' => $this->name,
            'brand' => new CarBrandResource($this->carbrand),
        ];
    }
}
