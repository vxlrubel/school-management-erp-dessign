<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\ActivityLogDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreActivityLogRequest;
use App\Http\Requests\Api\V1\UpdateActivityLogRequest;
use App\Http\Resources\Api\V1\ActivityLogResource;
use App\Services\ActivityLogService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityLogController extends Controller
{
    public function __construct(
        protected ActivityLogService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return ActivityLogResource::collection(
            $this->service->paginate($perPage, ['user']),
        );
    }

    public function show(int $id): JsonResource
    {
        $log = $this->service->find($id, ['user']);
        abort_if(! $log, 404);

        return new ActivityLogResource($log);
    }

    public function store(StoreActivityLogRequest $request): JsonResource
    {
        $dto = ActivityLogDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new ActivityLogResource($this->service->create($dto));
    }

    public function update(UpdateActivityLogRequest $request, int $id): JsonResource
    {
        $log = $this->service->find($id);
        abort_if(! $log, 404);
        $dto = ActivityLogDTO::fromArray($request->validated());

        return new ActivityLogResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $log = $this->service->find($id);
        abort_if(! $log, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
