<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\PopupSettingDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePopupSettingRequest;
use App\Http\Requests\Api\V1\UpdatePopupSettingRequest;
use App\Http\Resources\Api\V1\PopupSettingResource;
use App\Services\PopupSettingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PopupSettingController extends Controller
{
    public function __construct(
        protected PopupSettingService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $popupSettings = $this->service->paginate($perPage);

        return response()->json([
            'data' => PopupSettingResource::collection($popupSettings),
            'meta' => [
                'per_page' => $popupSettings->perPage(),
                'total' => $popupSettings->total(),
            ],
        ]);
    }

    public function store(StorePopupSettingRequest $request): JsonResponse
    {
        $dto = PopupSettingDTO::fromArray($request->validated());
        $popupSetting = $this->service->create($dto);

        return response()->json([
            'data' => new PopupSettingResource($popupSetting),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $popupSetting = $this->service->find($id);

        if (! $popupSetting) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new PopupSettingResource($popupSetting),
        ]);
    }

    public function update(UpdatePopupSettingRequest $request, int $id): JsonResponse
    {
        $dto = PopupSettingDTO::fromArray($request->validated());
        $popupSetting = $this->service->update($id, $dto);

        return response()->json([
            'data' => new PopupSettingResource($popupSetting),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
