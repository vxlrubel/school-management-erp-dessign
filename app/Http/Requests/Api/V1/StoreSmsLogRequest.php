<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreSmsLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mobile' => ['required', 'string', 'max:20'],
            'message' => ['required', 'string'],
            'status' => ['nullable', 'string', 'max:255'],
            'response' => ['nullable', 'string'],
        ];
    }
}
