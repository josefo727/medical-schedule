<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LastAppointmentResource extends JsonResource
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
            'data' => $this->date->format('d-M-Y'),
            'time' => $this->date->format('h:i A'),
            'doctor' => $this->doctor->fullName,
            'specialty' => $this->doctor->specialty->name,
            'status' => Str::ucfirst($this->status),
        ];
    }
}
