<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
    public function all(array $relations = []): Collection;

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator;

    public function find(int $id, array $relations = []): ?Model;

    public function create(array $data): Model;

    public function update(int $id, array $data): Model;

    public function delete(int $id): bool;

    public function findByField(string $field, mixed $value, array $relations = []): Collection;
}
