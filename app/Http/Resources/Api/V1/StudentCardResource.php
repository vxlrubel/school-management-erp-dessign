<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'student_id' => $this->student_id,
            'template_id' => $this->template_id,
            'issue_date' => $this->issue_date,
            'student' => $this->whenLoaded('student'),
            'template' => $this->whenLoaded('template'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
