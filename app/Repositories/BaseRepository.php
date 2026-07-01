<?php

namespace App\Repositories;

use App\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    abstract protected function resolveModel(): Model;

    public function all(array $relations = []): Collection
    {
        return $this->model->with($relations)->latest()->get();
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->model->with($relations)->latest()->paginate($perPage);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Model
    {
        $record = $this->find($id);

        if (! $record) {
            throw new ModelNotFoundException;
        }

        $record->update($data);

        return $record->fresh();
    }

    public function delete(int $id): bool
    {
        $record = $this->find($id);

        if (! $record) {
            throw new ModelNotFoundException;
        }

        return $record->delete();
    }

    public function findByField(string $field, mixed $value, array $relations = []): Collection
    {
        return $this->model->with($relations)->where($field, $value)->latest()->get();
    }
}
