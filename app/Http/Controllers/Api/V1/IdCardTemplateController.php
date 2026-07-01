<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\IdCardTemplateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreIdCardTemplateRequest;
use App\Http\Requests\Api\V1\UpdateIdCardTemplateRequest;
use App\Http\Resources\Api\V1\IdCardTemplateResource;
use App\Services\IdCardTemplateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IdCardTemplateController extends Controller
{
    public function __construct(
        protected IdCardTemplateService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return IdCardTemplateResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);

        return new IdCardTemplateResource($template);
    }

    public function store(StoreIdCardTemplateRequest $request): JsonResource
    {
        $dto = IdCardTemplateDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new IdCardTemplateResource($this->service->create($dto));
    }

    public function update(UpdateIdCardTemplateRequest $request, int $id): JsonResource
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);
        $dto = IdCardTemplateDTO::fromArray($request->validated());

        return new IdCardTemplateResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
