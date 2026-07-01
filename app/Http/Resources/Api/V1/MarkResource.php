<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarkResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'exam_subject_id' => $this->exam_subject_id,
            'student_id' => $this->student_id,
            'marks' => $this->marks,
            'grade' => $this->grade,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
