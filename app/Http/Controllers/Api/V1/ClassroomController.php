<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ClassroomDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreClassroomRequest;
use App\Http\Requests\Api\V1\UpdateClassroomRequest;
use App\Http\Resources\Api\V1\ClassroomResource;
use App\Services\ClassroomService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function __construct(
        protected ClassroomService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $classrooms = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['sections', 'subjects', 'teachers'])
            : $this->service->all(['sections', 'subjects', 'teachers']);

        return response()->json(ClassroomResource::collection($classrooms));
    }

    public function store(StoreClassroomRequest $request): JsonResponse
    {
        $classroom = $this->service->create(ClassroomDTO::fromArray($request->validated()));

        return response()->json(new ClassroomResource($classroom), 201);
    }

    public function show(int $id): JsonResponse
    {
        $classroom = $this->service->find($id, ['sections', 'subjects', 'teachers']);

        if (! $classroom) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new ClassroomResource($classroom));
    }

    public function update(UpdateClassroomRequest $request, int $id): JsonResponse
    {
        $classroom = $this->service->update($id, ClassroomDTO::fromArray($request->validated()));

        return response()->json(new ClassroomResource($classroom));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
