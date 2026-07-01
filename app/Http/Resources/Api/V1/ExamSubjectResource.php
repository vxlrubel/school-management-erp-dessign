<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamSubjectResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'exam_id' => $this->exam_id,
            'subject_id' => $this->subject_id,
            'full_marks' => $this->full_marks,
            'pass_marks' => $this->pass_marks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
