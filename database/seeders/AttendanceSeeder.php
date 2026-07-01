<?php

namespace Database\Seeders;

use App\Enums\AttendanceStatus;
use App\Enums\AttendanceType;
use App\Enums\UserType;
use App\Models\Attendance;
use App\Models\AttendanceRecord;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttendanceSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            foreach ([1, 2] as $schoolId) {
                $statusDistribution = [
                    AttendanceStatus::Present->value => 80,
                    AttendanceStatus::Absent->value => 10,
                    AttendanceStatus::Late->value => 5,
                    AttendanceStatus::Leave->value => 5,
                ];

                $students = User::where('school_id', $schoolId)
                    ->where('user_type', UserType::Student)
                    ->pluck('id');
                $teachers = User::where('school_id', $schoolId)
                    ->where('user_type', UserType::Teacher)
                    ->pluck('id');
                $employees = User::where('school_id', $schoolId)
                    ->where('user_type', UserType::Employee)
                    ->pluck('id');

                $now = now();
                $year = $now->year;
                $month = $now->month;
                $daysInMonth = $now->daysInMonth;

                foreach ([
                    ['type' => AttendanceType::Student, 'users' => $students],
                    ['type' => AttendanceType::Teacher, 'users' => $teachers],
                    ['type' => AttendanceType::Employee, 'users' => $employees],
                ] as $attType) {
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        $date = "{$year}-{$month}-".str_pad((string) $day, 2, '0', STR_PAD_LEFT);

                        if (now()->parse($date)->isFriday()) {
                            continue;
                        }

                        $attendance = Attendance::create([
                            'school_id' => $schoolId,
                            'attendance_date' => $date,
                            'type' => $attType['type']->value,
                        ]);

                        foreach ($attType['users'] as $userId) {
                            $roll = rand(1, 100);
                            $cumulative = 0;
                            $selectedStatus = AttendanceStatus::Present->value;
                            foreach ($statusDistribution as $status => $weight) {
                                $cumulative += $weight;
                                if ($roll <= $cumulative) {
                                    $selectedStatus = $status;
                                    break;
                                }
                            }

                            $latitude = null;
                            $longitude = null;
                            $device = null;
                            if ($selectedStatus === AttendanceStatus::Present->value || $selectedStatus === AttendanceStatus::Late->value) {
                                $latitude = 23.7800 + (rand(-100, 100) / 10000);
                                $longitude = 90.3800 + (rand(-100, 100) / 10000);
                                $device = 'Device-'.rand(1000, 9999);
                            }

                            AttendanceRecord::create([
                                'attendance_id' => $attendance->id,
                                'user_id' => $userId,
                                'status' => $selectedStatus,
                                'latitude' => $latitude,
                                'longitude' => $longitude,
                                'device' => $device,
                            ]);
                        }
                    }
                }
            }
        });
    }
}
