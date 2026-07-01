<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\DTOs\UserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\StoreUserRequest;
use App\Http\Requests\Api\V1\User\UpdateUserRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {}

    public function index(Request $request): JsonResponse
    {
        $users = User::bySchool()
            ->with(['school', 'roles'])
            ->latest()
            ->paginate((int) $request->get('per_page', 15));

        return UserResource::collection($users)->response();
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['school_id'] ??= $request->user()->school_id;

        $user = $this->userService->create(
            UserDTO::fromArray($data)
        );

        if (! empty($data['roles'])) {
            $user->roles()->sync($data['roles']);
        }

        $user->load(['school', 'roles']);

        return UserResource::make($user)->response()->setStatusCode(201);
    }

    public function show(User $user): JsonResponse
    {
        $user->load(['school', 'roles.permissions']);

        return UserResource::make($user)->response();
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $this->userService->update(
            $user->id,
            UserDTO::fromArray($data)
        );

        if (array_key_exists('roles', $data)) {
            $user->roles()->sync($data['roles'] ?? []);
        }

        $user->load(['school', 'roles']);

        return UserResource::make($user)->response();
    }

    public function destroy(User $user): JsonResponse
    {
        $this->userService->delete($user->id);

        return response()->json(['message' => 'User deleted successfully']);
    }
}
