<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AdmissionApplicationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAdmissionApplicationRequest;
use App\Http\Requests\Api\V1\UpdateAdmissionApplicationRequest;
use App\Http\Resources\Api\V1\AdmissionApplicationResource;
use App\Services\AdmissionApplicationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdmissionApplicationController extends Controller
{
    public function __construct(
        protected AdmissionApplicationService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $applications = $this->service->paginate($perPage);

        return response()->json([
            'data' => AdmissionApplicationResource::collection($applications),
            'meta' => [
                'per_page' => $applications->perPage(),
                'total' => $applications->total(),
            ],
        ]);
    }

    public function store(StoreAdmissionApplicationRequest $request): JsonResponse
    {
        $dto = AdmissionApplicationDTO::fromArray($request->validated());
        $application = $this->service->create($dto);

        return response()->json([
            'data' => new AdmissionApplicationResource($application),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $application = $this->service->find($id);

        if (! $application) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new AdmissionApplicationResource($application),
        ]);
    }

    public function update(UpdateAdmissionApplicationRequest $request, int $id): JsonResponse
    {
        $dto = AdmissionApplicationDTO::fromArray($request->validated());
        $application = $this->service->update($id, $dto);

        return response()->json([
            'data' => new AdmissionApplicationResource($application),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
