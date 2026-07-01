<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTOs\PermissionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Permission\StorePermissionRequest;
use App\Http\Requests\Api\V1\Permission\UpdatePermissionRequest;
use App\Http\Resources\Api\V1\PermissionResource;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionService $permissionService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $permissions = $this->permissionService->paginate(
            perPage: (int) $request->get('per_page', 15)
        );

        return PermissionResource::collection($permissions)->response();
    }

    public function store(StorePermissionRequest $request): JsonResponse
    {
        $permission = $this->permissionService->create(
            PermissionDTO::fromArray($request->validated())
        );

        return PermissionResource::make($permission)->response()->setStatusCode(201);
    }

    public function show(Permission $permission): JsonResponse
    {
        return PermissionResource::make($permission)->response();
    }

    public function update(UpdatePermissionRequest $request, Permission $permission): JsonResponse
    {
        $permission = $this->permissionService->update(
            $permission->id,
            PermissionDTO::fromArray($request->validated())
        );

        return PermissionResource::make($permission)->response();
    }

    public function destroy(Permission $permission): JsonResponse
    {
        $this->permissionService->delete($permission->id);

        return response()->json(['message' => 'Permission deleted successfully']);
    }
}
