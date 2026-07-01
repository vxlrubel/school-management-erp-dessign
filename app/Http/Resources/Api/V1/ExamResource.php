<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'title' => $this->title,
            'session_id' => $this->session_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'exam_subjects' => ExamSubjectResource::collection($this->whenLoaded('examSubjects')),
        ];
    }
}
