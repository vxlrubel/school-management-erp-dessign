<?php

namespace App\DTOs;

class StudentDTO
{
    public function __construct(
        public readonly ?int $school_id,
        public readonly string $name,
        public readonly ?string $admission_no = null,
        public readonly ?string $roll = null,
        public readonly ?string $gender = null,
        public readonly ?string $dob = null,
        public readonly ?string $religion = null,
        public readonly ?string $blood_group = null,
        public readonly ?string $mobile = null,
        public readonly ?string $email = null,
        public readonly ?string $photo = null,
        public readonly string $status = 'active',
        public readonly ?int $id = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            school_id: $data['school_id'] ?? auth()->user()?->school_id,
            name: $data['name'],
            admission_no: $data['admission_no'] ?? null,
            roll: $data['roll'] ?? null,
            gender: $data['gender'] ?? null,
            dob: $data['dob'] ?? null,
            religion: $data['religion'] ?? null,
            blood_group: $data['blood_group'] ?? null,
            mobile: $data['mobile'] ?? null,
            email: $data['email'] ?? null,
            photo: $data['photo'] ?? null,
            status: $data['status'] ?? 'active',
            id: $data['id'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'school_id' => $this->school_id,
            'admission_no' => $this->admission_no,
            'roll' => $this->roll,
            'name' => $this->name,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'religion' => $this->religion,
            'blood_group' => $this->blood_group,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'photo' => $this->photo,
            'status' => $this->status,
        ];
    }
}
