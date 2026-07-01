<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [
            [
                'name' => 'International School of Dhaka',
                'eiin' => '123456',
                'address' => 'House-12, Road-5, Dhanmondi, Dhaka-1205',
                'phone' => '+880-2-9661001',
                'email' => 'info@isd.edu.bd',
                'website' => 'https://isd.edu.bd',
                'status' => true,
                'settings' => [
                    'timezone' => 'Asia/Dhaka',
                    'currency' => 'BDT',
                    'language' => 'en',
                    'attendance_type' => 'manual',
                    'sms_enabled' => true,
                    'email_enabled' => true,
                ],
            ],
            [
                'name' => 'Green Valley Academy',
                'eiin' => '789012',
                'address' => 'Plot-25, Block-B, Bashundhara R/A, Dhaka-1229',
                'phone' => '+880-2-8412345',
                'email' => 'contact@gva.edu.bd',
                'website' => 'https://gva.edu.bd',
                'status' => true,
                'settings' => [
                    'timezone' => 'Asia/Dhaka',
                    'currency' => 'BDT',
                    'language' => 'bn',
                    'attendance_type' => 'both',
                    'sms_enabled' => true,
                    'email_enabled' => false,
                ],
            ],
        ];

        foreach ($schools as $schoolData) {
            $settings = $schoolData['settings'];
            unset($schoolData['settings']);

            $school = School::create($schoolData);
            $school->settings()->create($settings);
        }
    }
}
