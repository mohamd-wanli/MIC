@extends('layouts.master')

@section('title', 'تقرير تسليمات الصندوق')

@section('css')
    @include('payments.reports._styles')
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <div class="report-card">
        <div class="report-header">
            <h3><i class="fas fa-hand-holding-usd"></i> تقرير تسليمات الصندوق</h3>
            <p>الإيصالات التي تم تسليمها للمحاسب حسب تاريخ التسليم</p>
        </div>

        <div class="report-body">

            {{-- Filters --}}
            <form method="GET" action="{{ route('payments.reports.handovers') }}" class="filter-bar">
                <div>
                    <label>من تاريخ</label>
                    <input type="date" name="from" value="{{ $from }}">
                </div>
                <div>
                    <label>إلى تاريخ</label>
                    <input type="date" name="to" value="{{ $to }}">
                </div>
                @if(auth()->user()->hasRole('Admin'))
                <div>
                    <label>القسم</label>
                    <select name="department_id">
                        <option value="">جميع الأقسام</option>
                        @foreach($departments as $d)
                            <option value="{{ $d->id }}" {{ request('department_id') == $d->id ? 'selected' : '' }}>
                                {{ $d->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
                <button type="submit" class="btn-filter"><i class="fas fa-search"></i> بحث</button>
                <a href="{{ route('payments.reports.handovers.print', request()->all()) }}"
                   target="_blank" class="btn-print">
                    <i class="fas fa-print"></i> طباعة
                </a>
            </form>

            {{-- Summary --}}
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="num">{{ $payments->count() }}</div>
                    <div class="lbl">عدد الإيصالات المسلّمة</div>
                </div>
                <div class="summary-card">
                    <div class="num">{{ number_format($payments->sum('payment_value')) }}</div>
                    <div class="lbl">الإجمالي المسلّم (ج.م)</div>
                </div>
                <div class="summary-card">
                    <div class="num">{{ $daily->count() }}</div>
                    <div class="lbl">عدد أيام التسليم</div>
                </div>
            </div>

            {{-- Details --}}
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ التسليم</th>
                            <th>رقم الوصل</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>تاريخ التحصيل</th>
                            <th>تم التسليم إلى</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $i => $p)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $p->surrendered_at ? $p->surrendered_at->format('Y-m-d H:i') : '—' }}</td>
                                <td><strong style="color:#667eea;">{{ $p->receipt_number ?? '—' }}</strong></td>
                                <td>{{ $p->student->fullname ?? '—' }}</td>
                                <td>{{ $p->course->subject_name ?? '—' }}</td>
                                <td><strong>{{ number_format($p->payment_value) }} ج.م</strong></td>
                                <td>{{ $p->collected_at ? $p->collected_at->format('Y-m-d') : '—' }}</td>
                                <td>{{ $p->surrenderedTo->name ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="8" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد تسليمات في هذه الفترة
                            </td></tr>
                        @endforelse
                    </tbody>
                    @if($payments->count())
                    <tfoot>
                        <tr style="background:#f8faff; font-weight:700;">
                            <td colspan="5">الإجمالي</td>
                            <td>{{ number_format($payments->sum('payment_value')) }} ج.م</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                    @endif
                </table>
            </div>

        </div>
    </div>
</div>
@endsection