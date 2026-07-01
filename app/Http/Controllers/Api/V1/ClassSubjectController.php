<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ClassSubjectDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClassSubjectRequest;
use App\Http\Requests\Api\V1\UpdateClassSubjectRequest;
use App\Http\Resources\Api\V1\ClassSubjectResource;
use App\Services\ClassSubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassSubjectController extends Controller
{
    public function __construct(
        protected ClassSubjectService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $classSubjects = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classroom', 'subject', 'teacher'])
            : $this->service->all(['classroom', 'subject', 'teacher']);

        return response()->json(ClassSubjectResource::collection($classSubjects));
    }

    public function store(StoreClassSubjectRequest $request): JsonResponse
    {
        $classSubject = $this->service->create(ClassSubjectDTO::fromArray($request->validated()));

        return response()->json(new ClassSubjectResource($classSubject), 201);
    }

    public function show(int $id): JsonResponse
    {
        $classSubject = $this->service->find($id, ['classroom', 'subject', 'teacher']);

        if (! $classSubject) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ClassSubjectResource($classSubject));
    }

    public function update(UpdateClassSubjectRequest $request, int $id): JsonResponse
    {
        $classSubject = $this->service->update($id, ClassSubjectDTO::fromArray($request->validated()));

        return response()->json(new ClassSubjectResource($classSubject));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
