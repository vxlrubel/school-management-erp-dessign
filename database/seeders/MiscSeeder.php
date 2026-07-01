<?php

namespace Database\Seeders;

use App\Enums\AdmissionStatus;
use App\Enums\LeaveStatus;
use App\Enums\UserType;
use App\Models\ActivityLog;
use App\Models\AdmissionApplication;
use App\Models\AdmissionLottery;
use App\Models\Alumni;
use App\Models\AlumniEvent;
use App\Models\AlumniEventRegistration;
use App\Models\Certificate;
use App\Models\CertificateTemplate;
use App\Models\Classroom;
use App\Models\ClassSubject;
use App\Models\DigitalContent;
use App\Models\Employee;
use App\Models\EmployeeCard;
use App\Models\IdCardTemplate;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use App\Models\Media;
use App\Models\Notification as NotificationModel;
use App\Models\OnlineClass;
use App\Models\SmsLog;
use App\Models\Student;
use App\Models\StudentCard;
use App\Models\Teacher;
use App\Models\TeacherCard;
use App\Models\User;
use App\Models\Vaccine;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MiscSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $leaveTypes = ['Sick Leave', 'Annual Leave', 'Emergency Leave', 'Maternity Leave'];
                $createdLeaveTypes = [];
                foreach ($leaveTypes as $name) {
                    $createdLeaveTypes[$name] = LeaveType::create([
                        'school_id' => $schoolId,
                        'name' => $name,
                    ]);
                }

                $users = User::where('school_id', $schoolId)
                    ->whereIn('user_type', [
                        UserType::Teacher,
                        UserType::Employee,
                        UserType::Student,
                    ])
                    ->get();

                $leaveReasons = [
                    'Feeling unwell and need rest',
                    'Family emergency',
                    'Personal matter to attend to',
                    'Medical appointment',
                    'Family wedding ceremony',
                ];

                foreach ($users->random(min(5, $users->count())) as $user) {
                    $startDate = now()->subDays(rand(10, 60));
                    LeaveRequest::create([
                        'school_id' => $schoolId,
                        'user_id' => $user->id,
                        'leave_type_id' => $createdLeaveTypes[array_rand($createdLeaveTypes)]->id,
                        'reason' => $leaveReasons[array_rand($leaveReasons)],
                        'start_date' => $startDate,
                        'end_date' => $startDate->copy()->addDays(rand(1, 5)),
                        'status' => collect([LeaveStatus::Approved, LeaveStatus::Pending, LeaveStatus::Rejected])->random(),
                    ]);
                }

                $certTemplates = [
                    ['name' => 'Student Certificate', 'html' => '<h1>Student Certificate</h1><p>This certifies that {{student_name}} has completed {{class}} at our institution.</p>'],
                    ['name' => 'Character Certificate', 'html' => '<h1>Character Certificate</h1><p>This certifies the good character of {{student_name}}.</p>'],
                    ['name' => 'Transfer Certificate', 'html' => '<h1>Transfer Certificate</h1><p>This certifies that {{student_name}} was a student of this institution.</p>'],
                ];

                $createdTemplates = [];
                foreach ($certTemplates as $template) {
                    $createdTemplates[$template['name']] = CertificateTemplate::create([
                        'school_id' => $schoolId,
                        'name' => $template['name'],
                        'html' => $template['html'],
                    ]);
                }

                $students = Student::where('school_id', $schoolId)->take(5)->get();
                foreach ($students as $student) {
                    Certificate::create([
                        'school_id' => $schoolId,
                        'student_id' => $student->id,
                        'template_id' => $createdTemplates[array_rand($createdTemplates)]->id,
                        'issue_date' => now()->subDays(rand(1, 180)),
                    ]);
                }

                $graduatedStudents = Student::where('school_id', $schoolId)
                    ->inRandomOrder()
                    ->take(3)
                    ->get();

                foreach ($graduatedStudents as $student) {
                    Alumni::create([
                        'school_id' => $schoolId,
                        'student_id' => $student->id,
                        'profession' => collect(['Student (College)', 'Student (University)', 'Freelancer', 'Entrepreneur'])->random(),
                        'company' => collect(['Dhaka College', 'BUET', 'DU', 'Self-employed', 'Local Business'])->random(),
                        'batch' => rand(2020, 2025),
                    ]);
                }

                $alumniEvents = [
                    ['title' => 'Alumni Reunion 2026', 'description' => 'Annual alumni reunion gathering.', 'event_date' => now()->addMonths(6)],
                    ['title' => 'Homecoming Day', 'description' => 'Welcome back all former students.', 'event_date' => now()->addMonths(3)],
                    ['title' => 'Alumni Networking Session', 'description' => 'Professional networking event for alumni.', 'event_date' => now()->addMonths(1)],
                ];

                $createdAlumniEvents = [];
                foreach ($alumniEvents as $event) {
                    $createdAlumniEvents[] = AlumniEvent::create([
                        'school_id' => $schoolId,
                        'title' => $event['title'],
                        'description' => $event['description'],
                        'event_date' => $event['event_date'],
                    ]);
                }

                $alumniRecords = Alumni::where('school_id', $schoolId)->get();
                foreach ($alumniRecords as $alumni) {
                    foreach ($createdAlumniEvents as $event) {
                        if (rand(0, 1)) {
                            AlumniEventRegistration::create([
                                'alumni_event_id' => $event->id,
                                'alumni_id' => $alumni->id,
                            ]);
                        }
                    }
                }

                $vaccineNames = ['BCG', 'Polio', 'Hepatitis B', 'DPT', 'Measles', 'TT'];
                foreach ($vaccineNames as $name) {
                    Vaccine::create([
                        'school_id' => $schoolId,
                        'name' => $name,
                    ]);
                }

                $teachers = Teacher::where('school_id', $schoolId)->get();
                for ($i = 0; $i < 3; $i++) {
                    OnlineClass::create([
                        'school_id' => $schoolId,
                        'title' => collect(['Mathematics Live Session', 'English Literature', 'Physics Review Class', 'Chemistry Lab Demo', 'Bangla Grammar'])->random(),
                        'meeting_url' => 'https://meet.google.com/'.strtolower(fake()->bothify('???-####-???')),
                        'teacher_id' => $teachers->random()->id,
                        'start_time' => now()->addDays(rand(-5, 15))->setTime(rand(8, 14), 0, 0),
                    ]);
                }

                $classSubjects = ClassSubject::whereIn('teacher_id', $teachers->pluck('id'))->get();
                for ($i = 0; $i < 5; $i++) {
                    $cs = $classSubjects->random();
                    DigitalContent::create([
                        'school_id' => $schoolId,
                        'title' => collect(['Chapter 1 Notes', 'Practice Problems', 'Lab Manual', 'Reference Book PDF', 'Assignment Sheet'])->random(),
                        'file' => 'digital-content/'.strtolower(fake()->word).'.pdf',
                        'class_id' => $cs->class_id,
                        'subject_id' => $cs->subject_id,
                    ]);
                }

                $idCardTemplate = IdCardTemplate::create([
                    'school_id' => $schoolId,
                    'name' => 'Standard ID Card',
                    'html' => '<div><h2>{{school_name}}</h2><p>{{name}}</p><p>{{id_no}}</p></div>',
                ]);

                foreach ($students->take(3) as $student) {
                    StudentCard::create([
                        'school_id' => $schoolId,
                        'student_id' => $student->id,
                        'template_id' => $idCardTemplate->id,
                        'issue_date' => now()->subDays(rand(30, 180)),
                    ]);
                }

                foreach ($teachers->take(3) as $teacher) {
                    TeacherCard::create([
                        'school_id' => $schoolId,
                        'teacher_id' => $teacher->id,
                        'template_id' => $idCardTemplate->id,
                        'issue_date' => now()->subDays(rand(30, 180)),
                    ]);
                }

                $employees = Employee::where('school_id', $schoolId)->take(3)->get();
                foreach ($employees as $employee) {
                    EmployeeCard::create([
                        'school_id' => $schoolId,
                        'employee_id' => $employee->id,
                        'template_id' => $idCardTemplate->id,
                        'issue_date' => now()->subDays(rand(30, 180)),
                    ]);
                }

                NotificationModel::create([
                    'school_id' => $schoolId,
                    'title' => 'Welcome to New Academic Year',
                    'message' => 'The academic year 2026-2027 has started. Please check your class schedule.',
                    'type' => 'general',
                ]);
                NotificationModel::create([
                    'school_id' => $schoolId,
                    'title' => 'Exam Results Published',
                    'message' => 'Mid-term examination results have been published. Check your marks online.',
                    'type' => 'academic',
                ]);
                NotificationModel::create([
                    'school_id' => $schoolId,
                    'title' => 'Fee Payment Reminder',
                    'message' => 'Monthly fees for March are due. Please pay before the deadline.',
                    'type' => 'fee',
                ]);

                Media::create([
                    'school_id' => $schoolId,
                    'disk' => 'local',
                    'file_name' => 'school-logo.png',
                    'path' => 'media/school-logo.png',
                    'mime' => 'image/png',
                    'size' => 25600,
                ]);
                Media::create([
                    'school_id' => $schoolId,
                    'disk' => 'local',
                    'file_name' => 'annual-report-2025.pdf',
                    'path' => 'media/reports/annual-report-2025.pdf',
                    'mime' => 'application/pdf',
                    'size' => 1024000,
                ]);
                Media::create([
                    'school_id' => $schoolId,
                    'disk' => 's3',
                    'file_name' => 'admission-form.pdf',
                    'path' => 'media/forms/admission-form.pdf',
                    'mime' => 'application/pdf',
                    'size' => 512000,
                ]);

                $staffUsers = User::where('school_id', $schoolId)
                    ->whereIn('user_type', [
                        UserType::SchoolAdmin,
                        UserType::Teacher,
                        UserType::Employee,
                    ])
                    ->get();

                $modules = ['auth', 'student', 'teacher', 'fee', 'exam', 'attendance', 'cms'];
                $actions = ['login', 'create', 'update', 'delete', 'view', 'logout'];

                foreach ($staffUsers->take(10) as $user) {
                    ActivityLog::create([
                        'user_id' => $user->id,
                        'school_id' => $schoolId,
                        'module' => $modules[array_rand($modules)],
                        'action' => $actions[array_rand($actions)],
                        'ip' => '192.168.'.rand(1, 254).'.'.rand(1, 254),
                        'device' => collect(['Chrome/Windows', 'Firefox/Windows', 'Safari/macOS', 'Chrome/Android', 'Mobile Safari/iOS'])->random(),
                    ]);
                }

                $studentAdmissions = [
                    ['name' => 'Rafiq Hasan', 'mobile' => '+880-1712345601', 'email' => 'rafiq@email.com'],
                    ['name' => 'Shamima Akhter', 'mobile' => '+880-1712345602', 'email' => 'shamima@email.com'],
                    ['name' => 'Ariful Islam', 'mobile' => '+880-1712345603', 'email' => 'ariful@email.com'],
                ];

                $classrooms = Classroom::where('school_id', $schoolId)->get();

                foreach ($studentAdmissions as $admission) {
                    $application = AdmissionApplication::create([
                        'school_id' => $schoolId,
                        'name' => $admission['name'],
                        'mobile' => $admission['mobile'],
                        'email' => $admission['email'],
                        'class_id' => $classrooms->random()->id,
                        'status' => collect([AdmissionStatus::Pending, AdmissionStatus::Approved, AdmissionStatus::Waiting])->random(),
                    ]);

                    if (rand(0, 1)) {
                        AdmissionLottery::create([
                            'application_id' => $application->id,
                            'result' => collect(['selected', 'waiting', 'not_selected'])->random(),
                        ]);
                    }
                }

                $smsMobiles = User::where('school_id', $schoolId)
                    ->whereNotNull('phone')
                    ->take(3)
                    ->pluck('phone');

                foreach ($smsMobiles as $mobile) {
                    SmsLog::create([
                        'school_id' => $schoolId,
                        'mobile' => $mobile,
                        'message' => 'Dear parent, your child\'s attendance has been recorded. Please check the parent portal for details.',
                        'status' => 'sent',
                        'response' => 'Message submitted successfully',
                    ]);
                }
            }
        });
    }
}
