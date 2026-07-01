<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\EmployeeCardDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreEmployeeCardRequest;
use App\Http\Requests\Api\V1\UpdateEmployeeCardRequest;
use App\Http\Resources\Api\V1\EmployeeCardResource;
use App\Services\EmployeeCardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeCardController extends Controller
{
    public function __construct(
        protected EmployeeCardService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return EmployeeCardResource::collection(
            $this->service->paginate($perPage, ['employee', 'template']),
        );
    }

    public function show(int $id): JsonResource
    {
        $card = $this->service->find($id, ['employee', 'template']);
        abort_if(! $card, 404);

        return new EmployeeCardResource($card);
    }

    public function store(StoreEmployeeCardRequest $request): JsonResource
    {
        $dto = EmployeeCardDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new EmployeeCardResource($this->service->create($dto));
    }

    public function update(UpdateEmployeeCardRequest $request, int $id): JsonResource
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $dto = EmployeeCardDTO::fromArray($request->validated());

        return new EmployeeCardResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $card = $this->service->find($id);
        abort_if(! $card, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
