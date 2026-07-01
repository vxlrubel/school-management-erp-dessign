<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TabulationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTabulationRequest;
use App\Http\Requests\Api\V1\UpdateTabulationRequest;
use App\Http\Resources\Api\V1\TabulationResource;
use App\Services\TabulationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TabulationController extends Controller
{
    public function __construct(
        protected TabulationService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $tabulations = $this->service->paginate(
            $request->integer('per_page', 15),
            ['exam', 'student'],
        );

        return response()->json($tabulations);
    }

    public function store(StoreTabulationRequest $request): JsonResponse
    {
        $dto = new TabulationDTO(
            exam_id: $request->input('exam_id'),
            student_id: $request->input('student_id'),
            gpa: $request->input('gpa'),
            position: $request->input('position'),
        );

        $tabulation = $this->service->create($dto);

        return response()->json(
            new TabulationResource($tabulation),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $tabulation = $this->service->find($id, ['exam', 'student']);

        if (! $tabulation) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new TabulationResource($tabulation));
    }

    public function update(UpdateTabulationRequest $request, int $id): JsonResponse
    {
        $tabulation = $this->service->find($id);

        if (! $tabulation) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new TabulationDTO(
            exam_id: $request->input('exam_id', $tabulation->exam_id),
            student_id: $request->input('student_id', $tabulation->student_id),
            gpa: $request->input('gpa', $tabulation->gpa),
            position: $request->input('position', $tabulation->position),
        );

        $tabulation = $this->service->update($id, $dto);

        return response()->json(new TabulationResource($tabulation));
    }

    public function destroy(int $id): JsonResponse
    {
        $tabulation = $this->service->find($id);

        if (! $tabulation) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
