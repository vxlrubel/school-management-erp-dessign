<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AdmissionLotteryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAdmissionLotteryRequest;
use App\Http\Requests\Api\V1\UpdateAdmissionLotteryRequest;
use App\Http\Resources\Api\V1\AdmissionLotteryResource;
use App\Services\AdmissionLotteryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdmissionLotteryController extends Controller
{
    public function __construct(
        protected AdmissionLotteryService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $lotteries = $this->service->paginate($perPage);

        return response()->json([
            'data' => AdmissionLotteryResource::collection($lotteries),
            'meta' => [
                'per_page' => $lotteries->perPage(),
                'total' => $lotteries->total(),
            ],
        ]);
    }

    public function store(StoreAdmissionLotteryRequest $request): JsonResponse
    {
        $dto = AdmissionLotteryDTO::fromArray($request->validated());
        $lottery = $this->service->create($dto);

        return response()->json([
            'data' => new AdmissionLotteryResource($lottery),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $lottery = $this->service->find($id);

        if (! $lottery) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new AdmissionLotteryResource($lottery),
        ]);
    }

    public function update(UpdateAdmissionLotteryRequest $request, int $id): JsonResponse
    {
        $dto = AdmissionLotteryDTO::fromArray($request->validated());
        $lottery = $this->service->update($id, $dto);

        return response()->json([
            'data' => new AdmissionLotteryResource($lottery),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
