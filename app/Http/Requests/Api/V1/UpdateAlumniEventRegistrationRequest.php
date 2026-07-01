<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAlumniEventRegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'alumni_event_id' => ['sometimes', 'required', 'integer', 'exists:alumni_events,id'],
            'alumni_id' => ['sometimes', 'required', 'integer', 'exists:alumni,id'],
        ];
    }
}
