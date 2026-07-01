<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\LeaveTypeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreLeaveTypeRequest;
use App\Http\Requests\Api\V1\UpdateLeaveTypeRequest;
use App\Http\Resources\Api\V1\LeaveTypeResource;
use App\Services\LeaveTypeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function __construct(
        protected LeaveTypeService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $leaveTypes = $this->service->paginate($perPage);

        return response()->json([
            'data' => LeaveTypeResource::collection($leaveTypes),
            'meta' => [
                'per_page' => $leaveTypes->perPage(),
                'total' => $leaveTypes->total(),
            ],
        ]);
    }

    public function store(StoreLeaveTypeRequest $request): JsonResponse
    {
        $dto = LeaveTypeDTO::fromArray($request->validated());
        $leaveType = $this->service->create($dto);

        return response()->json([
            'data' => new LeaveTypeResource($leaveType),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $leaveType = $this->service->find($id);

        if (! $leaveType) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new LeaveTypeResource($leaveType),
        ]);
    }

    public function update(UpdateLeaveTypeRequest $request, int $id): JsonResponse
    {
        $dto = LeaveTypeDTO::fromArray($request->validated());
        $leaveType = $this->service->update($id, $dto);

        return response()->json([
            'data' => new LeaveTypeResource($leaveType),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
