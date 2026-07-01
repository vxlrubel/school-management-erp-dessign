<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ExamSubjectDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreExamSubjectRequest;
use App\Http\Requests\Api\V1\UpdateExamSubjectRequest;
use App\Http\Resources\Api\V1\ExamSubjectResource;
use App\Services\ExamSubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExamSubjectController extends Controller
{
    public function __construct(
        protected ExamSubjectService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $examSubjects = $this->service->paginate(
            $request->integer('per_page', 15),
            ['exam', 'subject'],
        );

        return response()->json($examSubjects);
    }

    public function store(StoreExamSubjectRequest $request): JsonResponse
    {
        $dto = new ExamSubjectDTO(
            exam_id: $request->input('exam_id'),
            subject_id: $request->input('subject_id'),
            full_marks: $request->input('full_marks'),
            pass_marks: $request->input('pass_marks'),
        );

        $examSubject = $this->service->create($dto);

        return response()->json(
            new ExamSubjectResource($examSubject),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $examSubject = $this->service->find($id, ['exam', 'subject']);

        if (! $examSubject) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ExamSubjectResource($examSubject));
    }

    public function update(UpdateExamSubjectRequest $request, int $id): JsonResponse
    {
        $examSubject = $this->service->find($id);

        if (! $examSubject) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new ExamSubjectDTO(
            exam_id: $request->input('exam_id', $examSubject->exam_id),
            subject_id: $request->input('subject_id', $examSubject->subject_id),
            full_marks: $request->input('full_marks', $examSubject->full_marks),
            pass_marks: $request->input('pass_marks', $examSubject->pass_marks),
        );

        $examSubject = $this->service->update($id, $dto);

        return response()->json(new ExamSubjectResource($examSubject));
    }

    public function destroy(int $id): JsonResponse
    {
        $examSubject = $this->service->find($id);

        if (! $examSubject) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
