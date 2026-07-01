<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'admission_no' => $this->admission_no,
            'roll' => $this->roll,
            'name' => $this->name,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'religion' => $this->religion,
            'blood_group' => $this->blood_group,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'photo' => $this->photo,
            'status' => $this->status,
            'guardian' => new StudentGuardianResource($this->whenLoaded('guardian')),
            'academic' => new StudentAcademicResource($this->whenLoaded('academic')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
