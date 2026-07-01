<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AlumniDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAlumniRequest;
use App\Http\Requests\Api\V1\UpdateAlumniRequest;
use App\Http\Resources\Api\V1\AlumniResource;
use App\Services\AlumniService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniController extends Controller
{
    public function __construct(
        protected AlumniService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return AlumniResource::collection(
            $this->service->paginate($perPage, ['student']),
        );
    }

    public function show(int $id): JsonResource
    {
        $alumni = $this->service->find($id, ['student']);
        abort_if(! $alumni, 404);

        return new AlumniResource($alumni);
    }

    public function store(StoreAlumniRequest $request): JsonResource
    {
        $dto = AlumniDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new AlumniResource($this->service->create($dto));
    }

    public function update(UpdateAlumniRequest $request, int $id): JsonResource
    {
        $alumni = $this->service->find($id);
        abort_if(! $alumni, 404);
        $dto = AlumniDTO::fromArray($request->validated());

        return new AlumniResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $alumni = $this->service->find($id);
        abort_if(! $alumni, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
