<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\LeaveRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreLeaveRequestRequest;
use App\Http\Requests\Api\V1\UpdateLeaveRequestRequest;
use App\Http\Resources\Api\V1\LeaveRequestResource;
use App\Services\LeaveRequestService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function __construct(
        protected LeaveRequestService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $leaveRequests = $this->service->paginate($perPage);

        return response()->json([
            'data' => LeaveRequestResource::collection($leaveRequests),
            'meta' => [
                'per_page' => $leaveRequests->perPage(),
                'total' => $leaveRequests->total(),
            ],
        ]);
    }

    public function store(StoreLeaveRequestRequest $request): JsonResponse
    {
        $dto = LeaveRequestDTO::fromArray($request->validated());
        $leaveRequest = $this->service->create($dto);

        return response()->json([
            'data' => new LeaveRequestResource($leaveRequest),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $leaveRequest = $this->service->find($id);

        if (! $leaveRequest) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new LeaveRequestResource($leaveRequest),
        ]);
    }

    public function update(UpdateLeaveRequestRequest $request, int $id): JsonResponse
    {
        $dto = LeaveRequestDTO::fromArray($request->validated());
        $leaveRequest = $this->service->update($id, $dto);

        return response()->json([
            'data' => new LeaveRequestResource($leaveRequest),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
