<?php

namespace App\Repositories\Interfaces;

interface PaymentRepositoryInterface {
    public function createPayment(array $data);
    public function updatePayment(int $id, array $data);
    public function deletePayment(int $id);
    public function getPaymentsByStudent(int $studentId);
    public function getPaymentsByStudentAndCourse(int $studentId, int $courseId);
    public function getTotalPaymentsByCourse(int $courseId);
    public function getTotalPaymentsByStudentAndCourse(int $studentId, int $courseId);
    public function receiptExists(string $receiptNumber, ?int $excludeId = null): bool;
public function getPendingPayments(array $filters = []): \Illuminate\Support\Collection;
public function surrenderPayments(array $ids, int $userId): int;
public function getTotalPending(?int $departmentId = null): float;
public function getTotalDiscountsByStudentAndCourse(int $studentId, int $courseId): float;
}
