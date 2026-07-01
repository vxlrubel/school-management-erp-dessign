<?php

namespace App\Services;

use App\DTOs\SliderDTO;
use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SliderService
{
    public function __construct(
        protected SliderRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Slider
    {
        return $this->repository->find($id, $relations);
    }

    public function create(SliderDTO $dto): Slider
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, SliderDTO $dto): Slider
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
