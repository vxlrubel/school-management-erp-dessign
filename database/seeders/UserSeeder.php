<?php

namespace Database\Seeders;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $superAdminRole = Role::where('slug', 'super-admin')->first();
            $schoolAdminRole = Role::where('slug', 'school-admin')->first();
            $teacherRole = Role::where('slug', 'teacher')->first();
            $employeeRole = Role::where('slug', 'employee')->first();
            $studentRole = Role::where('slug', 'student')->first();
            $parentRole = Role::where('slug', 'parent')->first();
            $alumniRole = Role::where('slug', 'alumni')->first();

            $schoolIds = [1, 2];

            $superAdmin = User::create([
                'school_id' => null,
                'user_type' => UserType::SuperAdmin,
                'name' => 'System Administrator',
                'email' => 'super@admin.com',
                'phone' => '+880-1700000001',
                'password' => Hash::make('password'),
                'status' => StatusType::Active->value,
            ]);
            $superAdmin->roles()->attach($superAdminRole->id, ['school_id' => null]);

            $schoolAdminData = [
                ['name' => 'Mr. Kamal Hossain', 'email' => 'admin@isd.edu.bd', 'phone' => '+880-1711111111'],
                ['name' => 'Mrs. Farida Yasmin', 'email' => 'admin@gva.edu.bd', 'phone' => '+880-1722222222'],
            ];

            foreach ($schoolAdminData as $i => $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$i],
                    'user_type' => UserType::SchoolAdmin,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($schoolAdminRole->id, ['school_id' => $schoolIds[$i]]);
            }

            $teacherData = [
                ['name' => 'Prof. Dr. Anowarul Kabir', 'email' => 'teacher1@isd.edu.bd', 'phone' => '+880-1711110001', 'school' => 0],
                ['name' => 'Mrs. Shahnaz Parvin', 'email' => 'teacher2@isd.edu.bd', 'phone' => '+880-1711110002', 'school' => 0],
                ['name' => 'Mr. Rashedul Islam', 'email' => 'teacher3@isd.edu.bd', 'phone' => '+880-1711110003', 'school' => 0],
                ['name' => 'Mr. Abdur Rahman', 'email' => 'teacher1@gva.edu.bd', 'phone' => '+880-1722220001', 'school' => 1],
                ['name' => 'Mrs. Nasrin Sultana', 'email' => 'teacher2@gva.edu.bd', 'phone' => '+880-1722220002', 'school' => 1],
            ];

            foreach ($teacherData as $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$data['school']],
                    'user_type' => UserType::Teacher,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($teacherRole->id, ['school_id' => $schoolIds[$data['school']]]);
            }

            $employeeData = [
                ['name' => 'Mr. Sirajul Islam', 'email' => 'emp1@isd.edu.bd', 'phone' => '+880-1711110101', 'school' => 0],
                ['name' => 'Mr. Rafiq Uddin', 'email' => 'emp2@isd.edu.bd', 'phone' => '+880-1711110102', 'school' => 0],
                ['name' => 'Mrs. Jahanara Begum', 'email' => 'emp1@gva.edu.bd', 'phone' => '+880-1722220101', 'school' => 1],
            ];

            foreach ($employeeData as $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$data['school']],
                    'user_type' => UserType::Employee,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($employeeRole->id, ['school_id' => $schoolIds[$data['school']]]);
            }

            $studentUserData = [
                ['name' => 'Rahim Mia', 'email' => 'student1@isd.edu.bd', 'phone' => '+880-1711110201', 'school' => 0],
                ['name' => 'Karim Hasan', 'email' => 'student2@isd.edu.bd', 'phone' => '+880-1711110202', 'school' => 0],
                ['name' => 'Fatima Begum', 'email' => 'student3@isd.edu.bd', 'phone' => '+880-1711110203', 'school' => 0],
                ['name' => 'Ayesha Khatun', 'email' => 'student4@isd.edu.bd', 'phone' => '+880-1711110204', 'school' => 0],
                ['name' => 'Jamal Uddin', 'email' => 'student5@isd.edu.bd', 'phone' => '+880-1711110205', 'school' => 0],
                ['name' => 'Shahin Alam', 'email' => 'student1@gva.edu.bd', 'phone' => '+880-1722220201', 'school' => 1],
                ['name' => 'Nusrat Jahan', 'email' => 'student2@gva.edu.bd', 'phone' => '+880-1722220202', 'school' => 1],
                ['name' => 'Tanvir Ahmed', 'email' => 'student3@gva.edu.bd', 'phone' => '+880-1722220203', 'school' => 1],
                ['name' => 'Sumaiya Akter', 'email' => 'student4@gva.edu.bd', 'phone' => '+880-1722220204', 'school' => 1],
                ['name' => 'Fahim Chowdhury', 'email' => 'student5@gva.edu.bd', 'phone' => '+880-1722220205', 'school' => 1],
            ];

            foreach ($studentUserData as $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$data['school']],
                    'user_type' => UserType::Student,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($studentRole->id, ['school_id' => $schoolIds[$data['school']]]);
            }

            $parentData = [
                ['name' => 'Abdul Gafur Mia', 'email' => 'parent1@isd.edu.bd', 'phone' => '+880-1711110301', 'school' => 0],
                ['name' => 'Morshed Alam', 'email' => 'parent2@isd.edu.bd', 'phone' => '+880-1711110302', 'school' => 0],
                ['name' => 'Shamim Ara Begum', 'email' => 'parent3@isd.edu.bd', 'phone' => '+880-1711110303', 'school' => 0],
                ['name' => 'Nurul Haque', 'email' => 'parent1@gva.edu.bd', 'phone' => '+880-1722220301', 'school' => 1],
                ['name' => 'Mahbuba Rahman', 'email' => 'parent2@gva.edu.bd', 'phone' => '+880-1722220302', 'school' => 1],
            ];

            foreach ($parentData as $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$data['school']],
                    'user_type' => UserType::Parent,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($parentRole->id, ['school_id' => $schoolIds[$data['school']]]);
            }

            $alumniData = [
                ['name' => 'Hasan Mahmud', 'email' => 'alumni1@isd.edu.bd', 'phone' => '+880-1711110401', 'school' => 0],
                ['name' => 'Taslima Akhter', 'email' => 'alumni1@gva.edu.bd', 'phone' => '+880-1722220401', 'school' => 1],
            ];

            foreach ($alumniData as $data) {
                $user = User::create([
                    'school_id' => $schoolIds[$data['school']],
                    'user_type' => UserType::Alumni,
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'password' => Hash::make('password'),
                    'status' => StatusType::Active->value,
                ]);
                $user->roles()->attach($alumniRole->id, ['school_id' => $schoolIds[$data['school']]]);
            }
        });
    }
}
