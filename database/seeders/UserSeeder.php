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


        });
    }
}
