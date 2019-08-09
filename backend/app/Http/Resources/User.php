<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'email' => $this->name,
            'phone' => $this->name,
            'father_name' => $this->name,
            'mather_name' => $this->name,
            'created_at' => $this->name,
            'updated_at' => $this->name,
            'address' => $this->address
        ];
    }
}
