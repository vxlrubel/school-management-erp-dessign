<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TeacherDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTeacherRequest;
use App\Http\Requests\Api\V1\UpdateTeacherRequest;
use App\Http\Resources\Api\V1\TeacherResource;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function __construct(
        protected TeacherService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $teachers = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classrooms'])
            : $this->service->all(['classrooms']);

        return response()->json(TeacherResource::collection($teachers));
    }

    public function store(StoreTeacherRequest $request): JsonResponse
    {
        $teacher = $this->service->create(TeacherDTO::fromArray($request->validated()));

        return response()->json(new TeacherResource($teacher), 201);
    }

    public function show(int $id): JsonResponse
    {
        $teacher = $this->service->find($id, ['classrooms']);

        if (! $teacher) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new TeacherResource($teacher));
    }

    public function update(UpdateTeacherRequest $request, int $id): JsonResponse
    {
        $teacher = $this->service->update($id, TeacherDTO::fromArray($request->validated()));

        return response()->json(new TeacherResource($teacher));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
