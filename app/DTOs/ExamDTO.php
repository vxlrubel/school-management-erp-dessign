<?php

namespace App\DTOs;

class ExamDTO
{
    public function __construct(
        public readonly int $school_id,
        public readonly string $title,
        public readonly int $session_id,
    ) {}

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'title' => $this->title,
            'session_id' => $this->session_id,
        ];
    }
}
