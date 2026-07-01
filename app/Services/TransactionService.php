<?php

namespace App\Services;

use App\DTOs\TransactionDTO;
use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionService
{
    public function __construct(
        protected TransactionRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Transaction
    {
        return $this->repository->find($id, $relations);
    }

    public function create(TransactionDTO $dto): Transaction
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, TransactionDTO $dto): Transaction
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function findByField(string $field, mixed $value, array $relations = []): Collection
    {
        return $this->repository->findByField($field, $value, $relations);
    }
}
