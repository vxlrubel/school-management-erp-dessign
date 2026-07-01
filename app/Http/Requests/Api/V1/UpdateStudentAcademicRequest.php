<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentAcademicRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['sometimes', 'integer', 'exists:students,id'],
            'class_id' => ['sometimes', 'integer', 'exists:classes,id'],
            'section_id' => ['sometimes', 'integer', 'exists:sections,id'],
            'session_id' => ['sometimes', 'integer', 'exists:sessions,id'],
        ];
    }
}
