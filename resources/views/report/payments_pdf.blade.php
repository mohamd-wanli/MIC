{{-- <!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير المدفوعات المفصل</title>
    <style>
        /* ============================================
           FIX: Arabic Font Support
           ============================================ */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/DejaVuSans-Bold.ttf') }}") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
            line-height: 1.6;
            direction: rtl;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #667eea;
            font-size: 22px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            color: #777;
            margin: 5px 0 0;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            background: #f8faff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary .item {
            font-weight: bold;
        }
        .summary .item span {
            color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10px;
            direction: rtl;
        }
        table thead {
            background: #1a1a2e;
            color: #ffffff;
        }
        table thead th {
            padding: 8px 6px;
            text-align: center;
            font-size: 9px;
            text-transform: uppercase;
            font-weight: bold;
        }
        table tbody td {
            padding: 6px;
            text-align: center;
            border-bottom: 1px solid #eef2f7;
            font-size: 9px;
        }
        table tbody tr:nth-child(even) {
            background: #f8faff;
        }

        .status-paid {
            color: #28a745;
            font-weight: bold;
        }
        .status-partial {
            color: #f7971e;
            font-weight: bold;
        }
        .status-unpaid {
            color: #dc3545;
            font-weight: bold;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 50px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        /* Fix for Arabic text */
        .arabic-text {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            direction: rtl;
            unicode-bidi: embed;
        }

        /* Table header fix for Arabic */
        th, td {
            unicode-bidi: embed;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="arabic-text">تقرير المدفوعات المفصل</h1>
        <p>تاريخ التقرير: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
        @if($from || $to)
            <p style="font-size: 10px; color: #888;">
                الفترة: {{ $from ?? 'بداية' }} إلى {{ $to ?? 'الآن' }}
            </p>
        @endif
    </div>

    <div class="summary">
        <div class="item">عدد الدفعات: <span>{{ $totalPaymentCount }}</span></div>
        <div class="item">المجموع الكلي: <span>{{ number_format($totalSum) }} ل.س</span></div>
        <div class="item">عدد الطلاب: <span>{{ count($reportData) }}</span></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>رقم الدورة</th>
                <th>اسم الدورة</th>
                <th>سعر الدورة</th>
                <th>إجمالي المدفوع</th>
                <th>عدد الدفعات</th>
                <th>المتبقي</th>
                <th>الحالة</th>
                <th>آخر دفعة</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @forelse ($reportData as $data)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td><strong>{{ $data->student_name }}</strong></td>
                    <td>{{ $data->course_number }}</td>
                    <td>{{ $data->course_name }}</td>
                    <td>{{ number_format($data->course_price) }}</td>
                    <td><strong>{{ number_format($data->total_paid) }}</strong></td>
                    <td>{{ $data->payment_count }}</td>
                    <td>
                        @if($data->remaining == 0)
                            <span class="status-paid">0</span>
                        @else
                            <span class="status-partial">{{ number_format($data->remaining) }}</span>
                        @endif
                    </td>
                    <td>
                        @if($data->remaining == 0)
                            <span class="badge badge-success">✅ مسدد</span>
                        @elseif($data->total_paid > 0)
                            <span class="badge badge-warning">⚠️ متبقي</span>
                        @else
                            <span class="badge badge-danger">❌ غير مسدد</span>
                        @endif
                    </td>
                    <td>{{ $data->last_payment ? $data->last_payment->format('Y-m-d') : '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="10" style="text-align: center; padding: 20px; color: #999;">
                        لا توجد مدفوعات مسجلة
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        تم إنشاء هذا التقرير بواسطة النظام - {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}
    </div>
</body>
</html> --}}
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير المدفوعات المفصل</title>
    <style>
        /* ===== Font for Arabic ===== */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/DejaVuSans.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: bold;
            src: url("{{ storage_path('fonts/DejaVuSans-Bold.ttf') }}") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
            line-height: 1.6;
            direction: rtl;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #667eea;
            font-size: 22px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            color: #777;
            margin: 5px 0 0;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            background: #f8faff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary .item {
            font-weight: bold;
        }
        .summary .item span {
            color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 9px;
            direction: rtl;
        }
        table thead {
            background: #1a1a2e;
            color: #ffffff;
        }
        table thead th {
            padding: 8px 4px;
            text-align: center;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
        table tbody td {
            padding: 6px 4px;
            text-align: center;
            border-bottom: 1px solid #eef2f7;
            font-size: 9px;
        }
        table tbody tr:nth-child(even) {
            background: #f8faff;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        /* Fix for Arabic */
        .arabic-text {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            direction: rtl;
            unicode-bidi: embed;
        }
        th, td {
            unicode-bidi: embed;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="arabic-text">تقرير المدفوعات المفصل</h1>
        <p>تاريخ التقرير: {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}</p>
        @if($from || $to)
            <p style="font-size: 10px; color: #888;">
                الفترة: {{ $from ?? 'بداية' }} إلى {{ $to ?? 'الآن' }}
            </p>
        @endif
    </div>

    {{-- Summary stats --}}
    <div class="summary">
        <div class="item">عدد الدفعات: <span>{{ $totalPaymentCount }}</span></div>
                <div class="item">المجموع الكلي: <span>{{ number_format($totalSum) }} ل.س</span></div>
        <div class="item">عدد الطلاب: <span>{{ count($reportData) }}</span></div>
    </div>

    {{-- Main table – each payment is a row --}}
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>رقم الدورة</th>
                <th>اسم الدورة</th>
                <th>سعر الدورة</th>
                <th>المبلغ المدفوع</th>
                <th>نوع الدفع</th>
                <th>الملاحظة</th>
                <th>تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @forelse ($reportData as $student)
                {{-- Loop through each payment of this student --}}
                @foreach ($student->payments as $payment)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td><strong>{{ $student->student_name }}</strong></td>
                        <td>{{ $student->course_number }}</td>
                        <td>{{ $student->course_name }}</td>
                        <td>{{ number_format($student->course_price) }}</td>
                        <td><strong>{{ number_format($payment->payment_value) }}</strong></td>
                        <td>
                            @switch($payment->payment_type)
                                @case('cash') 💰 نقدي @break
                                @case('visa') 💳 وثيقة حضور@break
                                @case('bank') 🏦رسوم شهادة @break
                                @default {{ $payment->payment_type }}
                            @endswitch
                        </td>
                        <td>{{ $payment->note ?? '—' }}</td>
                        <td>{{ $payment->created_at ? $payment->created_at->format('Y-m-d') : '—' }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px; color: #999;">
                        لا توجد مدفوعات مسجلة
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        تم إنشاء هذا التقرير بواسطة النظام - {{ \Carbon\Carbon::now()->format('Y-m-d H:i') }}
    </div>
</body>
</html>
