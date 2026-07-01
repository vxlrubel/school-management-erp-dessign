<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarkRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_subject_id' => ['sometimes', 'exists:exam_subjects,id'],
            'student_id' => ['sometimes', 'exists:students,id'],
            'marks' => ['nullable', 'numeric', 'min:0'],
            'grade' => ['nullable', 'string', 'max:10'],
        ];
    }
}
