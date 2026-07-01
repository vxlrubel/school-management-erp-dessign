<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\NoticeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreNoticeRequest;
use App\Http\Requests\Api\V1\UpdateNoticeRequest;
use App\Http\Resources\Api\V1\NoticeResource;
use App\Services\NoticeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function __construct(
        protected NoticeService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $notices = $this->service->paginate($perPage);

        return response()->json([
            'data' => NoticeResource::collection($notices),
            'meta' => [
                'per_page' => $notices->perPage(),
                'total' => $notices->total(),
            ],
        ]);
    }

    public function store(StoreNoticeRequest $request): JsonResponse
    {
        $dto = NoticeDTO::fromArray($request->validated());
        $notice = $this->service->create($dto);

        return response()->json([
            'data' => new NoticeResource($notice),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $notice = $this->service->find($id);

        if (! $notice) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new NoticeResource($notice),
        ]);
    }

    public function update(UpdateNoticeRequest $request, int $id): JsonResponse
    {
        $dto = NoticeDTO::fromArray($request->validated());
        $notice = $this->service->update($id, $dto);

        return response()->json([
            'data' => new NoticeResource($notice),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
