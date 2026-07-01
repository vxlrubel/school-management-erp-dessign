<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFeeStructureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_id' => ['sometimes', 'exists:classes,id'],
            'fee_head_id' => ['sometimes', 'exists:fee_heads,id'],
            'amount' => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}
