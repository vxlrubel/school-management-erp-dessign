<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreExamSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'exam_id' => ['required', 'exists:exams,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'full_marks' => ['required', 'numeric', 'min:0'],
            'pass_marks' => ['required', 'numeric', 'min:0', 'lte:full_marks'],
        ];
    }
}
