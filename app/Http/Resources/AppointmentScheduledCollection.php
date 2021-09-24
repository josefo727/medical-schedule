<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AppointmentScheduledCollection extends ResourceCollection
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\JsonSerializable
     */
    public function toArray($request)
    {
        return LastAppointmentResource::collection($this->collection);
    }
}
