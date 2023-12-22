<?php

namespace App\Http\Resources\Optician;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OpticianResource extends JsonResource
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
            'email' => $this->email,
            'phone' => $this->phone,
            'web' => $this->web,
            'address' => $this->address,
            'position' => [
                'lat' => $this->lat,
                'lng' => $this->lng,
            ],
            'lat' => $this->lat,
            'lng' => $this->lng,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'images' => $this->whenLoaded('images', function () {
                return ImageResource::collection($this->images);
            }),
        ];
    }
}
