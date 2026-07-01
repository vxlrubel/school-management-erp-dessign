<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentRequest;
use App\Http\Requests\Api\V1\UpdateStudentRequest;
use App\Http\Resources\Api\V1\StudentResource;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(
        protected StudentService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $students = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['guardian', 'academic'])
            : $this->service->all(['guardian', 'academic']);

        return response()->json(StudentResource::collection($students));
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $student = $this->service->create(StudentDTO::fromArray($request->validated()));

        return response()->json(new StudentResource($student), 201);
    }

    public function show(int $id): JsonResponse
    {
        $student = $this->service->find($id, ['guardian', 'academic']);

        if (! $student) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new StudentResource($student));
    }

    public function update(UpdateStudentRequest $request, int $id): JsonResponse
    {
        $student = $this->service->update($id, StudentDTO::fromArray($request->validated()));

        return response()->json(new StudentResource($student));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
