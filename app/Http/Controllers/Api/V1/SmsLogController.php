<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SmsLogDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSmsLogRequest;
use App\Http\Requests\Api\V1\UpdateSmsLogRequest;
use App\Http\Resources\Api\V1\SmsLogResource;
use App\Services\SmsLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SmsLogController extends Controller
{
    public function __construct(
        protected SmsLogService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $smsLogs = $this->service->paginate($perPage);

        return response()->json([
            'data' => SmsLogResource::collection($smsLogs),
            'meta' => [
                'per_page' => $smsLogs->perPage(),
                'total' => $smsLogs->total(),
            ],
        ]);
    }

    public function store(StoreSmsLogRequest $request): JsonResponse
    {
        $dto = SmsLogDTO::fromArray($request->validated());
        $smsLog = $this->service->create($dto);

        return response()->json([
            'data' => new SmsLogResource($smsLog),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $smsLog = $this->service->find($id);

        if (! $smsLog) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new SmsLogResource($smsLog),
        ]);
    }

    public function update(UpdateSmsLogRequest $request, int $id): JsonResponse
    {
        $dto = SmsLogDTO::fromArray($request->validated());
        $smsLog = $this->service->update($id, $dto);

        return response()->json([
            'data' => new SmsLogResource($smsLog),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
