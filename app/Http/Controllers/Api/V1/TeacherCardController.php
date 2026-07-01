<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TeacherCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTeacherCardRequest;
use App\Http\Requests\Api\V1\UpdateTeacherCardRequest;
use App\Http\Resources\Api\V1\TeacherCardResource;
use App\Services\TeacherCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherCardController extends Controller
{
    public function __construct(
        protected TeacherCardService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return TeacherCardResource::collection(
            $this->service->paginate($perPage, ['teacher', 'template']),
        );
    }

    public function show(int $id): JsonResource
    {
        $card = $this->service->find($id, ['teacher', 'template']);
        abort_if(! $card, 404);

        return new TeacherCardResource($card);
    }

    public function store(StoreTeacherCardRequest $request): JsonResource
    {
        $dto = TeacherCardDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new TeacherCardResource($this->service->create($dto));
    }

    public function update(UpdateTeacherCardRequest $request, int $id): JsonResource
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $dto = TeacherCardDTO::fromArray($request->validated());

        return new TeacherCardResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
