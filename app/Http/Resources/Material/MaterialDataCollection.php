<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MaterialDataCollection extends ResourceCollection
{
    public $collects = MaterialResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
