<?php

namespace App\Services;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Support\Collection;
use App\Repositories\Interfaces\PaymentRepositoryInterface;

class PaymentService {
 public function __construct(
        private PaymentRepositoryInterface $paymentRepository
    ) {}

    public function create(array $data): Payment
    {
        // Validate student exists
        $this->validateStudentExists($data['student_id']);


        // if (!empty($data['course_id'])) {
        //     $this->validateCourseExists($data['course_id']);
        // }

          $departmentId = null;

    if (!empty($data['course_id'])) {
        $this->validateCourseExists($data['course_id']);
        $course = \App\Models\Course::find($data['course_id']);
        $departmentId = $course->dep_id ?? null;
    }
    if (!$departmentId) {
        // fallback: user's own department
        $departmentId = $data['department_id']
            ?? (auth()->user()?->department_id ?? null);
    }

    $data['department_id'] = $departmentId;


        // Set default category
        if (!isset($data['payment_category'])) {
            $data['payment_category'] = 'course';
        }
            $data['payment_category'] = $data['payment_category'] ?? 'course';
    $data['entered_by']       = $data['entered_by'] ?? auth()->id();

        // Add department_id if not provided
        if (!isset($data['department_id']) && auth()->user()) {
            $data['department_id'] = auth()->user()->department_id;
        }

        return $this->paymentRepository->createPayment($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->paymentRepository->updatePayment($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->paymentRepository->deletePayment($id);
    }

    public function getStudentPayments(int $studentId): Collection
    {
        return $this->paymentRepository->getPaymentsByStudent($studentId);
    }

    public function getStudentCoursePayments(int $studentId, int $courseId): Collection
    {
        return $this->paymentRepository->getPaymentsByStudentAndCourse($studentId, $courseId);
    }

    /**
     * Get remaining balance for a student in a specific course
     */
   public function getRemainingBalance(int $studentId, int $courseId): float
{
    $course = Course::findOrFail($courseId);

    $totalPaid     = $this->paymentRepository
        ->getTotalPaymentsByStudentAndCourse($studentId, $courseId);

    $totalDiscount = $this->paymentRepository
        ->getTotalDiscountsByStudentAndCourse($studentId, $courseId);

    $remaining = $course->price - $totalPaid - $totalDiscount;

    return max(0, $remaining);
}

    /**
     * Get total paid by student for a specific course
     */
    public function getTotalPaid(int $studentId, int $courseId): float
    {
          $paid     = $this->paymentRepository->getTotalPaymentsByStudentAndCourse($studentId, $courseId);
    $discount = $this->paymentRepository->getTotalDiscountsByStudentAndCourse($studentId, $courseId);

    return (float) ($paid + $discount);
    }

    /**
     * Check if student has fully paid for a course
     */
    public function isFullyPaid(int $studentId, int $courseId): bool
    {
        $remaining = $this->getRemainingBalance($studentId, $courseId);
        return $remaining <= 0;
    }

    /**
     * Get payment summary for a student
     */
    public function getStudentPaymentSummary(int $studentId): array
    {
        $payments = $this->getStudentPayments($studentId);

        return [
            'total_payments' => $payments->count(),
            'total_amount' => $payments->sum('payment_value'),
            'by_type' => $payments->groupBy('payment_type')->map->sum('payment_value'),
            'by_course' => $payments->groupBy('course_id')->map(function ($items) {
                return [
                    'course_name' => $items->first()->course->subject_name ?? 'Unknown',
                    'total' => $items->sum('payment_value')
                ];
            }),
            'latest_payment' => $payments->first()
        ];
    }

    private function validateStudentExists(int $studentId): void
    {
        if (!Student::where('id', $studentId)->exists()) {
            throw new \Exception('Student not found with ID: ' . $studentId);
        }
    }

    private function validateCourseExists(int $courseId): void
    {
        if (!Course::where('id', $courseId)->exists()) {
            throw new \Exception('Course not found with ID: ' . $courseId);
        }
    }

/**
 * Bulk surrender pending payments.
 */
public function surrender(array $paymentIds, int $userId): int
{
    if (empty($paymentIds)) {
        return 0;
    }

    return $this->paymentRepository->surrenderPayments($paymentIds, $userId);
}

public function getTotalPending(?int $departmentId = null): float
{
    return $this->paymentRepository->getTotalPending($departmentId);
}
}
