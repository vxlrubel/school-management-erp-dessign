<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\ClassSubject;
use App\Models\ClassTeacher;
use App\Models\Section;
use App\Models\Session;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $session2025 = Session::create([
                    'school_id' => $schoolId,
                    'name' => '2025-2026',
                    'current' => false,
                ]);
                $session2026 = Session::create([
                    'school_id' => $schoolId,
                    'name' => '2026-2027',
                    'current' => true,
                ]);

                $classNames = ['Six', 'Seven', 'Eight', 'Nine', 'Ten'];
                $classes = [];
                foreach ($classNames as $name) {
                    $classes[$name] = Classroom::create([
                        'school_id' => $schoolId,
                        'name' => $name,
                    ]);
                }

                $lowerClasses = ['Six', 'Seven', 'Eight'];
                $higherClasses = ['Nine', 'Ten'];

                foreach ($lowerClasses as $name) {
                    foreach (['A', 'B', 'C'] as $sec) {
                        Section::create([
                            'class_id' => $classes[$name]->id,
                            'name' => $sec,
                        ]);
                    }
                }
                foreach ($higherClasses as $name) {
                    foreach (['A', 'B'] as $sec) {
                        Section::create([
                            'class_id' => $classes[$name]->id,
                            'name' => $sec,
                        ]);
                    }
                }

                $subjectNames = [
                    'Bangla', 'English', 'Mathematics', 'Physics', 'Chemistry',
                    'Biology', 'History', 'Geography', 'ICT', 'Religion',
                ];
                $subjectCodes = [
                    '101', '102', '103', '104', '105',
                    '106', '107', '108', '109', '110',
                ];
                $subjects = [];
                foreach ($subjectNames as $i => $name) {
                    $subjects[$name] = Subject::create([
                        'school_id' => $schoolId,
                        'name' => $name,
                        'code' => $subjectCodes[$i],
                    ]);
                }

                $teachers = Teacher::where('school_id', $schoolId)->get();

                $classSubjectMap = [
                    'Six' => ['Bangla', 'English', 'Mathematics', 'History', 'Geography', 'ICT', 'Religion'],
                    'Seven' => ['Bangla', 'English', 'Mathematics', 'History', 'Geography', 'ICT', 'Religion'],
                    'Eight' => ['Bangla', 'English', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'ICT', 'Religion'],
                    'Nine' => ['Bangla', 'English', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'History', 'Geography', 'ICT', 'Religion'],
                    'Ten' => ['Bangla', 'English', 'Mathematics', 'Physics', 'Chemistry', 'Biology', 'History', 'Geography', 'ICT', 'Religion'],
                ];

                foreach ($classSubjectMap as $className => $subjectList) {
                    $class = $classes[$className];
                    foreach ($subjectList as $subjectName) {
                        $teacher = $teachers->random();
                        ClassSubject::create([
                            'class_id' => $class->id,
                            'subject_id' => $subjects[$subjectName]->id,
                            'teacher_id' => $teacher->id,
                        ]);
                    }
                }

                foreach ($classes as $class) {
                    $teacher = $teachers->random();
                    ClassTeacher::create([
                        'class_id' => $class->id,
                        'teacher_id' => $teacher->id,
                    ]);
                }
            }
        });
    }
}
