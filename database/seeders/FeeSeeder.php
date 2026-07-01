<?php

namespace Database\Seeders;

use App\Enums\PaymentStatus;
use App\Enums\StatusType;
use App\Models\Classroom;
use App\Models\FeeHead;
use App\Models\FeeStructure;
use App\Models\Student;
use App\Models\StudentFee;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeeSeeder extends Seeder
{
    private array $feeHeadNames = [
        'Tuition Fee', 'Lab Fee', 'Library Fee', 'Sports Fee', 'Transport Fee', 'Development Fee',
    ];

    private array $classFeeAmounts = [
        'Six' => [2000, 300, 200, 150, 500, 400],
        'Seven' => [2200, 300, 200, 150, 500, 400],
        'Eight' => [2500, 350, 250, 200, 600, 500],
        'Nine' => [3000, 400, 300, 200, 700, 600],
        'Ten' => [3500, 500, 300, 250, 800, 700],
    ];

    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $feeHeads = [];
                foreach ($this->feeHeadNames as $name) {
                    $feeHeads[$name] = FeeHead::create([
                        'school_id' => $schoolId,
                        'name' => $name,
                    ]);
                }

                $classes = Classroom::where('school_id', $schoolId)->get();
                foreach ($classes as $class) {
                    $amounts = $this->classFeeAmounts[$class->name] ?? $this->classFeeAmounts['Six'];
                    foreach ($feeHeads as $index => $feeHead) {
                        FeeStructure::create([
                            'class_id' => $class->id,
                            'fee_head_id' => $feeHead->id,
                            'amount' => $amounts[$index] ?? 0,
                        ]);
                    }
                }

                $students = Student::where('school_id', $schoolId)
                    ->where('status', StatusType::Active->value)
                    ->get();

                foreach ($students as $student) {
                    $studentFee = StudentFee::where('student_id', $student->id)
                        ->where('status', 'paid')
                        ->first();

                    if ($studentFee) {
                        $transaction = Transaction::create([
                            'school_id' => $schoolId,
                            'invoice' => 'INV-'.$schoolId.'-'.str_pad($student->id, 5, '0', STR_PAD_LEFT).'-'.rand(1000, 9999),
                            'amount' => $studentFee->paid,
                            'payment_method' => collect(['cash', 'bank', 'bKash', 'nagad'])->random(),
                            'status' => PaymentStatus::Paid->value,
                        ]);
                    }
                }

                $partialFees = StudentFee::whereHas('student', fn ($q) => $q->where('school_id', $schoolId))
                    ->where('status', 'unpaid')
                    ->take(5)
                    ->get();

                foreach ($partialFees as $fee) {
                    Transaction::create([
                        'school_id' => $schoolId,
                        'invoice' => 'INV-'.$schoolId.'-PART-'.rand(10000, 99999),
                        'amount' => $fee->amount * 0.5,
                        'payment_method' => 'bKash',
                        'status' => PaymentStatus::Partial->value,
                    ]);
                }
            }
        });
    }
}
