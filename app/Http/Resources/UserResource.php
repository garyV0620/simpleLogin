<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => ucfirst($this->firstName . $this->lastName),
            'email' => $this->email,
            'role' => $this->role,
            'date created' => $this->created_at->format('Y-m-d'),
            'date updated' => $this->updated_at->format('Y-m-d'),

        ];
    }
}
