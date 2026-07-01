<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'disk' => ['required', 'string', 'max:255'],
            'file_name' => ['required', 'string', 'max:255'],
            'path' => ['required', 'string', 'max:2048'],
            'mime' => ['required', 'string', 'max:255'],
            'size' => ['required', 'integer', 'min:0'],
        ];
    }
}
