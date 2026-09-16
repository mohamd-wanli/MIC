@extends('layouts.master')

@section('title', 'تقرير العهدة الحالية')

@section('css')
    @include('payments.reports._styles')
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <div class="report-card">
        <div class="report-header">
            <h3><i class="fas fa-wallet"></i> العهدة الحالية</h3>
            <p>جميع الإيصالات التي لم يتم تسليمها للصندوق حتى الآن</p>
        </div>

        <div class="report-body">

            {{-- Filters --}}
            <form method="GET" action="{{ route('payments.reports.pending') }}" class="filter-bar">
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
                <a href="{{ route('payments.reports.pending.print', request()->all()) }}"
                   target="_blank" class="btn-print">
                    <i class="fas fa-print"></i> طباعة
                </a>
            </form>

            {{-- Summary per Department --}}
            <div class="summary-cards">
                @foreach($byDepartment as $row)
                    <div class="summary-card">
                        <div class="num">{{ number_format($row['total']) }}</div>
                        <div class="lbl">
                            {{ $row['department'] }}
                            <br>
                            <small>{{ $row['count'] }} إيصال</small>
                        </div>
                    </div>
                @endforeach
                <div class="summary-card" style="background:linear-gradient(135deg,#667eea,#764ba2); color:#fff;">
                    <div class="num" style="color:#fff;">{{ number_format($payments->sum('payment_value')) }}</div>
                    <div class="lbl" style="color:rgba(255,255,255,.9);">الإجمالي العام (ل.س)</div>
                </div>
            </div>

            {{-- Details --}}
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الوصل</th>
                            <th>تاريخ التحصيل</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>القسم</th>
                            <th>أُدخل بواسطة</th>
                            <th>الأيام منذ التحصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $i => $p)
                            @php
                                $days = $p->collected_at ? $p->collected_at->diffInDays(now()) : null;
                            @endphp
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td><strong style="color:#667eea;">{{ $p->receipt_number ?? '—' }}</strong></td>
                                <td>{{ $p->collected_at ? $p->collected_at->format('Y-m-d') : '—' }}</td>
                                <td>{{ $p->student->fullname ?? '—' }}</td>
                                <td>{{ $p->course->subject_name ?? '—' }}</td>
                                <td><strong>{{ number_format($p->payment_value) }} ل.س</strong></td>
                                <td>{{ $p->department->name ?? '—' }}</td>
                                <td>{{ $p->enteredBy->name ?? '—' }}</td>
                                <td>
                                    @if($days !== null)
                                        <span class="status-badge {{ $days > 7 ? 'danger' : 'warning' }}">
                                            {{ $days }} يوم
                                        </span>
                                    @else
                                        —
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="9" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد إيصالات في العهدة حالياً ✅
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection