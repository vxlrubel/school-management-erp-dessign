<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ClassRoutineDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClassRoutineRequest;
use App\Http\Requests\Api\V1\UpdateClassRoutineRequest;
use App\Http\Resources\Api\V1\ClassRoutineResource;
use App\Services\ClassRoutineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassRoutineController extends Controller
{
    public function __construct(
        protected ClassRoutineService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $routines = $this->service->paginate(
            $request->integer('per_page', 15),
            ['classroom', 'section', 'period', 'subject', 'teacher'],
        );

        return response()->json($routines);
    }

    public function store(StoreClassRoutineRequest $request): JsonResponse
    {
        $dto = new ClassRoutineDTO(
            class_id: $request->input('class_id'),
            section_id: $request->input('section_id'),
            day: $request->input('day'),
            period_id: $request->input('period_id'),
            subject_id: $request->input('subject_id'),
            teacher_id: $request->input('teacher_id'),
        );

        $routine = $this->service->create($dto);

        return response()->json(
            new ClassRoutineResource($routine),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $routine = $this->service->find($id, ['classroom', 'section', 'period', 'subject', 'teacher']);

        if (! $routine) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ClassRoutineResource($routine));
    }

    public function update(UpdateClassRoutineRequest $request, int $id): JsonResponse
    {
        $routine = $this->service->find($id);

        if (! $routine) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new ClassRoutineDTO(
            class_id: $request->input('class_id', $routine->class_id),
            section_id: $request->input('section_id', $routine->section_id),
            day: $request->input('day', $routine->day),
            period_id: $request->input('period_id', $routine->period_id),
            subject_id: $request->input('subject_id', $routine->subject_id),
            teacher_id: $request->input('teacher_id', $routine->teacher_id),
        );

        $routine = $this->service->update($id, $dto);

        return response()->json(new ClassRoutineResource($routine));
    }

    public function destroy(int $id): JsonResponse
    {
        $routine = $this->service->find($id);

        if (! $routine) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
