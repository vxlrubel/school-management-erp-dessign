<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentVaccineDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentVaccineRequest;
use App\Http\Requests\Api\V1\UpdateStudentVaccineRequest;
use App\Http\Resources\Api\V1\StudentVaccineResource;
use App\Services\StudentVaccineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentVaccineController extends Controller
{
    public function __construct(
        protected StudentVaccineService $service,
    ) {}

    public function index(Request $request): JsonResource
    {
        $perPage = $request->integer('per_page', 15);

        return StudentVaccineResource::collection(
            $this->service->paginate($perPage, ['student', 'vaccine']),
        );
    }

    public function show(int $id): JsonResource
    {
        $studentVaccine = $this->service->find($id, ['student', 'vaccine']);
        abort_if(! $studentVaccine, 404);

        return new StudentVaccineResource($studentVaccine);
    }

    public function store(StoreStudentVaccineRequest $request): JsonResource
    {
        $dto = StudentVaccineDTO::fromArray($request->validated());

        return new StudentVaccineResource($this->service->create($dto));
    }

    public function update(UpdateStudentVaccineRequest $request, int $id): JsonResource
    {
        $studentVaccine = $this->service->find($id);
        abort_if(! $studentVaccine, 404);
        $dto = StudentVaccineDTO::fromArray($request->validated());

        return new StudentVaccineResource($this->service->update($id, $dto));
    }

    public function destroy(int $id): JsonResponse
    {
        $studentVaccine = $this->service->find($id);
        abort_if(! $studentVaccine, 404);
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully.']);
    }
}
