<?php

use App\Http\Controllers\Api\V1\ActivityLogController;
use App\Http\Controllers\Api\V1\AdmissionApplicationController;
use App\Http\Controllers\Api\V1\AdmissionLotteryController;
use App\Http\Controllers\Api\V1\AlumniController;
use App\Http\Controllers\Api\V1\AlumniEventController;
use App\Http\Controllers\Api\V1\AlumniEventRegistrationController;
use App\Http\Controllers\Api\V1\AttendanceController;
use App\Http\Controllers\Api\V1\AttendanceRecordController;
use App\Http\Controllers\Api\V1\CertificateController;
use App\Http\Controllers\Api\V1\CertificateTemplateController;
use App\Http\Controllers\Api\V1\ClassroomController;
use App\Http\Controllers\Api\V1\ClassRoutineController;
use App\Http\Controllers\Api\V1\ClassSubjectController;
use App\Http\Controllers\Api\V1\ClassTeacherController;
use App\Http\Controllers\Api\V1\DigitalContentController;
use App\Http\Controllers\Api\V1\EmployeeCardController;
use App\Http\Controllers\Api\V1\EmployeeController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\ExamController;
use App\Http\Controllers\Api\V1\ExamSubjectController;
use App\Http\Controllers\Api\V1\FeeHeadController;
use App\Http\Controllers\Api\V1\FeeStructureController;
use App\Http\Controllers\Api\V1\GalleryController;
use App\Http\Controllers\Api\V1\IdCardTemplateController;
use App\Http\Controllers\Api\V1\LeaveRequestController;
use App\Http\Controllers\Api\V1\LeaveTypeController;
use App\Http\Controllers\Api\V1\MarkController;
use App\Http\Controllers\Api\V1\MediaController;
use App\Http\Controllers\Api\V1\NoticeController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\OnlineClassController;
use App\Http\Controllers\Api\V1\PageController;
use App\Http\Controllers\Api\V1\PeriodController;
use App\Http\Controllers\Api\V1\PermissionController;
use App\Http\Controllers\Api\V1\PopupSettingController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\SchoolController;
use App\Http\Controllers\Api\V1\SectionController;
use App\Http\Controllers\Api\V1\SessionController;
use App\Http\Controllers\Api\V1\SliderController;
use App\Http\Controllers\Api\V1\SmsLogController;
use App\Http\Controllers\Api\V1\StudentAcademicController;
use App\Http\Controllers\Api\V1\StudentCardController;
use App\Http\Controllers\Api\V1\StudentController;
use App\Http\Controllers\Api\V1\StudentFeeController;
use App\Http\Controllers\Api\V1\StudentGuardianController;
use App\Http\Controllers\Api\V1\StudentVaccineController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\TabulationController;
use App\Http\Controllers\Api\V1\TeacherCardController;
use App\Http\Controllers\Api\V1\TeacherController;
use App\Http\Controllers\Api\V1\TransactionController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\VaccineController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('users', UserController::class);

    Route::apiResource('sessions', SessionController::class);
    Route::apiResource('classes', ClassroomController::class);
    Route::apiResource('sections', SectionController::class);
    Route::apiResource('subjects', SubjectController::class);
    Route::apiResource('class-subjects', ClassSubjectController::class);
    Route::apiResource('class-teachers', ClassTeacherController::class);

    Route::apiResource('students', StudentController::class);
    Route::apiResource('student-guardians', StudentGuardianController::class);
    Route::apiResource('student-academics', StudentAcademicController::class);

    Route::apiResource('teachers', TeacherController::class);
    Route::apiResource('employees', EmployeeController::class);

    Route::apiResource('attendance', AttendanceController::class);
    Route::apiResource('attendance-records', AttendanceRecordController::class);

    Route::apiResource('fee-heads', FeeHeadController::class);
    Route::apiResource('fee-structures', FeeStructureController::class);
    Route::apiResource('student-fees', StudentFeeController::class);
    Route::apiResource('transactions', TransactionController::class);

    Route::apiResource('exams', ExamController::class);
    Route::apiResource('exam-subjects', ExamSubjectController::class);
    Route::apiResource('marks', MarkController::class);
    Route::apiResource('tabulations', TabulationController::class);

    Route::apiResource('periods', PeriodController::class);
    Route::apiResource('class-routines', ClassRoutineController::class);

    Route::apiResource('pages', PageController::class);
    Route::apiResource('sliders', SliderController::class);
    Route::apiResource('galleries', GalleryController::class);
    Route::apiResource('notices', NoticeController::class);
    Route::apiResource('events', EventController::class);
    Route::apiResource('popup-settings', PopupSettingController::class);

    Route::apiResource('admission-applications', AdmissionApplicationController::class);
    Route::apiResource('admission-lotteries', AdmissionLotteryController::class);

    Route::apiResource('leave-types', LeaveTypeController::class);
    Route::apiResource('leave-requests', LeaveRequestController::class);

    Route::apiResource('sms-logs', SmsLogController::class);

    Route::apiResource('certificate-templates', CertificateTemplateController::class);
    Route::apiResource('certificates', CertificateController::class);

    Route::apiResource('alumni', AlumniController::class);
    Route::apiResource('alumni-events', AlumniEventController::class);
    Route::apiResource('alumni-event-registrations', AlumniEventRegistrationController::class);

    Route::apiResource('vaccines', VaccineController::class);
    Route::apiResource('student-vaccines', StudentVaccineController::class);

    Route::apiResource('online-classes', OnlineClassController::class);
    Route::apiResource('digital-contents', DigitalContentController::class);

    Route::apiResource('id-card-templates', IdCardTemplateController::class);
    Route::apiResource('student-cards', StudentCardController::class);
    Route::apiResource('teacher-cards', TeacherCardController::class);
    Route::apiResource('employee-cards', EmployeeCardController::class);

    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('media', MediaController::class);
    Route::apiResource('activity-logs', ActivityLogController::class);
});
