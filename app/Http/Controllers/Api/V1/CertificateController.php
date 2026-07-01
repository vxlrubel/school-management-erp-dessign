<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\CertificateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreCertificateRequest;
use App\Http\Requests\Api\V1\UpdateCertificateRequest;
use App\Http\Resources\Api\V1\CertificateResource;
use App\Services\CertificateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateController extends Controller
{
    public function __construct(
        protected CertificateService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return CertificateResource::collection(
            $this->service->paginate($perPage, ['student', 'template']),
        );
    }

    public function show(int $id): JsonResource
    {
        $certificate = $this->service->find($id, ['student', 'template']);
        abort_if(! $certificate, 404);

        return new CertificateResource($certificate);
    }

    public function store(StoreCertificateRequest $request): JsonResource
    {
        $dto = CertificateDTO::fromArray([
            ...$request->validated(),
            'school_id' => $request->user()->school_id,
        ]);

        return new CertificateResource($this->service->create($dto));
    }

    public function update(UpdateCertificateRequest $request, int $id): JsonResource
    {
        $certificate = $this->service->find($id);
        abort_if(! $certificate, 404);
        $dto = CertificateDTO::fromArray($request->validated());

        return new CertificateResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $certificate = $this->service->find($id);
        abort_if(! $certificate, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
