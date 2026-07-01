<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTabulationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_id' => ['sometimes', 'exists:exams,id'],
            'student_id' => ['sometimes', 'exists:students,id'],
            'gpa' => ['nullable', 'numeric', 'min:0', 'max:5'],
            'position' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
