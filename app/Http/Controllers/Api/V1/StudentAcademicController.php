<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentAcademicDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentAcademicRequest;
use App\Http\Requests\Api\V1\UpdateStudentAcademicRequest;
use App\Http\Resources\Api\V1\StudentAcademicResource;
use App\Services\StudentAcademicService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentAcademicController extends Controller
{
    public function __construct(
        protected StudentAcademicService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $academics = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classroom', 'section', 'session'])
            : $this->service->all(['classroom', 'section', 'session']);

        return response()->json(StudentAcademicResource::collection($academics));
    }

    public function store(StoreStudentAcademicRequest $request): JsonResponse
    {
        $academic = $this->service->create(StudentAcademicDTO::fromArray($request->validated()));

        return response()->json(new StudentAcademicResource($academic), 201);
    }

    public function show(int $id): JsonResponse
    {
        $academic = $this->service->find($id, ['classroom', 'section', 'session']);

        if (! $academic) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new StudentAcademicResource($academic));
    }

    public function update(UpdateStudentAcademicRequest $request, int $id): JsonResponse
    {
        $academic = $this->service->update($id, StudentAcademicDTO::fromArray($request->validated()));

        return response()->json(new StudentAcademicResource($academic));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
