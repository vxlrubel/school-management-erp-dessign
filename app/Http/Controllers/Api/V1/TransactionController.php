<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\TransactionDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTransactionRequest;
use App\Http\Requests\Api\V1\UpdateTransactionRequest;
use App\Http\Resources\Api\V1\TransactionResource;
use App\Services\TransactionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected TransactionService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $transactions = $this->service->paginate(
            $request->integer('per_page', 15),
        );

        return response()->json($transactions);
    }

    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $dto = new TransactionDTO(
            school_id: $request->user()->school_id,
            invoice: $request->input('invoice'),
            amount: $request->input('amount'),
            payment_method: $request->input('payment_method'),
            status: $request->input('status'),
        );

        $transaction = $this->service->create($dto);

        return response()->json(
            new TransactionResource($transaction),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $transaction = $this->service->find($id);

        if (! $transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new TransactionResource($transaction));
    }

    public function update(UpdateTransactionRequest $request, int $id): JsonResponse
    {
        $transaction = $this->service->find($id);

        if (! $transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new TransactionDTO(
            school_id: $transaction->school_id,
            invoice: $request->input('invoice', $transaction->invoice),
            amount: $request->input('amount', $transaction->amount),
            payment_method: $request->input('payment_method', $transaction->payment_method),
            status: $request->input('status', $transaction->status),
        );

        $transaction = $this->service->update($id, $dto);

        return response()->json(new TransactionResource($transaction));
    }

    public function destroy(int $id): JsonResponse
    {
        $transaction = $this->service->find($id);

        if (! $transaction) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
