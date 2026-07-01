<?php

namespace Database\Seeders;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\Role;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherSeeder extends Seeder
{
    private array $teacherNames = [
        'Prof. Dr. ATM Shamsuzzaman', 'Dr. Md. Shafiqur Rahman', 'Prof. Shamsun Nahar',
        'Dr. Ayesha Siddiqua', 'Prof. Mofij Uddin Ahmed', 'Dr. Khaleda Begum',
        'Prof. Harun-or-Rashid', 'Dr. Momtaz Begum', 'Prof. Abul Kalam Azad',
        'Dr. Sharmin Akhter', 'Prof. Rezaul Karim', 'Dr. Kohinoor Begum',
        'Prof. Mozammel Haque', 'Dr. Tahmina Akhter', 'Prof. Shahjahan Ali',
    ];

    private array $designations = [
        'Senior Teacher', 'Assistant Teacher', 'Lecturer', 'Senior Lecturer', 'Associate Teacher',
    ];

    private array $qualifications = [
        'M.Sc in Physics', 'M.Sc in Chemistry', 'M.A in English', 'M.A in Bangla',
        'M.Sc in Mathematics', 'M.Sc in Biology', 'MSS in History', 'MSS in Geography',
        'M.Sc in Computer Science', 'M.A in Islamic Studies',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $existingTeacherUsers = User::where('school_id', $schoolId)
                    ->where('user_type', UserType::Teacher)
                    ->get();

                for ($i = 0; $i < 15; $i++) {
                    $name = $this->teacherNames[$i % count($this->teacherNames)];
                    $email = strtolower(str_replace([' Prof.', ' Dr.', 'Md. ', ' '], ['', '', '', '.'], $name)).$i.'@'.($schoolId === 1 ? 'isd' : 'gva').'.edu.bd';

                    $user = User::create([
                        'school_id' => $schoolId,
                        'user_type' => UserType::Teacher,
                        'name' => $name,
                        'email' => $email,
                        'phone' => '+880-17'.$schoolId.rand(1000000, 9999999),
                        'password' => Hash::make('password'),
                        'status' => StatusType::Active->value,
                    ]);

                    $teacher = Teacher::create([
                        'school_id' => $schoolId,
                        'employee_no' => 'TCH-'.$schoolId.'-'.str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                        'designation' => $this->designations[array_rand($this->designations)],
                        'joining_date' => now()->subYears(rand(1, 15))->subDays(rand(0, 365)),
                        'qualification' => $this->qualifications[array_rand($this->qualifications)],
                        'user_id' => $user->id,
                    ]);

                    $teacherRole = Role::where('slug', 'teacher')->first();
                    $user->roles()->attach($teacherRole->id, ['school_id' => $schoolId]);
                }
            }
        });
    }
}
