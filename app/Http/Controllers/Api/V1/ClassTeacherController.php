<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ClassTeacherDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClassTeacherRequest;
use App\Http\Requests\Api\V1\UpdateClassTeacherRequest;
use App\Http\Resources\Api\V1\ClassTeacherResource;
use App\Services\ClassTeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassTeacherController extends Controller
{
    public function __construct(
        protected ClassTeacherService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $classTeachers = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classroom', 'teacher'])
            : $this->service->all(['classroom', 'teacher']);

        return response()->json(ClassTeacherResource::collection($classTeachers));
    }

    public function store(StoreClassTeacherRequest $request): JsonResponse
    {
        $classTeacher = $this->service->create(ClassTeacherDTO::fromArray($request->validated()));

        return response()->json(new ClassTeacherResource($classTeacher), 201);
    }

    public function show(int $id): JsonResponse
    {
        $classTeacher = $this->service->find($id, ['classroom', 'teacher']);

        if (! $classTeacher) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ClassTeacherResource($classTeacher));
    }

    public function update(UpdateClassTeacherRequest $request, int $id): JsonResponse
    {
        $classTeacher = $this->service->update($id, ClassTeacherDTO::fromArray($request->validated()));

        return response()->json(new ClassTeacherResource($classTeacher));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
