<?php

namespace App\Http\Resources\Optician;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OpticianDataCollection extends ResourceCollection
{
    public $collects = OpticianResource::class;
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
