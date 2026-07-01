<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\DigitalContentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreDigitalContentRequest;
use App\Http\Requests\Api\V1\UpdateDigitalContentRequest;
use App\Http\Resources\Api\V1\DigitalContentResource;
use App\Services\DigitalContentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DigitalContentController extends Controller
{
    public function __construct(
        protected DigitalContentService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return DigitalContentResource::collection(
            $this->service->paginate($perPage, ['class', 'subject']),
        );
    }

    public function show(int $id): JsonResource
    {
        $content = $this->service->find($id, ['class', 'subject']);
        abort_if(! $content, 404);

        return new DigitalContentResource($content);
    }

    public function store(StoreDigitalContentRequest $request): JsonResource
    {
        $dto = DigitalContentDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new DigitalContentResource($this->service->create($dto));
    }

    public function update(UpdateDigitalContentRequest $request, int $id): JsonResource
    {
        $content = $this->service->find($id);
        abort_if(! $content, 404);
        $dto = DigitalContentDTO::fromArray($request->validated());

        return new DigitalContentResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $content = $this->service->find($id);
        abort_if(! $content, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
