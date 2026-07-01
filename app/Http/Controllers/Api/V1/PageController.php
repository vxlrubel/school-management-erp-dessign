<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\PageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StorePageRequest;
use App\Http\Requests\Api\V1\UpdatePageRequest;
use App\Http\Resources\Api\V1\PageResource;
use App\Services\PageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        protected PageService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 15);
        $pages = $this->service->paginate($perPage);

        return response()->json([
            'data' => PageResource::collection($pages),
            'meta' => [
                'per_page' => $pages->perPage(),
                'total' => $pages->total(),
            ],
        ]);
    }

    public function store(StorePageRequest $request): JsonResponse
    {
        $dto = PageDTO::fromArray($request->validated());
        $page = $this->service->create($dto);

        return response()->json([
            'data' => new PageResource($page),
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $page = $this->service->find($id);

        if (! $page) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json([
            'data' => new PageResource($page),
        ]);
    }

    public function update(UpdatePageRequest $request, int $id): JsonResponse
    {
        $dto = PageDTO::fromArray($request->validated());
        $page = $this->service->update($id, $dto);

        return response()->json([
            'data' => new PageResource($page),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
