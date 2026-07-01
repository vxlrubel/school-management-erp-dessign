<?php

namespace App\DTOs;

class StudentVaccineDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly int $student_id = 0,
        public readonly int $vaccine_id = 0,
        public readonly string $date_given = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            student_id: $data['student_id'] ?? 0,
            vaccine_id: $data['vaccine_id'] ?? 0,
            date_given: $data['date_given'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'student_id' => $this->student_id,
            'vaccine_id' => $this->vaccine_id,
            'date_given' => $this->date_given,
        ];
    }
}
