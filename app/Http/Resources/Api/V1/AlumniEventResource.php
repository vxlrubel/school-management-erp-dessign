<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniEventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'title' => $this->title,
            'description' => $this->description,
            'event_date' => $this->event_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
