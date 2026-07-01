<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\MediaDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreMediaRequest;
use App\Http\Requests\Api\V1\UpdateMediaRequest;
use App\Http\Resources\Api\V1\MediaResource;
use App\Services\MediaService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MediaController extends Controller
{
    public function __construct(
        protected MediaService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return MediaResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $media = $this->service->find($id);
        abort_if(! $media, 404);

        return new MediaResource($media);
    }

    public function store(StoreMediaRequest $request): JsonResource
    {
        $dto = MediaDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new MediaResource($this->service->create($dto));
    }

    public function update(UpdateMediaRequest $request, int $id): JsonResource
    {
        $media = $this->service->find($id);
        abort_if(! $media, 404);
        $dto = MediaDTO::fromArray($request->validated());

        return new MediaResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $media = $this->service->find($id);
        abort_if(! $media, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
