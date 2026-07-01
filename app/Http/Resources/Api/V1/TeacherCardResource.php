<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'teacher_id' => $this->teacher_id,
            'template_id' => $this->template_id,
            'issue_date' => $this->issue_date,
            'teacher' => $this->whenLoaded('teacher'),
            'template' => $this->whenLoaded('template'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
