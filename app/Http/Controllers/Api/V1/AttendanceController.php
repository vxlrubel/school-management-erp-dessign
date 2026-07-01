<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AttendanceDTO;
use App\Enums\AttendanceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAttendanceRequest;
use App\Http\Requests\Api\V1\UpdateAttendanceRequest;
use App\Http\Resources\Api\V1\AttendanceResource;
use App\Services\AttendanceService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct(
        protected AttendanceService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $attendance = $this->service->paginate(
            $request->integer('per_page', 15),
            ['attendanceRecords'],
        );

        return response()->json($attendance);
    }

    public function store(StoreAttendanceRequest $request): JsonResponse
    {
        $dto = new AttendanceDTO(
            school_id: $request->user()->school_id,
            attendance_date: $request->input('attendance_date'),
            type: AttendanceType::from($request->input('type')),
        );

        $attendance = $this->service->create($dto);

        return response()->json(
            new AttendanceResource($attendance),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $attendance = $this->service->find($id, ['attendanceRecords', 'attendanceRecords.user']);

        if (! $attendance) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new AttendanceResource($attendance));
    }

    public function update(UpdateAttendanceRequest $request, int $id): JsonResponse
    {
        $attendance = $this->service->find($id);

        if (! $attendance) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new AttendanceDTO(
            school_id: $attendance->school_id,
            attendance_date: $request->input('attendance_date', $attendance->attendance_date),
            type: $request->has('type') ? AttendanceType::from($request->input('type')) : AttendanceType::from($attendance->type),
        );

        $attendance = $this->service->update($id, $dto);

        return response()->json(new AttendanceResource($attendance));
    }

    public function destroy(int $id): JsonResponse
    {
        $attendance = $this->service->find($id);

        if (! $attendance) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
