<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreAlumniEventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alumni_event_id' => ['required', 'integer', 'exists:alumni_events,id'],
            'alumni_id' => ['required', 'integer', 'exists:alumni,id'],
        ];
    }
}
