<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\ClassRoutine;
use App\Models\Period;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoutineSeeder extends Seeder
{
    private array $periods = [
        ['name' => '1st Period', 'start' => '08:00', 'end' => '08:45'],
        ['name' => '2nd Period', 'start' => '08:45', 'end' => '09:30'],
        ['name' => '3rd Period', 'start' => '09:30', 'end' => '10:15'],
        ['name' => '4th Period', 'start' => '10:15', 'end' => '11:00'],
        ['name' => '5th Period', 'start' => '11:15', 'end' => '12:00'],
        ['name' => '6th Period', 'start' => '12:00', 'end' => '12:45'],
        ['name' => '7th Period', 'start' => '12:45', 'end' => '13:30'],
        ['name' => '8th Period', 'start' => '13:30', 'end' => '14:15'],
    ];

    private array $days = ['Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];

    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $createdPeriods = [];
                foreach ($this->periods as $periodData) {
                    $createdPeriods[] = Period::create([
                        'school_id' => $schoolId,
                        'name' => $periodData['name'],
                        'start_time' => $periodData['start'],
                        'end_time' => $periodData['end'],
                    ]);
                }

                $classes = Classroom::where('school_id', $schoolId)->get();
                $subjects = Subject::where('school_id', $schoolId)->get();
                $teachers = Teacher::where('school_id', $schoolId)->get();

                foreach ($classes as $class) {
                    $sections = Section::where('class_id', $class->id)->get();

                    foreach ($sections as $section) {
                        foreach ($this->days as $day) {
                            $assignedPeriods = [];
                            foreach ($createdPeriods as $period) {
                                $subject = $subjects->random();
                                $teacher = $teachers->random();

                                ClassRoutine::create([
                                    'class_id' => $class->id,
                                    'section_id' => $section->id,
                                    'day' => $day,
                                    'period_id' => $period->id,
                                    'subject_id' => $subject->id,
                                    'teacher_id' => $teacher->id,
                                ]);
                            }
                        }
                    }
                }
            }
        });
    }
}
