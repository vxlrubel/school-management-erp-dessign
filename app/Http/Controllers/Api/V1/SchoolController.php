<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SchoolDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\School\StoreSchoolRequest;
use App\Http\Requests\Api\V1\School\UpdateSchoolRequest;
use App\Http\Resources\Api\V1\SchoolResource;
use App\Models\School;
use App\Services\SchoolService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function __construct(
        protected SchoolService $schoolService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $schools = $this->schoolService->paginate(
            perPage: (int) $request->get('per_page', 15),
            relations: ['settings']
        );

        return SchoolResource::collection($schools)->response();
    }

    public function store(StoreSchoolRequest $request): JsonResponse
    {
        $school = $this->schoolService->create(
            SchoolDTO::fromArray($request->validated())
        );

        return SchoolResource::make($school)->response()->setStatusCode(201);
    }

    public function show(School $school): JsonResponse
    {
        $school->load('settings');

        return SchoolResource::make($school)->response();
    }

    public function update(UpdateSchoolRequest $request, School $school): JsonResponse
    {
        $school = $this->schoolService->update(
            $school->id,
            SchoolDTO::fromArray($request->validated())
        );

        return SchoolResource::make($school)->response();
    }

    public function destroy(School $school): JsonResponse
    {
        $this->schoolService->delete($school->id);

        return response()->json(['message' => 'School deleted successfully']);
    }
}
