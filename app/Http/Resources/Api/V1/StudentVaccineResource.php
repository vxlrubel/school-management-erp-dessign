<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentVaccineResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'vaccine_id' => $this->vaccine_id,
            'date_given' => $this->date_given,
            'student' => $this->whenLoaded('student'),
            'vaccine' => $this->whenLoaded('vaccine'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
