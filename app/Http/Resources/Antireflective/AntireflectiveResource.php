<?php

namespace App\Http\Resources\Antireflective;

use Illuminate\Http\Resources\Json\JsonResource;

class AntireflectiveResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'package' => $this->package()->first(),
        ];
    }
}
