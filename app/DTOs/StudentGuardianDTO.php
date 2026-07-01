<?php

namespace App\DTOs;

class StudentGuardianDTO
{
    public function __construct(
        public readonly int $student_id,
        public readonly ?string $father_name = null,
        public readonly ?string $mother_name = null,
        public readonly ?string $guardian_name = null,
        public readonly ?string $guardian_mobile = null,
        public readonly ?string $occupation = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            student_id: $data['student_id'],
            father_name: $data['father_name'] ?? null,
            mother_name: $data['mother_name'] ?? null,
            guardian_name: $data['guardian_name'] ?? null,
            guardian_mobile: $data['guardian_mobile'] ?? null,
            occupation: $data['occupation'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->student_id,
            'father_name' => $this->father_name,
            'mother_name' => $this->mother_name,
            'guardian_name' => $this->guardian_name,
            'guardian_mobile' => $this->guardian_mobile,
            'occupation' => $this->occupation,
        ];
    }
}
