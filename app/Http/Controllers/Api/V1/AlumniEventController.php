<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AlumniEventDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAlumniEventRequest;
use App\Http\Requests\Api\V1\UpdateAlumniEventRequest;
use App\Http\Resources\Api\V1\AlumniEventResource;
use App\Services\AlumniEventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniEventController extends Controller
{
    public function __construct(
        protected AlumniEventService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return AlumniEventResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $event = $this->service->find($id);
        abort_if(! $event, 404);

        return new AlumniEventResource($event);
    }

    public function store(StoreAlumniEventRequest $request): JsonResource
    {
        $dto = AlumniEventDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new AlumniEventResource($this->service->create($dto));
    }

    public function update(UpdateAlumniEventRequest $request, int $id): JsonResource
    {
        $event = $this->service->find($id);
        abort_if(! $event, 404);
        $dto = AlumniEventDTO::fromArray($request->validated());

        return new AlumniEventResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $event = $this->service->find($id);
        abort_if(! $event, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
