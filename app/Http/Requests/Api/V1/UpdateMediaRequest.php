<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'disk' => ['sometimes', 'required', 'string', 'max:255'],
            'file_name' => ['sometimes', 'required', 'string', 'max:255'],
            'path' => ['sometimes', 'required', 'string', 'max:2048'],
            'mime' => ['sometimes', 'required', 'string', 'max:255'],
            'size' => ['sometimes', 'required', 'integer', 'min:0'],
        ];
    }
}
