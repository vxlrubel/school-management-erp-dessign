<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\FeeHeadDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreFeeHeadRequest;
use App\Http\Requests\Api\V1\UpdateFeeHeadRequest;
use App\Http\Resources\Api\V1\FeeHeadResource;
use App\Services\FeeHeadService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeeHeadController extends Controller
{
    public function __construct(
        protected FeeHeadService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $feeHeads = $this->service->paginate(
            $request->integer('per_page', 15),
            ['feeStructures'],
        );

        return response()->json($feeHeads);
    }

    public function store(StoreFeeHeadRequest $request): JsonResponse
    {
        $dto = new FeeHeadDTO(
            school_id: $request->user()->school_id,
            name: $request->input('name'),
        );

        $feeHead = $this->service->create($dto);

        return response()->json(
            new FeeHeadResource($feeHead),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $feeHead = $this->service->find($id, ['feeStructures', 'feeStructures.classroom']);

        if (! $feeHead) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new FeeHeadResource($feeHead));
    }

    public function update(UpdateFeeHeadRequest $request, int $id): JsonResponse
    {
        $feeHead = $this->service->find($id);

        if (! $feeHead) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new FeeHeadDTO(
            school_id: $feeHead->school_id,
            name: $request->input('name', $feeHead->name),
        );

        $feeHead = $this->service->update($id, $dto);

        return response()->json(new FeeHeadResource($feeHead));
    }

    public function destroy(int $id): JsonResponse
    {
        $feeHead = $this->service->find($id);

        if (! $feeHead) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
