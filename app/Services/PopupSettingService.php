<?php

namespace App\Services;

use App\DTOs\PopupSettingDTO;
use App\Models\PopupSetting;
use App\Repositories\PopupSettingRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PopupSettingService
{
    public function __construct(
        protected PopupSettingRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?PopupSetting
    {
        return $this->repository->find($id, $relations);
    }

    public function create(PopupSettingDTO $dto): PopupSetting
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, PopupSettingDTO $dto): PopupSetting
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
