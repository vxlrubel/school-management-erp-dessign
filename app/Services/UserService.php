<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService
{
    public function __construct(
        protected UserRepository $userRepository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->userRepository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->userRepository->find($id, $relations);
    }

    public function create(UserDTO $dto): Model
    {
        return $this->userRepository->create($dto->toArray());
    }

    public function update(int $id, UserDTO $dto): Model
    {
        return $this->userRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->userRepository->delete($id);
    }
}
