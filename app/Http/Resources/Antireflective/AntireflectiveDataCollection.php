<?php

namespace App\Http\Resources\Antireflective;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AntireflectiveDataCollection extends ResourceCollection
{
    public $collects = AntireflectiveResource::class;
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
