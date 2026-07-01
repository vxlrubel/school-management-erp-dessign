<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\OnlineClassDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreOnlineClassRequest;
use App\Http\Requests\Api\V1\UpdateOnlineClassRequest;
use App\Http\Resources\Api\V1\OnlineClassResource;
use App\Services\OnlineClassService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OnlineClassController extends Controller
{
    public function __construct(
        protected OnlineClassService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return OnlineClassResource::collection(
            $this->service->paginate($perPage, ['teacher']),
        );
    }

    public function show(int $id): JsonResource
    {
        $onlineClass = $this->service->find($id, ['teacher']);
        abort_if(! $onlineClass, 404);

        return new OnlineClassResource($onlineClass);
    }

    public function store(StoreOnlineClassRequest $request): JsonResource
    {
        $dto = OnlineClassDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new OnlineClassResource($this->service->create($dto));
    }

    public function update(UpdateOnlineClassRequest $request, int $id): JsonResource
    {
        $onlineClass = $this->service->find($id);
        abort_if(! $onlineClass, 404);
        $dto = OnlineClassDTO::fromArray($request->validated());

        return new OnlineClassResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $onlineClass = $this->service->find($id);
        abort_if(! $onlineClass, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
