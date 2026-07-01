<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SessionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSessionRequest;
use App\Http\Requests\Api\V1\UpdateSessionRequest;
use App\Http\Resources\Api\V1\SessionResource;
use App\Services\SessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct(
        protected SessionService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $sessions = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page)
            : $this->service->all();

        return response()->json(SessionResource::collection($sessions));
    }

    public function store(StoreSessionRequest $request): JsonResponse
    {
        $session = $this->service->create(SessionDTO::fromArray($request->validated()));

        return response()->json(new SessionResource($session), 201);
    }

    public function show(int $id): JsonResponse
    {
        $session = $this->service->find($id);

        if (! $session) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new SessionResource($session));
    }

    public function update(UpdateSessionRequest $request, int $id): JsonResponse
    {
        $session = $this->service->update($id, SessionDTO::fromArray($request->validated()));

        return response()->json(new SessionResource($session));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
