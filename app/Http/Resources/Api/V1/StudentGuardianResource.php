<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentGuardianResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'student_id' => $this->student_id,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'guardian_name' => $this->guardian_name,
            'guardian_mobile' => $this->guardian_mobile,
            'occupation' => $this->occupation,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
