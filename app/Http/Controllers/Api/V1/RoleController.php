<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTOs\RoleDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Role\StoreRoleRequest;
use App\Http\Requests\Api\V1\Role\UpdateRoleRequest;
use App\Http\Resources\Api\V1\RoleResource;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(
        protected RoleService $roleService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $roles = $this->roleService->paginate(
            perPage: (int) $request->get('per_page', 15),
            relations: ['permissions']
        );

        return RoleResource::collection($roles)->response();
    }

    public function store(StoreRoleRequest $request): JsonResponse
    {
        $data = $request->validated();

        $role = $this->roleService->create(
            RoleDTO::fromArray([
                ...$data,
                'school_id' => $request->user()->school_id,
            ])
        );

        if (! empty($data['permissions'])) {
            $role->permissions()->sync($data['permissions']);
        }

        $role->load('permissions');

        return RoleResource::make($role)->response()->setStatusCode(201);
    }

    public function show(Role $role): JsonResponse
    {
        $role->load('permissions');

        return RoleResource::make($role)->response();
    }

    public function update(UpdateRoleRequest $request, Role $role): JsonResponse
    {
        $data = $request->validated();

        $role = $this->roleService->update(
            $role->id,
            RoleDTO::fromArray($data)
        );

        if (array_key_exists('permissions', $data)) {
            $role->permissions()->sync($data['permissions'] ?? []);
        }

        $role->load('permissions');

        return RoleResource::make($role)->response();
    }

    public function destroy(Role $role): JsonResponse
    {
        $this->roleService->delete($role->id);

        return response()->json(['message' => 'Role deleted successfully']);
    }
}
