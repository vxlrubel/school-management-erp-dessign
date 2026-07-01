<?php

namespace App\DTOs;

class TeacherDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly ?string $employee_no = null,
        public readonly ?string $designation = null,
        public readonly ?string $joining_date = null,
        public readonly ?string $qualification = null,
        public readonly ?string $photo = null,
        public readonly ?int $user_id = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            employee_no: $data['employee_no'] ?? null,
            designation: $data['designation'] ?? null,
            joining_date: $data['joining_date'] ?? null,
            qualification: $data['qualification'] ?? null,
            photo: $data['photo'] ?? null,
            user_id: $data['user_id'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'employee_no' => $this->employee_no,
            'designation' => $this->designation,
            'joining_date' => $this->joining_date,
            'qualification' => $this->qualification,
            'photo' => $this->photo,
            'user_id' => $this->user_id,
        ];
    }
}
