<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\FeeStructureDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreFeeStructureRequest;
use App\Http\Requests\Api\V1\UpdateFeeStructureRequest;
use App\Http\Resources\Api\V1\FeeStructureResource;
use App\Services\FeeStructureService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeeStructureController extends Controller
{
    public function __construct(
        protected FeeStructureService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $feeStructures = $this->service->paginate(
            $request->integer('per_page', 15),
            ['classroom', 'feeHead'],
        );

        return response()->json($feeStructures);
    }

    public function store(StoreFeeStructureRequest $request): JsonResponse
    {
        $dto = new FeeStructureDTO(
            class_id: $request->input('class_id'),
            fee_head_id: $request->input('fee_head_id'),
            amount: $request->input('amount'),
        );

        $feeStructure = $this->service->create($dto);

        return response()->json(
            new FeeStructureResource($feeStructure),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $feeStructure = $this->service->find($id, ['classroom', 'feeHead']);

        if (! $feeStructure) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new FeeStructureResource($feeStructure));
    }

    public function update(UpdateFeeStructureRequest $request, int $id): JsonResponse
    {
        $feeStructure = $this->service->find($id);

        if (! $feeStructure) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new FeeStructureDTO(
            class_id: $request->input('class_id', $feeStructure->class_id),
            fee_head_id: $request->input('fee_head_id', $feeStructure->fee_head_id),
            amount: $request->input('amount', $feeStructure->amount),
        );

        $feeStructure = $this->service->update($id, $dto);

        return response()->json(new FeeStructureResource($feeStructure));
    }

    public function destroy(int $id): JsonResponse
    {
        $feeStructure = $this->service->find($id);

        if (! $feeStructure) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
