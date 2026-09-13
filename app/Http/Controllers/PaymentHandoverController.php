<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentHandoverController extends Controller
{
    /**
     * Handover page.
     */
    public function index()
    {
        return view('payments.handover');
    }

    /**
     * AJAX: search pending payments by receipt range.
     */
    public function search(Request $request)
    {
        $from = $request->input('receipt_from');
        $to   = $request->input('receipt_to');

        $query = Payment::pending()
            ->with(['student', 'course', 'department', 'enteredBy']);

        
        if (auth()->user()->department_id && !auth()->user()->hasRole('Admin')) {
            $query->where('department_id', auth()->user()->department_id);
        }

        if ($from && $to) {
            $query->whereBetween('receipt_number', [$from, $to]);
        }

        $payments = $query->orderBy('receipt_number')->get();

        return response()->json([
            'success'  => true,
            'payments' => $payments,
            'total'    => $payments->sum('payment_value'),
            'count'    => $payments->count(),
        ]);
    }

    /**
     * Surrender selected payments.
     */
    public function surrender(Request $request)
    {
        $request->validate([
            'payment_ids'   => 'required|array|min:1',
            'payment_ids.*' => 'exists:payments,id',
        ]);

        DB::beginTransaction();
        try {
            $count = Payment::whereIn('id', $request->payment_ids)
                ->whereNull('surrendered_at')
                ->update([
                    'surrendered_at' => now(),
                    'surrendered_to' => auth()->id(),
                ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "تم تسليم {$count} إيصالاً بنجاح",
                'count'   => $count,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء التسليم: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Printable surrender document.
     */
    public function printDocument(Request $request)
    {
        $ids = explode(',', $request->input('ids', ''));

        $payments = Payment::with(['student', 'course'])
            ->whereIn('id', $ids)
            ->orderBy('receipt_number')
            ->get();

        return view('payments.handover_print', compact('payments'));
    }

    /**
     * Cash in hand report (per department).
     */
    public function cashInHand()
    {
        $rows = Payment::pending()
            ->select('department_id',
                DB::raw('COUNT(*) as receipts_count'),
                DB::raw('SUM(payment_value) as total_amount'))
            ->groupBy('department_id')
            ->with('department')
            ->get();

        return view('payments.cash_in_hand', compact('rows'));
    }
      private function scopeQuery($query, ?int $departmentId)
    {
        if (auth()->user()->hasRole('Admin')) {
            if ($departmentId) {
                $query->where('department_id', $departmentId);
            }
        } else {
            $query->where('department_id', auth()->user()->department_id);
        }

        return $query;
    }


     /* ============================================================
     *  1) Collections Report – group by collected_at
     * ============================================================ */
    public function collections(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $query = Payment::with(['student', 'course', 'department', 'enteredBy'])
            ->whereBetween('collected_at', [$from, $to]);

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('collected_at', 'desc')->get();

        // Summary per day
        $daily = $payments->groupBy(function ($p) {
            return $p->collected_at->format('Y-m-d');
        })->map(function ($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum('payment_value'),
            ];
        });

        $departments = Department::all();

        return view('payments.reports.collections',
            compact('payments', 'daily', 'from', 'to', 'departments'));
    }

    /* ============================================================
     *  2) Handovers Report – group by surrendered_at
     * ============================================================ */
    public function handovers(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $query = Payment::with(['student', 'course', 'department', 'surrenderedTo', 'enteredBy'])
            ->whereNotNull('surrendered_at')
            ->whereBetween('surrendered_at', [
                $from . ' 00:00:00',
                $to   . ' 23:59:59',
            ]);

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('surrendered_at', 'desc')->get();

        // Summary per day
        $daily = $payments->groupBy(function ($p) {
            return $p->surrendered_at->format('Y-m-d');
        })->map(function ($group) {
            return [
                'count' => $group->count(),
                'total' => $group->sum('payment_value'),
            ];
        });

        $departments = Department::all();

        return view('payments.reports.handovers',
            compact('payments', 'daily', 'from', 'to', 'departments'));
    }

    /* ============================================================
     *  3) Pending Report – cash in custody, not yet surrendered
     * ============================================================ */
    public function pending(Request $request)
    {
        $query = Payment::with(['student', 'course', 'department', 'enteredBy'])
            ->whereNull('surrendered_at');

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('collected_at', 'asc')->get();

        // Group by department
        $byDepartment = $payments->groupBy('department_id')->map(function ($group) {
            return [
                'department' => $group->first()->department->name ?? 'غير محدد',
                'count'      => $group->count(),
                'total'      => $group->sum('payment_value'),
            ];
        });

        $departments = Department::all();

        return view('payments.reports.pending',
            compact('payments', 'byDepartment', 'departments'));
    }

    /* ============================================================
     *  Printable documents (share a common print layout)
     * ============================================================ */
    public function printCollections(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $query = Payment::with(['student', 'course', 'department', 'enteredBy'])
            ->whereBetween('collected_at', [$from, $to]);

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('collected_at')->get();
        $title    = 'تقرير التحصيل اليومي';
        $subtitle = "من {$from} إلى {$to}";

        return view('payments.reports.print_document',
            compact('payments', 'title', 'subtitle'));
    }

    public function printHandovers(Request $request)
    {
        $from = $request->input('from', now()->startOfMonth()->toDateString());
        $to   = $request->input('to', now()->toDateString());

        $query = Payment::with(['student', 'course', 'department', 'surrenderedTo'])
            ->whereNotNull('surrendered_at')
            ->whereBetween('surrendered_at', [
                $from . ' 00:00:00',
                $to   . ' 23:59:59',
            ]);

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('surrendered_at')->get();
        $title    = 'تقرير تسليمات الصندوق';
        $subtitle = "من {$from} إلى {$to}";

        return view('payments.reports.print_document',
            compact('payments', 'title', 'subtitle'));
    }

    public function printPending(Request $request)
    {
        $query = Payment::with(['student', 'course', 'department', 'enteredBy'])
            ->whereNull('surrendered_at');

        $this->scopeQuery($query, $request->input('department_id'));

        $payments = $query->orderBy('collected_at')->get();
        $title    = 'تقرير العهدة الحالية';
        $subtitle = 'جميع الإيصالات غير المسلّمة حتى ' . now()->format('Y-m-d');

        return view('payments.reports.print_document',
            compact('payments', 'title', 'subtitle'));
    }
}
