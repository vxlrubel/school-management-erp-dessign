<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentAcademicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'class_id' => $this->class_id,
            'section_id' => $this->section_id,
            'session_id' => $this->session_id,
            'classroom' => new ClassroomResource($this->whenLoaded('classroom')),
            'section' => new SectionResource($this->whenLoaded('section')),
            'session' => new SessionResource($this->whenLoaded('session')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
