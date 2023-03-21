<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
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
            'meal_id'    => $this->meal_id,
            'occurrence' => $this->occurrences,
            'meal_type'  => $this->meal_type,
            'meal_name'  => $this->meal_name,
            'price'      => $this->price,
        ];
    }
}
