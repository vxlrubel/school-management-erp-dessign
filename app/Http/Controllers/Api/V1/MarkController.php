<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\MarkDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMarkRequest;
use App\Http\Requests\Api\V1\UpdateMarkRequest;
use App\Http\Resources\Api\V1\MarkResource;
use App\Services\MarkService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MarkController extends Controller
{
    public function __construct(
        protected MarkService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $marks = $this->service->paginate(
            $request->integer('per_page', 15),
            ['examSubject', 'student'],
        );

        return response()->json($marks);
    }

    public function store(StoreMarkRequest $request): JsonResponse
    {
        $dto = new MarkDTO(
            exam_subject_id: $request->input('exam_subject_id'),
            student_id: $request->input('student_id'),
            marks: $request->input('marks'),
            grade: $request->input('grade'),
        );

        $mark = $this->service->create($dto);

        return response()->json(
            new MarkResource($mark),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $mark = $this->service->find($id, ['examSubject', 'student']);

        if (! $mark) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new MarkResource($mark));
    }

    public function update(UpdateMarkRequest $request, int $id): JsonResponse
    {
        $mark = $this->service->find($id);

        if (! $mark) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new MarkDTO(
            exam_subject_id: $request->input('exam_subject_id', $mark->exam_subject_id),
            student_id: $request->input('student_id', $mark->student_id),
            marks: $request->input('marks', $mark->marks),
            grade: $request->input('grade', $mark->grade),
        );

        $mark = $this->service->update($id, $dto);

        return response()->json(new MarkResource($mark));
    }

    public function destroy(int $id): JsonResponse
    {
        $mark = $this->service->find($id);

        if (! $mark) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
