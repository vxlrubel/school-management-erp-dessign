<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentGuardianDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentGuardianRequest;
use App\Http\Requests\Api\V1\UpdateStudentGuardianRequest;
use App\Http\Resources\Api\V1\StudentGuardianResource;
use App\Services\StudentGuardianService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentGuardianController extends Controller
{
    public function __construct(
        protected StudentGuardianService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $guardians = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page)
            : $this->service->all();

        return response()->json(StudentGuardianResource::collection($guardians));
    }

    public function store(StoreStudentGuardianRequest $request): JsonResponse
    {
        $guardian = $this->service->create(StudentGuardianDTO::fromArray($request->validated()));

        return response()->json(new StudentGuardianResource($guardian), 201);
    }

    public function show(int $id): JsonResponse
    {
        $guardian = $this->service->find($id);

        if (! $guardian) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new StudentGuardianResource($guardian));
    }

    public function update(UpdateStudentGuardianRequest $request, int $id): JsonResponse
    {
        $guardian = $this->service->update($id, StudentGuardianDTO::fromArray($request->validated()));

        return response()->json(new StudentGuardianResource($guardian));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
