<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'name' => $this->name,
            'code' => $this->code,
            'classrooms' => ClassroomResource::collection($this->whenLoaded('classrooms')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
