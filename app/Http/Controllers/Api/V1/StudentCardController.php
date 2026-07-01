<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentCardRequest;
use App\Http\Requests\Api\V1\UpdateStudentCardRequest;
use App\Http\Resources\Api\V1\StudentCardResource;
use App\Services\StudentCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentCardController extends Controller
{
    public function __construct(
        protected StudentCardService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return StudentCardResource::collection(
            $this->service->paginate($perPage, ['student', 'template']),
        );
    }

    public function show(int $id): JsonResource
    {
        $card = $this->service->find($id, ['student', 'template']);
        abort_if(! $card, 404);

        return new StudentCardResource($card);
    }

    public function store(StoreStudentCardRequest $request): JsonResource
    {
        $dto = StudentCardDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new StudentCardResource($this->service->create($dto));
    }

    public function update(UpdateStudentCardRequest $request, int $id): JsonResource
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $dto = StudentCardDTO::fromArray($request->validated());

        return new StudentCardResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
