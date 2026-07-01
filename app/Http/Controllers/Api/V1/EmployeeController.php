<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreEmployeeRequest;
use App\Http\Requests\Api\V1\UpdateEmployeeRequest;
use App\Http\Resources\Api\V1\EmployeeResource;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct(
        protected EmployeeService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $employees = $request->has('per_page')
            ? $this->service->paginate((int) $request->per_page)
            : $this->service->all();

        return response()->json(EmployeeResource::collection($employees));
    }

    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = $this->service->create(EmployeeDTO::fromArray($request->validated()));

        return response()->json(new EmployeeResource($employee), 201);
    }

    public function show(int $id): JsonResponse
    {
        $employee = $this->service->find($id);

        if (! $employee) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new EmployeeResource($employee));
    }

    public function update(UpdateEmployeeRequest $request, int $id): JsonResponse
    {
        $employee = $this->service->update($id, EmployeeDTO::fromArray($request->validated()));

        return response()->json(new EmployeeResource($employee));
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
