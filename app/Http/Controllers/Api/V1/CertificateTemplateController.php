<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\CertificateTemplateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCertificateTemplateRequest;
use App\Http\Requests\Api\V1\UpdateCertificateTemplateRequest;
use App\Http\Resources\Api\V1\CertificateTemplateResource;
use App\Services\CertificateTemplateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateTemplateController extends Controller
{
    public function __construct(
        protected CertificateTemplateService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return CertificateTemplateResource::collection(
            $this->service->paginate($perPage),
        );
    }

    public function show(int $id): JsonResource
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);

        return new CertificateTemplateResource($template);
    }

    public function store(StoreCertificateTemplateRequest $request): JsonResource
    {
        $dto = CertificateTemplateDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new CertificateTemplateResource($this->service->create($dto));
    }

    public function update(UpdateCertificateTemplateRequest $request, int $id): JsonResource
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);
        $dto = CertificateTemplateDTO::fromArray($request->validated());

        return new CertificateTemplateResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $template = $this->service->find($id);
        abort_if(! $template, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
