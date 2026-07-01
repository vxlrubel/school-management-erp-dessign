<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherCardRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'teacher_id' => ['sometimes', 'required', 'integer', 'exists:teachers,id'],
            'template_id' => ['sometimes', 'required', 'integer', 'exists:id_card_templates,id'],
            'issue_date' => ['sometimes', 'required', 'date'],
        ];
    }
}
