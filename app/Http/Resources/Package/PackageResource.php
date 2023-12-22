<?php

namespace App\Http\Resources\Package;

use App\Http\Resources\Frame\FrameResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
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
            'price' => $this->price,
            'description' => $this->description,
            'color' => $this->color,
            'level' => $this->level,
            'antireflectives' => $this->antireflectives,
            'materials' => $this->materials,
            'frames' => FrameResource::collection($this->frames)
        ];
    }
}
