<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => ['nullable', 'integer', 'exists:users,id'],
            'module' => ['required', 'string', 'max:255'],
            'action' => ['required', 'string', 'max:255'],
            'ip' => ['required', 'string', 'max:45'],
            'device' => ['nullable', 'string', 'max:255'],
        ];
    }
}
