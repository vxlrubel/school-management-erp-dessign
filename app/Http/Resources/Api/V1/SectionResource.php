<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'class_id' => $this->class_id,
            'name' => $this->name,
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
