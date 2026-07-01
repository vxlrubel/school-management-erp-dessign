<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AttendanceRecordDTO;
use App\Enums\AttendanceStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAttendanceRecordRequest;
use App\Http\Requests\Api\V1\UpdateAttendanceRecordRequest;
use App\Http\Resources\Api\V1\AttendanceRecordResource;
use App\Services\AttendanceRecordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AttendanceRecordController extends Controller
{
    public function __construct(
        protected AttendanceRecordService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $records = $this->service->paginate(
            $request->integer('per_page', 15),
            ['attendance', 'user'],
        );

        return response()->json($records);
    }

    public function store(StoreAttendanceRecordRequest $request): JsonResponse
    {
        $dto = new AttendanceRecordDTO(
            attendance_id: $request->input('attendance_id'),
            user_id: $request->input('user_id'),
            status: AttendanceStatus::from($request->input('status')),
            latitude: $request->input('latitude'),
            longitude: $request->input('longitude'),
            device: $request->input('device'),
        );

        $record = $this->service->create($dto);

        return response()->json(
            new AttendanceRecordResource($record),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $record = $this->service->find($id, ['attendance', 'user']);

        if (! $record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new AttendanceRecordResource($record));
    }

    public function update(UpdateAttendanceRecordRequest $request, int $id): JsonResponse
    {
        $record = $this->service->find($id);

        if (! $record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new AttendanceRecordDTO(
            attendance_id: $request->input('attendance_id', $record->attendance_id),
            user_id: $request->input('user_id', $record->user_id),
            status: $request->has('status') ? AttendanceStatus::from($request->input('status')) : AttendanceStatus::from($record->status),
            latitude: $request->input('latitude', $record->latitude),
            longitude: $request->input('longitude', $record->longitude),
            device: $request->input('device', $record->device),
        );

        $record = $this->service->update($id, $dto);

        return response()->json(new AttendanceRecordResource($record));
    }

    public function destroy(int $id): JsonResponse
    {
        $record = $this->service->find($id);

        if (! $record) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
