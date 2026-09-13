<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>سند تسليم إيصالات</title>
    <style>
        body { font-family:"DejaVu Sans", sans-serif; padding:20px; direction:rtl; }
        h2 { text-align:center; margin-bottom:5px; }
        .meta { text-align:center; color:#666; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; margin-top:20px; }
        th, td { border:1px solid #000; padding:8px; text-align:center; font-size:13px; }
        th { background:#f2f2f2; }
        .signatures { margin-top:60px; display:flex; justify-content:space-between; }
        .signatures div { width:40%; text-align:center; border-top:1px solid #000; padding-top:10px; }
    </style>
</head>
<body>

<h2>مركز المأمون الدولي</h2>
<div class="meta">
    سند تسليم إيصالات — التاريخ: {{ date('Y-m-d H:i') }}<br>
    المستلم: {{ auth()->user()->name }}
</div>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>رقم الوصل</th>
            <th>الطالب</th>
            <th>الدورة</th>
            <th>المبلغ</th>
            <th>تاريخ التحصيل</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($payments as $i => $p)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $p->receipt_number }}</td>
                <td>{{ $p->student->fullname ?? '—' }}</td>
                <td>{{ $p->course->subject_name ?? '—' }}</td>
                <td>{{ number_format($p->payment_value) }} ج.م</td>
                <td>{{ $p->collected_at ? $p->collected_at->format('Y-m-d') : '—' }}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="4"><strong>الإجمالي</strong></td>
            <td colspan="2"><strong>{{ number_format($payments->sum('payment_value')) }} ج.م</strong></td>
        </tr>
    </tbody>
</table>

<div class="signatures">
    <div>توقيع المُسلِّم</div>
    <div>توقيع المستلم</div>
</div>

</body>
</html>
