<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymantRequest;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService) {
        $this->paymentService=$paymentService;
    }

    public function printReceipt($id)
{
    // Load the payment with its relationships
    $payment = Payment::with(['student', 'course', 'department', 'enteredBy'])
        ->findOrFail($id);
    
    return view('payments.print_receipt', compact('payment'));
}


     public function store(PaymantRequest $request)
    {
        try {
            $data = $request->validated();
               $data['entered_by'] = auth()->id();
               $paymentValue = (float) ($data['payment_value'] ?? 0);
$discount     = (float) ($data['discount'] ?? 0);

if ($paymentValue <= 0 && $discount <= 0) {
    return response()->json([
        'success' => false,
        'message' => 'يجب إدخال قيمة دفعة أو حسم واحد على الأقل',
    ], 422);
}

            // // Add department_id if missing
            // if (!isset($data['department_id']) && auth()->user()) {
            //     $data['department_id'] = auth()->user()->department_id;
            // }


            $data['payment_category'] = $request->input('payment_category', 'course');

            $payment = $this->paymentService->create($data);

            // If course_id is provided, get remaining balance; otherwise skip
            $remaining = null;
            if (!empty($data['course_id'])) {
                $remaining = $this->paymentService->getRemainingBalance(
                    $data['student_id'],
                    $data['course_id']
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'تم إضافة الدفعة بنجاح',
                'payment' => $payment,
                'remaining' => $remaining,
                'payment_html' => $this->renderPaymentRow($payment)
            ]);

        } catch (\Exception $e) {
            Log::error('Payment creation error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
  public function deletePayment(int $id)
{
    try {
        $result = $this->paymentService->delete($id);
        return response()->json(['success' => $result]);
    } catch (\Throwable $e) {
        Log::error('Delete payment failed: '.$e->getMessage(), [
            'id' => $id,
            'trace' => $e->getTraceAsString()
        ]);
        return response()->json([
            'success' => false,
            'message' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Get remaining balance for a student/course
     */
    public function getRemaining($studentId, $courseId)
    {
        try {
            $remaining = $this->paymentService->getRemainingBalance($studentId, $courseId);
            return response()->json([
                'success' => true,
                'remaining' => $remaining
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Render a single payment row for AJAX response
     */
    private function renderPaymentRow($payment)
    {
        $paymentCount = 1; // You might want to pass this dynamically
        return view('partials.payment_row', compact('payment', 'paymentCount'))->render();
    }

     public function addNote(Request $request, $id)
    {
        try {
            $request->validate([
                'note' => ['nullable', 'string', 'max:500']
            ]);

            $payment = Payment::findOrFail($id);
            $payment->note = $request->note;
            $payment->save();

            return redirect()->back()->with('success', 'تم إضافة الملاحظة بنجاح!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }
}
