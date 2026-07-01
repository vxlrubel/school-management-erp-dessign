<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdmissionLotteryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'application_id' => ['sometimes', 'integer', 'exists:admission_applications,id'],
            'result' => ['sometimes', 'string', 'in:selected,not_selected,pending'],
        ];
    }
}
