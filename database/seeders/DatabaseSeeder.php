<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            SchoolSeeder::class,
            RolePermissionSeeder::class,
            UserSeeder::class,
            TeacherSeeder::class,
            EmployeeSeeder::class,
            AcademicSeeder::class,
            StudentSeeder::class,
            AttendanceSeeder::class,
            FeeSeeder::class,
            ExamSeeder::class,
            RoutineSeeder::class,
            CmsSeeder::class,
            MiscSeeder::class,
        ]);
    }
}
