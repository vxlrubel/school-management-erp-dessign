<?php

namespace App\DTOs;

class EmployeeCardDTO
{
    public function __construct(
        public readonly ?int $id = null,
        public readonly ?int $school_id = null,
        public readonly int $employee_id = 0,
        public readonly int $template_id = 0,
        public readonly string $issue_date = '',
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            school_id: $data['school_id'] ?? null,
            employee_id: $data['employee_id'] ?? 0,
            template_id: $data['template_id'] ?? 0,
            issue_date: $data['issue_date'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'employee_id' => $this->employee_id,
            'template_id' => $this->template_id,
            'issue_date' => $this->issue_date,
        ];
    }
}
