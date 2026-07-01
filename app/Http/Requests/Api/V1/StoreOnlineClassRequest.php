<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOnlineClassRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'meeting_url' => ['required', 'string', 'url', 'max:2048'],
            'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
            'start_time' => ['required', 'date'],
        ];
    }
}
