<?php

namespace App\Enums;

enum UserType: string
{
    case SuperAdmin = 'super_admin';
    case SchoolAdmin = 'school_admin';
    case Teacher = 'teacher';
    case Employee = 'employee';
    case Student = 'student';
    case Parent = 'parent';
    case Alumni = 'alumni';
}
