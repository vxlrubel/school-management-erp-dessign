<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SectionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreSectionRequest;
use App\Http\Requests\Api\V1\UpdateSectionRequest;
use App\Http\Resources\Api\V1\SectionResource;
use App\Services\SectionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __construct(
        protected SectionService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $sections = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page, ['classroom'])
            : $this->service->all(['classroom']);

        return response()->json(SectionResource::collection($sections));
    }

    public function store(StoreSectionRequest $request): JsonResponse
    {
        $section = $this->service->create(SectionDTO::fromArray($request->validated()));

        return response()->json(new SectionResource($section), 201);
    }

    public function show(int $id): JsonResponse
    {
        $section = $this->service->find($id, ['classroom']);

        if (! $section) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new SectionResource($section));
    }

    public function update(UpdateSectionRequest $request, int $id): JsonResponse
    {
        $section = $this->service->update($id, SectionDTO::fromArray($request->validated()));

        return response()->json(new SectionResource($section));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
