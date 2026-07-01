<?php

namespace Database\Seeders;

use App\Enums\StatusType;
use App\Enums\UserType;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    private array $employeeNames = [
        'Mr. Abdul Mannan', 'Mr. Aminul Islam', 'Mr. Siddiqur Rahman',
        'Mr. Shamsul Haque', 'Mr. Joynal Abedin', 'Mr. Fazlur Rahman',
        'Mr. Moksud Alam', 'Mr. Abdul Baten', 'Mr. Jahurul Islam', 'Mr. Shahidul Islam',
    ];

    private array $designations = [
        'Office Assistant', 'Accountant', 'Librarian', 'Security Guard', 'Janitor',
        'IT Support', 'Administrative Officer', 'Lab Assistant', 'Store Keeper', 'Driver',
    ];

    public function run(): void
    {
        DB::transaction(function () {
            $employeeRole = Role::where('slug', 'employee')->first();

            foreach ([1, 2] as $schoolId) {
                for ($i = 0; $i < 10; $i++) {
                    $name = $this->employeeNames[$i % count($this->employeeNames)];
                    $email = 'emp'.($i + 1).'@'.($schoolId === 1 ? 'isd' : 'gva').'.edu.bd';

                    $user = User::create([
                        'school_id' => $schoolId,
                        'user_type' => UserType::Employee,
                        'name' => $name,
                        'email' => $email,
                        'phone' => '+880-17'.$schoolId.rand(2000000, 2999999),
                        'password' => Hash::make('password'),
                        'status' => StatusType::Active->value,
                    ]);

                    Employee::create([
                        'school_id' => $schoolId,
                        'designation' => $this->designations[array_rand($this->designations)],
                        'joining_date' => now()->subYears(rand(1, 12))->subDays(rand(0, 365)),
                        'salary' => rand(15000, 45000),
                        'user_id' => $user->id,
                    ]);

                    $user->roles()->attach($employeeRole->id, ['school_id' => $schoolId]);
                }
            }
        });
    }
}
