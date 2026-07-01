<?php

namespace App\DTOs;

class EmployeeDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly ?string $designation = null,
        public readonly ?string $joining_date = null,
        public readonly ?float $salary = null,
        public readonly ?string $photo = null,
        public readonly ?int $user_id = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            designation: $data['designation'] ?? null,
            joining_date: $data['joining_date'] ?? null,
            salary: isset($data['salary']) ? (float) $data['salary'] : null,
            photo: $data['photo'] ?? null,
            user_id: $data['user_id'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'designation' => $this->designation,
            'joining_date' => $this->joining_date,
            'salary' => $this->salary,
            'photo' => $this->photo,
            'user_id' => $this->user_id,
        ];
    }
}
