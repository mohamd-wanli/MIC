<?php

namespace App\Repositories\Eloquent;;
use App\Models\Payment;
use App\Repositories\Interfaces\PaymentRepositoryInterface as InterfacesPaymentRepositoryInterface;
use Illuminate\Support\Collection;
use PaymentRepositoryInterface;

class PaymentRepository implements InterfacesPaymentRepositoryInterface {


    protected $model;

    public function __construct(Payment $payment)
    {
        $this->model = $payment;
    }

    public function createPayment(array $data): Payment
    {
        return $this->model->create($data);
    }

    public function updatePayment(int $id, array $data): bool
    {
        $payment = $this->model->findOrFail($id);
        return $payment->update($data);
    }

    public function deletePayment(int $id): bool
    {
        $payment = $this->model->findOrFail($id);
        return $payment->delete();
    }

    public function getPaymentsByStudent(int $studentId): Collection
    {
        return $this->model
            ->where('student_id', $studentId)
            ->with(['course', 'department'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPaymentsByStudentAndCourse(int $studentId, int $courseId): Collection
    {
        return $this->model
            ->where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

       public function getTotalPaymentsByCourse(int $courseId, ?string $category = null): float
    {
        $query = $this->model->where('course_id', $courseId);
        if ($category) {
            $query->where('payment_category', $category);
        }
        return (float) $query->sum('payment_value');
    }

      public function getTotalPaymentsByStudentAndCourse(
        int $studentId,
        int $courseId,
        ?string $category = null
    ): float {
        $query = $this->model
            ->where('student_id', $studentId)
            ->where('course_id', $courseId);

        if ($category) {
            $query->where('payment_category', $category);
        }

        return (float) $query->sum('payment_value');
    }
     public function getOtherPaymentsByStudent(int $studentId): Collection
    {
        return $this->model
            ->where('student_id', $studentId)
            ->where('payment_category', '!=', 'course')
            ->with(['course', 'department'])
            ->orderBy('created_at', 'desc')
            ->get();
    }


    public function receiptExists(string $receiptNumber, ?int $excludeId = null): bool
{
    $query = $this->model->where('receipt_number', $receiptNumber);

    if ($excludeId) {
        $query->where('id', '!=', $excludeId);
    }

    return $query->exists();
}

public function getPendingPayments(array $filters = []):collection
{
    $query = $this->model->pending()->with(['student', 'course', 'department', 'enteredBy']);

    if (!empty($filters['department_id'])) {
        $query->where('department_id', $filters['department_id']);
    }

    if (!empty($filters['receipt_from']) && !empty($filters['receipt_to'])) {
        $query->whereBetween('receipt_number', [
            $filters['receipt_from'],
            $filters['receipt_to'],
        ]);
    }

    return $query->orderBy('receipt_number')->get();
}

public function surrenderPayments(array $ids, int $userId): int
{
    return $this->model
        ->whereIn('id', $ids)
        ->whereNull('surrendered_at')  // never re-surrender
        ->update([
            'surrendered_at' => now(),
            'surrendered_to' => $userId,
        ]);
}

public function getTotalPending(?int $departmentId = null): float
{
    $query = $this->model->pending();

    if ($departmentId) {
        $query->where('department_id', $departmentId);
    }

    return (float) $query->sum('payment_value');
}

public function getTotalDiscountsByStudentAndCourse(int $studentId, int $courseId): float
{
    return (float) $this->model
        ->where('student_id', $studentId)
        ->where('course_id', $courseId)
        ->sum('discount');
}
}
