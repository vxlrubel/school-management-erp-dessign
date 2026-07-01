<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSmsLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['sometimes', 'string', 'max:20'],
            'message' => ['sometimes', 'string'],
            'status' => ['nullable', 'string', 'max:255'],
            'response' => ['nullable', 'string'],
        ];
    }
}
