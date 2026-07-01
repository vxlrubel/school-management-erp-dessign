<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Exam;
use App\Models\ExamSubject;
use App\Models\Mark;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Tabulation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $sessions = Session::where('school_id', $schoolId)->get();
                $subjects = Subject::where('school_id', $schoolId)->get();
                $students = Student::where('school_id', $schoolId)->with('academic')->get();
                $classrooms = Classroom::where('school_id', $schoolId)->pluck('id')->toArray();

                foreach ($sessions as $session) {
                    $examTitles = ['Mid Term', 'Final Exam'];
                    foreach ($examTitles as $title) {
                        $exam = Exam::create([
                            'school_id' => $schoolId,
                            'title' => $title,
                            'session_id' => $session->id,
                        ]);

                        foreach ($subjects as $subject) {
                            $fullMarks = in_array($subject->name, ['Mathematics', 'Physics', 'Chemistry']) ? 100 : 70;
                            $passMarks = (int) ($fullMarks * 0.33);

                            ExamSubject::create([
                                'exam_id' => $exam->id,
                                'subject_id' => $subject->id,
                                'full_marks' => $fullMarks,
                                'pass_marks' => $passMarks,
                            ]);
                        }
                    }
                }

                $exams = Exam::where('school_id', $schoolId)->get();
                foreach ($exams as $exam) {
                    $examSubjects = ExamSubject::where('exam_id', $exam->id)->get();
                    $studentMarks = [];

                    foreach ($students as $student) {
                        $totalMarks = 0;
                        $totalSubjects = 0;

                        foreach ($examSubjects as $examSubject) {
                            $obtainedMarks = rand(40, 100);
                            $totalMarks += $obtainedMarks;
                            $totalSubjects++;

                            $grade = $this->calculateGrade($obtainedMarks, $examSubject->full_marks);

                            Mark::create([
                                'exam_subject_id' => $examSubject->id,
                                'student_id' => $student->id,
                                'marks' => $obtainedMarks,
                                'grade' => $grade,
                            ]);
                        }

                        $gpa = $totalSubjects > 0 ? round(($totalMarks / ($totalSubjects * 100)) * 5, 2) : 0;
                        $studentMarks[] = [
                            'student_id' => $student->id,
                            'gpa' => min($gpa, 5.00),
                        ];
                    }

                    usort($studentMarks, fn ($a, $b) => $b['gpa'] <=> $a['gpa']);

                    foreach ($studentMarks as $position => $sm) {
                        Tabulation::create([
                            'exam_id' => $exam->id,
                            'student_id' => $sm['student_id'],
                            'gpa' => $sm['gpa'],
                            'position' => $position + 1,
                        ]);
                    }
                }
            }
        });
    }

    private function calculateGrade(float $marks, float $fullMarks): string
    {
        $percentage = ($marks / $fullMarks) * 100;

        return match (true) {
            $percentage >= 80 => 'A+',
            $percentage >= 70 => 'A',
            $percentage >= 60 => 'A-',
            $percentage >= 50 => 'B',
            $percentage >= 40 => 'C',
            $percentage >= 33 => 'D',
            default => 'F',
        };
    }
}
