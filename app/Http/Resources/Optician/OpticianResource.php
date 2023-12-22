<?php

namespace App\Http\Resources\Optician;

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
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
        ];
    }
}
