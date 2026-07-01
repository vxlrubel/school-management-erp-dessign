<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOnlineClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'meeting_url' => ['sometimes', 'required', 'string', 'url', 'max:2048'],
            'teacher_id' => ['sometimes', 'required', 'integer', 'exists:teachers,id'],
            'start_time' => ['sometimes', 'required', 'date'],
        ];
    }
}
