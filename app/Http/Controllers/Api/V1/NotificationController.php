<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\NotificationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreNotificationRequest;
use App\Http\Requests\Api\V1\UpdateNotificationRequest;
use App\Http\Resources\Api\V1\NotificationResource;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationController extends Controller
{
    public function __construct(
        protected NotificationService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return NotificationResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $notification = $this->service->find($id);
        abort_if(! $notification, 404);

        return new NotificationResource($notification);
    }

    public function store(StoreNotificationRequest $request): JsonResource
    {
        $dto = NotificationDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new NotificationResource($this->service->create($dto));
    }

    public function update(UpdateNotificationRequest $request, int $id): JsonResource
    {
        $notification = $this->service->find($id);
        abort_if(! $notification, 404);
        $dto = NotificationDTO::fromArray($request->validated());

        return new NotificationResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $notification = $this->service->find($id);
        abort_if(! $notification, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
