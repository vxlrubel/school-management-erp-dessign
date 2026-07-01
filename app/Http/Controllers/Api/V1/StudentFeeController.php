<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\StudentFeeDTO;
use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreStudentFeeRequest;
use App\Http\Requests\Api\V1\UpdateStudentFeeRequest;
use App\Http\Resources\Api\V1\StudentFeeResource;
use App\Services\StudentFeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentFeeController extends Controller
{
    public function __construct(
        protected StudentFeeService $service,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $studentFees = $this->service->paginate(
            $request->integer('per_page', 15),
            ['student'],
        );

        return response()->json($studentFees);
    }

    public function store(StoreStudentFeeRequest $request): JsonResponse
    {
        $dto = new StudentFeeDTO(
            student_id: $request->input('student_id'),
            month: $request->input('month'),
            amount: $request->input('amount'),
            discount: $request->input('discount', 0),
            fine: $request->input('fine', 0),
            paid: $request->input('paid', 0),
            status: $request->has('status') ? PaymentStatus::from($request->input('status')) : PaymentStatus::Unpaid,
        );

        $studentFee = $this->service->create($dto);

        return response()->json(
            new StudentFeeResource($studentFee),
            201,
        );
    }

    public function show(int $id): JsonResponse
    {
        $studentFee = $this->service->find($id, ['student']);

        if (! $studentFee) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json(new StudentFeeResource($studentFee));
    }

    public function update(UpdateStudentFeeRequest $request, int $id): JsonResponse
    {
        $studentFee = $this->service->find($id);

        if (! $studentFee) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $dto = new StudentFeeDTO(
            student_id: $request->input('student_id', $studentFee->student_id),
            month: $request->input('month', $studentFee->month),
            amount: $request->input('amount', $studentFee->amount),
            discount: $request->input('discount', $studentFee->discount),
            fine: $request->input('fine', $studentFee->fine),
            paid: $request->input('paid', $studentFee->paid),
            status: $request->has('status') ? PaymentStatus::from($request->input('status')) : PaymentStatus::from($studentFee->status),
        );

        $studentFee = $this->service->update($id, $dto);

        return response()->json(new StudentFeeResource($studentFee));
    }

    public function destroy(int $id): JsonResponse
    {
        $studentFee = $this->service->find($id);

        if (! $studentFee) {
            return response()->json(['message' => 'Not found'], 404);
        }

        $this->service->delete($id);

        return response()->json(['message' => 'Deleted successfully']);
    }
}
