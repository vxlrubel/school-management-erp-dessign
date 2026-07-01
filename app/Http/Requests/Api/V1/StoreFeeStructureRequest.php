<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeeStructureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'class_id' => ['required', 'exists:classes,id'],
            'fee_head_id' => ['required', 'exists:fee_heads,id'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}
