<?php

namespace Database\Seeders;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademic;
use App\Models\StudentFee;
use App\Models\StudentGuardian;
use App\Models\StudentVaccine;
use App\Models\Role;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    private array $banglaNames = [
        'Md. Abul Kashem', 'Shamim Reza', 'Nasir Uddin', 'Mizanur Rahman', 'Delwar Hossain',
        'Jahangir Alam', 'Kawser Ahmed', 'Shafiqul Islam', 'Shahidul Islam', 'Mofij Uddin',
        ' Habibur Rahman', 'Tajul Islam', 'Nurul Amin', 'Mosiur Rahman', 'Shahabuddin',
        'Moin Uddin', 'Ruhul Amin', 'Sirajul Haque', 'Fazlul Haque', 'Sanaullah',
        'Abdus Salam', 'Abdur Rouf', 'Abdul Mannan', 'Abdul Halim', 'Abdul Latif',
        'Abdul Aziz', 'Abdur Rahim', 'Abdul Malek', 'Abdul Jalil', 'Abdus Sattar',
        'Nur Nabi', 'Nur Islam', 'Nur Mohammad', 'Nur Hossain', 'Siddiqur Rahman',
        'Abul Hashem', 'Abul Kashem', 'Abul Hossain', 'Abul Kalam', 'Mustafizur Rahman',
        'Moshiur Rahman', 'Motiur Rahman', 'Mofazzal Hossain', 'Shahjahan', 'Samsul Haque',
        'Shahidul Islam', 'Shah Alam', 'Shah Newaz', 'Shah Mohammad', 'Shahjahan Ali',
    ];

    private array $fatherNames = [
        'Abdul Gafur', 'Mokshed Ali', 'Joynal Abedin', 'Abul Hasnat', 'Khorshed Alam',
        'Amir Hossain', 'Anwar Hossain', 'Azizur Rahman', 'Bashir Ahmed', 'Golam Mostafa',
    ];

    private array $motherNames = [
        'Rahima Begum', 'Jahanara Begum', 'Shahida Begum', 'Nurjahan Begum', 'Fatema Begum',
        'Amina Begum', 'Kulsuma Begum', 'Momena Begum', 'Shahinur Begum', 'Nasrin Akhter',
    ];

    private array $occupations = [
        'Businessman', 'Government Service', 'Private Job', 'Teacher', 'Farmer',
        'Lawyer', 'Doctor', 'Engineer', 'Banker', 'Small Business',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $classes = Classroom::where('school_id', $schoolId)->get();
                $sections = Section::whereIn('class_id', $classes->pluck('id'))->get();
                $sessions = Session::where('school_id', $schoolId)->get();
                $currentSession = $sessions->firstWhere('current', true);
                $vaccines = Vaccine::where('school_id', $schoolId)->get();
                $studentRole = Role::where('slug', 'student')->first();

                for ($i = 0; $i < 50; $i++) {
                    $class = $classes->random();
                    $section = $sections->where('class_id', $class->id)->random();
                    $session = $currentSession;
                    $name = $this->banglaNames[$i % count($this->banglaNames)];
                    $gender = ($i < 30) ? 'Male' : 'Female';

                    $student = Student::create([
                        'school_id' => $schoolId,
                        'admission_no' => 'STU-'.str_pad($schoolId, 2, '0', STR_PAD_LEFT).'-'.str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                        'roll' => $i + 1,
                        'name' => $name,
                        'gender' => $gender,
                        'dob' => now()->subYears(rand(10, 17))->subDays(rand(0, 365)),
                        'religion' => $i % 5 === 0 ? 'Hinduism' : 'Islam',
                        'blood_group' => collect(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'])->random(),
                        'mobile' => '+880-17'.str_pad($schoolId, 1, '0', STR_PAD_LEFT).rand(10000000, 99999999),
                        'email' => 'stu'.$schoolId.'_'.strtolower(str_replace(['.', ' ', 'Md. ', 'Md '], '', $name)).$i.'@school.edu.bd',
                        'status' => StatusType::Active->value,
                    ]);

                    $user = User::create([
                        'school_id' => $schoolId,
                        'user_type' => UserType::Student,
                        'name' => $name,
                        'email' => 'stu'.$schoolId.'_'.strtolower(str_replace(['.', ' ', 'Md. ', 'Md '], '', $name)).$i.'@school.edu.bd',
                        'phone' => '+880-17'.str_pad($schoolId, 1, '0', STR_PAD_LEFT).rand(50000000, 59999999),
                        'password' => Hash::make('password'),
                        'status' => StatusType::Active->value,
                    ]);
                    $user->roles()->attach($studentRole->id, ['school_id' => $schoolId]);

                    StudentGuardian::create([
                        'student_id' => $student->id,
                        'father_name' => $this->fatherNames[array_rand($this->fatherNames)],
                        'mother_name' => $this->motherNames[array_rand($this->motherNames)],
                        'guardian_name' => $this->fatherNames[array_rand($this->fatherNames)],
                        'guardian_mobile' => '+880-17'.rand(10000000, 99999999),
                        'occupation' => $this->occupations[array_rand($this->occupations)],
                    ]);

                    StudentAcademic::create([
                        'student_id' => $student->id,
                        'class_id' => $class->id,
                        'section_id' => $section->id,
                        'session_id' => $session->id,
                    ]);

                    foreach (['2026-01', '2026-02', '2026-03'] as $month) {
                        $baseAmount = rand(1500, 5000);
                        StudentFee::create([
                            'student_id' => $student->id,
                            'month' => $month,
                            'amount' => $baseAmount,
                            'discount' => $month === '2026-01' ? rand(100, 300) : 0,
                            'fine' => 0,
                            'paid' => $month !== '2026-03' ? $baseAmount : 0,
                            'status' => $month !== '2026-03' ? 'paid' : 'unpaid',
                        ]);
                    }

                    if ($vaccines->isNotEmpty()) {
                        foreach ($vaccines->random(min(rand(2, 4), $vaccines->count())) as $vaccine) {
                            StudentVaccine::create([
                                'student_id' => $student->id,
                                'vaccine_id' => $vaccine->id,
                                'date_given' => now()->subMonths(rand(1, 24)),
                            ]);
                        }
                    }
                }
            }
        });
    }
}
