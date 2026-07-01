<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'student_id' => $this->student_id,
            'profession' => $this->profession,
            'company' => $this->company,
            'batch' => $this->batch,
            'student' => $this->whenLoaded('student'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
