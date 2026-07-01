<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\VaccineDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreVaccineRequest;
use App\Http\Requests\Api\V1\UpdateVaccineRequest;
use App\Http\Resources\Api\V1\VaccineResource;
use App\Services\VaccineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VaccineController extends Controller
{
    public function __construct(
        protected VaccineService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return VaccineResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $vaccine = $this->service->find($id);
        abort_if(! $vaccine, 404);

        return new VaccineResource($vaccine);
    }

    public function store(StoreVaccineRequest $request): JsonResource
    {
        $dto = VaccineDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new VaccineResource($this->service->create($dto));
    }

    public function update(UpdateVaccineRequest $request, int $id): JsonResource
    {
        $vaccine = $this->service->find($id);
        abort_if(! $vaccine, 404);
        $dto = VaccineDTO::fromArray($request->validated());

        return new VaccineResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $vaccine = $this->service->find($id);
        abort_if(! $vaccine, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
