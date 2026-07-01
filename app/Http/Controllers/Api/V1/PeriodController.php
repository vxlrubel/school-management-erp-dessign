<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\PeriodDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePeriodRequest;
use App\Http\Requests\Api\V1\UpdatePeriodRequest;
use App\Http\Resources\Api\V1\PeriodResource;
use App\Services\PeriodService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function __construct(
        protected PeriodService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $periods = $this->service->paginate(
            $request->integer('per_page', 15),
        );

        return response()->json($periods);
    }

    public function store(StorePeriodRequest $request): JsonResponse
    {
        $dto = new PeriodDTO(
            school_id: $request->user()->school_id,
            name: $request->input('name'),
            start_time: $request->input('start_time'),
            end_time: $request->input('end_time'),
        );

        $period = $this->service->create($dto);

        return response()->json(
            new PeriodResource($period),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $period = $this->service->find($id);

        if (! $period) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new PeriodResource($period));
    }

    public function update(UpdatePeriodRequest $request, int $id): JsonResponse
    {
        $period = $this->service->find($id);

        if (! $period) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new PeriodDTO(
            school_id: $period->school_id,
            name: $request->input('name', $period->name),
            start_time: $request->input('start_time', $period->start_time),
            end_time: $request->input('end_time', $period->end_time),
        );

        $period = $this->service->update($id, $dto);

        return response()->json(new PeriodResource($period));
    }

    public function destroy(int $id): JsonResponse
    {
        $period = $this->service->find($id);

        if (! $period) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
