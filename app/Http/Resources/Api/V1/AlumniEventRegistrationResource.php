<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniEventRegistrationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'alumni_event_id' => $this->alumni_event_id,
            'alumni_id' => $this->alumni_id,
            'event' => $this->whenLoaded('event'),
            'alumni' => $this->whenLoaded('alumni'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
