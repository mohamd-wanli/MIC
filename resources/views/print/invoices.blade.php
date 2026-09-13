<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير الفواتير</title>
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <style>
        body {
            direction: rtl;
            font-family: 'Tajawal', sans-serif;
            background: #fff;
            padding: 20px;
        }
        .header-section {
            text-align: center;
            margin-bottom: 20px;
        }
        .center-info {
            font-size: 20px;
            font-weight: bold;
        }
        .filters {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .filters input {
            padding: 5px;
            font-size: 16px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .table-container {
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            vertical-align: middle;
            padding: 8px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .summary {
            margin-top: 10px;
            font-size: 18px;
            font-weight: bold;
            text-align: right;
        }
        .print-btn {
            margin-top: 20px;
        }
        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- رأس الصفحة -->
    <div class="header-section">
        <div class="center-info">
            <h3>مركز المأمون الدولي</h3>
        </div>
        <div class="filters">
            <label for="branch">فرع:</label>
            <input type="text" id="branch" placeholder="أدخل الفرع">

            <label for="department">قسم:</label>
            <input type="text" id="department" placeholder="أدخل القسم">
        </div>
    </div>

    <!-- تقرير المقبوضات اليومية -->
    <div class="report-header">
        <h4>جدول المقبوضات اليومية - {{ now()->format('Y-m-d') }}</h4>
    </div>

    <!-- جدول الفواتير -->
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>المعرف</th>
                    <th>اسم الطالب</th>
                    <th>رقم الدفعة</th>
                    <th>مقدار الدفعة</th>
                    <th>تاريخ الدفع</th>
                    <th>رقم الوصل</th>
                    <th>نوع الدفعة</th>
                </tr>
            </thead>
            <tbody>
                @php $totalAmount = 0; @endphp
                @foreach ($invoices as $i => $invoice)
                    @php $totalAmount += $invoice->payment_amount; @endphp
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $invoice->student->fullname ?? 'غير متوفر' }}</td>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ $invoice->payment_amount }}</td>
                        <td>{{ $invoice->payment_date }}</td>
                        <td>{{ $invoice->invoice_num }}</td>
                        <td>{{ $invoice->payment_type }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- إجمالي المدفوعات -->
        <div class="summary">
            الإجمالي العام: {{ $totalAmount }}
        </div>
    </div>

    <!-- زر الطباعة -->
    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary print-btn">طباعة التقرير</button>
    </div>

    <!-- توقيع المدير -->
    {{-- <div class="signature-section">
        <p class="signature">مدير المركز: مأمون</p>
    </div> --}}

</body>
</html>
