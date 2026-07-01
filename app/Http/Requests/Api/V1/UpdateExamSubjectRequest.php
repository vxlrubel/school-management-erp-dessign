<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExamSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_id' => ['sometimes', 'exists:exams,id'],
            'subject_id' => ['sometimes', 'exists:subjects,id'],
            'full_marks' => ['sometimes', 'numeric', 'min:0'],
            'pass_marks' => ['sometimes', 'numeric', 'min:0', 'lte:full_marks'],
        ];
    }
}
