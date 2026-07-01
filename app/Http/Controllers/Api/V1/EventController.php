<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\EventDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreEventRequest;
use App\Http\Requests\Api\V1\UpdateEventRequest;
use App\Http\Resources\Api\V1\EventResource;
use App\Services\EventService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function __construct(
        protected EventService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $events = $this->service->paginate($perPage);

        return response()->json([
            'data' => EventResource::collection($events),
            'meta' => [
                'per_page' => $events->perPage(),
                'total' => $events->total(),
            ],
        ]);
    }

    public function store(StoreEventRequest $request): JsonResponse
    {
        $dto = EventDTO::fromArray($request->validated());
        $event = $this->service->create($dto);

        return response()->json([
            'data' => new EventResource($event),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $event = $this->service->find($id);

        if (! $event) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new EventResource($event),
        ]);
    }

    public function update(UpdateEventRequest $request, int $id): JsonResponse
    {
        $dto = EventDTO::fromArray($request->validated());
        $event = $this->service->update($id, $dto);

        return response()->json([
            'data' => new EventResource($event),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
