<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DigitalContentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'school_id' => $this->school_id,
            'title' => $this->title,
            'file' => $this->file,
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
            'class' => $this->whenLoaded('class'),
            'subject' => $this->whenLoaded('subject'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
