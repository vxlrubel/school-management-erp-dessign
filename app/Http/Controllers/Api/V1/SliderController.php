<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SliderDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSliderRequest;
use App\Http\Requests\Api\V1\UpdateSliderRequest;
use App\Http\Resources\Api\V1\SliderResource;
use App\Services\SliderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function __construct(
        protected SliderService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $sliders = $this->service->paginate($perPage);

        return response()->json([
            'data' => SliderResource::collection($sliders),
            'meta' => [
                'per_page' => $sliders->perPage(),
                'total' => $sliders->total(),
            ],
        ]);
    }

    public function store(StoreSliderRequest $request): JsonResponse
    {
        $dto = SliderDTO::fromArray($request->validated());
        $slider = $this->service->create($dto);

        return response()->json([
            'data' => new SliderResource($slider),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $slider = $this->service->find($id);

        if (! $slider) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new SliderResource($slider),
        ]);
    }

    public function update(UpdateSliderRequest $request, int $id): JsonResponse
    {
        $dto = SliderDTO::fromArray($request->validated());
        $slider = $this->service->update($id, $dto);

        return response()->json([
            'data' => new SliderResource($slider),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
