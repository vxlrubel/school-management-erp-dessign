<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\AttendanceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAttendanceRecordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'attendance_id' => ['sometimes', 'exists:attendance,id'],
            'user_id' => ['sometimes', 'exists:users,id'],
            'status' => ['sometimes', Rule::enum(AttendanceStatus::class)],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'device' => ['nullable', 'string', 'max:255'],
        ];
    }
}
