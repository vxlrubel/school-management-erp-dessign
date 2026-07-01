<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentVaccineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'student_id' => ['sometimes', 'required', 'integer', 'exists:students,id'],
            'vaccine_id' => ['sometimes', 'required', 'integer', 'exists:vaccines,id'],
            'date_given' => ['sometimes', 'required', 'date'],
        ];
    }
}
