<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\AlumniEventRegistrationDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreAlumniEventRegistrationRequest;
use App\Http\Requests\Api\V1\UpdateAlumniEventRegistrationRequest;
use App\Http\Resources\Api\V1\AlumniEventRegistrationResource;
use App\Services\AlumniEventRegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlumniEventRegistrationController extends Controller
{
    public function __construct(
        protected AlumniEventRegistrationService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return AlumniEventRegistrationResource::collection(
            $this->service->paginate($perPage, ['event', 'alumni']),
        );
    }

    public function show(int $id): JsonResource
    {
        $registration = $this->service->find($id, ['event', 'alumni']);
        abort_if(! $registration, 404);

        return new AlumniEventRegistrationResource($registration);
    }

    public function store(StoreAlumniEventRegistrationRequest $request): JsonResource
    {
        $dto = AlumniEventRegistrationDTO::fromArray($request->validated());

        return new AlumniEventRegistrationResource($this->service->create($dto));
    }

    public function update(UpdateAlumniEventRegistrationRequest $request, int $id): JsonResource
    {
        $registration = $this->service->find($id);
        abort_if(! $registration, 404);
        $dto = AlumniEventRegistrationDTO::fromArray($request->validated());

        return new AlumniEventRegistrationResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $registration = $this->service->find($id);
        abort_if(! $registration, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
