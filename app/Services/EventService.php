<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Models\Event;
use App\Repositories\EventRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EventService
{
    public function __construct(
        protected EventRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Event
    {
        return $this->repository->find($id, $relations);
    }

    public function create(EventDTO $dto): Event
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, EventDTO $dto): Event
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
