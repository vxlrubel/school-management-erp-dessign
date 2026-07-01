<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlineClassResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'title' => $this->title,
            'meeting_url' => $this->meeting_url,
            'teacher_id' => $this->teacher_id,
            'start_time' => $this->start_time,
            'teacher' => $this->whenLoaded('teacher'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
