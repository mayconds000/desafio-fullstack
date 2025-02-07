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
            'id' => $this->id,
            'name' => $this->name,
            'birth_date' => $this->birth_date,
            'email' => $this->email,
            'phone' => $this->phone,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'address' => new Address($this->address)
        ];
    }
}
