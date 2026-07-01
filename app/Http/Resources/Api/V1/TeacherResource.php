<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'employee_no' => $this->employee_no,
            'designation' => $this->designation,
            'joining_date' => $this->joining_date,
            'qualification' => $this->qualification,
            'photo' => $this->photo,
            'user_id' => $this->user_id,
            'classrooms' => ClassroomResource::collection($this->whenLoaded('classrooms')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
