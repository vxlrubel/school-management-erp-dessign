<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SubjectDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSubjectRequest;
use App\Http\Requests\Api\V1\UpdateSubjectRequest;
use App\Http\Resources\Api\V1\SubjectResource;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct(
        protected SubjectService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $subjects = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classrooms'])
            : $this->service->all(['classrooms']);

        return response()->json(SubjectResource::collection($subjects));
    }

    public function store(StoreSubjectRequest $request): JsonResponse
    {
        $subject = $this->service->create(SubjectDTO::fromArray($request->validated()));

        return response()->json(new SubjectResource($subject), 201);
    }

    public function show(int $id): JsonResponse
    {
        $subject = $this->service->find($id, ['classrooms']);

        if (! $subject) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new SubjectResource($subject));
    }

    public function update(UpdateSubjectRequest $request, int $id): JsonResponse
    {
        $subject = $this->service->update($id, SubjectDTO::fromArray($request->validated()));

        return response()->json(new SubjectResource($subject));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
