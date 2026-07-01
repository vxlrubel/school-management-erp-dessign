<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $roles = [
                ['name' => 'Super Admin', 'slug' => 'super-admin', 'description' => 'Full system access'],
                ['name' => 'School Admin', 'slug' => 'school-admin', 'description' => 'Administrator for a specific school'],
                ['name' => 'Teacher', 'slug' => 'teacher', 'description' => 'Teaching staff'],
                ['name' => 'Employee', 'slug' => 'employee', 'description' => 'Non-teaching staff'],
                ['name' => 'Student', 'slug' => 'student', 'description' => 'Enrolled student'],
                ['name' => 'Parent', 'slug' => 'parent', 'description' => 'Parent or guardian'],
                ['name' => 'Alumni', 'slug' => 'alumni', 'description' => 'Graduated former student'],
            ];

            $modules = [
                'school-management',
                'user-management',
                'academic-management',
                'student-management',
                'teacher-management',
                'employee-management',
                'attendance-management',
                'fee-management',
                'exam-management',
                'routine-management',
                'cms-management',
                'admission-management',
                'leave-management',
                'sms-management',
                'certificate-management',
                'alumni-management',
                'online-class-management',
                'media-management',
                'notification-management',
            ];

            $actions = ['view', 'create', 'edit', 'delete'];

            $createdPermissions = [];
            foreach ($modules as $module) {
                foreach ($actions as $action) {
                    $permission = Permission::create([
                        'name' => ucfirst($action).' '.str_replace('-', ' ', ucwords($module, '-')),
                        'slug' => $action.'-'.$module,
                        'description' => "Can {$action} ".str_replace('-', ' ', $module),
                    ]);
                    $createdPermissions[$permission->slug] = $permission;
                }
            }

            $createdRoles = [];
            foreach ($roles as $roleData) {
                $createdRoles[$roleData['slug']] = Role::create($roleData);
            }

            $superAdminPermissions = $createdPermissions;
            $createdRoles['super-admin']->permissions()->attach(
                collect($superAdminPermissions)->pluck('id')->toArray()
            );

            $schoolAdminModules = [
                'school-management', 'user-management', 'academic-management',
                'student-management', 'teacher-management', 'employee-management',
                'attendance-management', 'fee-management', 'exam-management',
                'routine-management', 'cms-management', 'admission-management',
                'leave-management', 'sms-management', 'certificate-management',
                'alumni-management', 'online-class-management', 'media-management',
                'notification-management',
            ];
            $schoolAdminSlugs = [];
            foreach ($schoolAdminModules as $module) {
                foreach ($actions as $action) {
                    $schoolAdminSlugs[] = $action.'-'.$module;
                }
            }
            $createdRoles['school-admin']->permissions()->attach(
                collect($schoolAdminSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );

            $teacherModules = ['academic-management', 'student-management', 'attendance-management', 'exam-management', 'routine-management', 'online-class-management'];
            $teacherActions = ['view', 'create', 'edit'];
            $teacherSlugs = [];
            foreach ($teacherModules as $module) {
                foreach ($teacherActions as $action) {
                    $teacherSlugs[] = $action.'-'.$module;
                }
            }
            $teacherSlugs[] = 'view-teacher-management';
            $createdRoles['teacher']->permissions()->attach(
                collect($teacherSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );

            $employeeModules = ['attendance-management', 'leave-management'];
            $employeeActions = ['view', 'create'];
            $employeeSlugs = [];
            foreach ($employeeModules as $module) {
                foreach ($employeeActions as $action) {
                    $employeeSlugs[] = $action.'-'.$module;
                }
            }
            $employeeSlugs = array_merge($employeeSlugs, [
                'view-employee-management', 'view-notification-management',
            ]);
            $createdRoles['employee']->permissions()->attach(
                collect($employeeSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );

            $studentSlugs = [
                'view-routine-management', 'view-exam-management',
                'view-academic-management', 'view-notification-management',
                'view-online-class-management',
            ];
            $createdRoles['student']->permissions()->attach(
                collect($studentSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );

            $parentSlugs = [
                'view-student-management', 'view-attendance-management',
                'view-exam-management', 'view-fee-management',
                'view-routine-management', 'view-notification-management',
            ];
            $createdRoles['parent']->permissions()->attach(
                collect($parentSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );

            $alumniSlugs = [
                'view-alumni-management', 'view-notification-management',
            ];
            $createdRoles['alumni']->permissions()->attach(
                collect($alumniSlugs)->map(fn ($s) => $createdPermissions[$s]->id)->toArray()
            );
        });
    }
}
