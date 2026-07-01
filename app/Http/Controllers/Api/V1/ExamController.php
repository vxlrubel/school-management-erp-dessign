<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ExamDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreExamRequest;
use App\Http\Requests\Api\V1\UpdateExamRequest;
use App\Http\Resources\Api\V1\ExamResource;
use App\Services\ExamService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function __construct(
        protected ExamService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $exams = $this->service->paginate(
            $request->integer('per_page', 15),
            ['session', 'examSubjects'],
        );

        return response()->json($exams);
    }

    public function store(StoreExamRequest $request): JsonResponse
    {
        $dto = new ExamDTO(
            school_id: $request->user()->school_id,
            title: $request->input('title'),
            session_id: $request->input('session_id'),
        );

        $exam = $this->service->create($dto);

        return response()->json(
            new ExamResource($exam),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $exam = $this->service->find($id, ['session', 'examSubjects', 'examSubjects.subject']);

        if (! $exam) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ExamResource($exam));
    }

    public function update(UpdateExamRequest $request, int $id): JsonResponse
    {
        $exam = $this->service->find($id);

        if (! $exam) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new ExamDTO(
            school_id: $exam->school_id,
            title: $request->input('title', $exam->title),
            session_id: $request->input('session_id', $exam->session_id),
        );

        $exam = $this->service->update($id, $dto);

        return response()->json(new ExamResource($exam));
    }

    public function destroy(int $id): JsonResponse
    {
        $exam = $this->service->find($id);

        if (! $exam) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
