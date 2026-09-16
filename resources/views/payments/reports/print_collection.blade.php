<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body { font-family: "DejaVu Sans", sans-serif; padding: 20px; direction: rtl; font-size: 13px; }
        h2   { text-align:center; margin: 0 0 5px; }
        .meta{ text-align:center; color:#555; margin-bottom: 15px; font-size: 12px; }
        .summary { display:flex; justify-content:space-around; margin: 15px 0; padding:10px; border:1px solid #000; }
        .summary div { text-align:center; }
        .summary .num { font-size: 16px; font-weight: bold; }
        table { width:100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border:1px solid #000; padding:6px; text-align:center; font-size: 11px; }
        th { background:#f2f2f2; }
        tfoot tr { background:#f2f2f2; font-weight: bold; }
        .signatures { margin-top: 60px; display:flex; justify-content:space-between; }
        .signatures div { width: 40%; text-align:center; border-top: 1px solid #000; padding-top: 8px; }

        @media print {
            @page { size: A4 landscape; margin: 10mm; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>مركز المأمون الدولي</h2>
    <div class="meta">
        {{ $title }}<br>
        {{ $subtitle }}<br>
        تاريخ الطباعة: {{ now()->format('Y-m-d H:i') }}
        — بواسطة: {{ auth()->user()->name }}
    </div>

    <div class="summary">
        <div>
            <div class="num">{{ $payments->count() }}</div>
            <div>عدد الإيصالات</div>
        </div>
        <div>
            <div class="num">{{ number_format($payments->sum('payment_value')) }} ل.س</div>
            <div>الإجمالي</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>رقم الوصل</th>
                <th>تاريخ التحصيل</th>
                <th>الطالب</th>
                <th>الدورة</th>
                 <th>رقم الدورة</th>
                <th>المبلغ</th>
                <th>الحسم</th>
                <th>نوع الدفعة</th>

                {{-- @if(isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at)
                    <th>تاريخ التسليم</th>
                @endif --}}
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->receipt_number ?? '—' }}</td>
                    <td>{{ $p->collected_at ? $p->collected_at->format('Y-m-d') : '—' }}</td>
                    <td>{{ $p->student->fullname ?? '—' }}</td>
                    <td>{{ $p->course->subject_name ?? '—' }}</td>
                   <td>{{ $p->course->coursenumber ?? '—' }}</td>
                    <td>{{ number_format($p->payment_value) }} ل.س</td>
                    <td>{{ $p->discount }}</td>
                    <td>{{ $p->payment_category }}</td>
                    {{-- @if(isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at)
                        <td>{{ $p->surrendered_at ? $p->surrendered_at->format('Y-m-d H:i') : '—' }}</td>
                    @endif --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">الإجمالي</td>
                <td>{{ number_format($payments->sum('payment_value')) }} ل.س</td>
                <td colspan="{{ isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at ? 2 : 1 }}"></td>
            </tr>
        </tfoot>
    </table>

    <div class="signatures">
        <div>توقيع المُسلِّم</div>
        <div>توقيع المستلم</div>
    </div>

</body>
</html>
