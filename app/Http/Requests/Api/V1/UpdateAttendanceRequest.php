<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\AttendanceType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttendanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attendance_date' => ['sometimes', 'date', 'date_format:Y-m-d'],
            'type' => ['sometimes', Rule::enum(AttendanceType::class)],
        ];
    }
}
