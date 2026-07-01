<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\GalleryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreGalleryRequest;
use App\Http\Requests\Api\V1\UpdateGalleryRequest;
use App\Http\Resources\Api\V1\GalleryResource;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct(
        protected GalleryService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $galleries = $this->service->paginate($perPage);

        return response()->json([
            'data' => GalleryResource::collection($galleries),
            'meta' => [
                'per_page' => $galleries->perPage(),
                'total' => $galleries->total(),
            ],
        ]);
    }

    public function store(StoreGalleryRequest $request): JsonResponse
    {
        $dto = GalleryDTO::fromArray($request->validated());
        $gallery = $this->service->create($dto);

        return response()->json([
            'data' => new GalleryResource($gallery),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $gallery = $this->service->find($id);

        if (! $gallery) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new GalleryResource($gallery),
        ]);
    }

    public function update(UpdateGalleryRequest $request, int $id): JsonResponse
    {
        $dto = GalleryDTO::fromArray($request->validated());
        $gallery = $this->service->update($id, $dto);

        return response()->json([
            'data' => new GalleryResource($gallery),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
