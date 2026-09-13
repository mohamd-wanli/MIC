<!DOCTYPE html>
<html lang="ar">

<head>

    <meta charset="UTF-8">

    <title>طباعة الطلاب</title>

    <style>

        body{
            direction: rtl;
            font-family: 'DejaVu Sans', Tahoma, Arial, sans-serif;
            margin: 40px;
            background: #ffffff;
        }

        /* header layout */
        .header{
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #667eea;
            font-size: 16px;
            font-weight: bold;
        }

        .header .center{
            text-align: center;
            flex: 1;
            font-size: 20px;
            color: #2d3436;
        }

        .header .right{
            text-align: right;
            width: 30%;
            font-size: 14px;
            color: #6c757d;
        }

        .header .left{
            text-align: left;
            width: 30%;
            font-size: 14px;
            color: #6c757d;
        }

        .header .left strong,
        .header .right strong {
            color: #2d3436;
        }

        /* Report Title */
        .report-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #2d3436;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eef2f7;
        }

        /* table */
        table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td{
            border: 1px solid #000;
            padding: 8px 10px;
            text-align: center;
            font-size: 13px;
        }

        th{
            background: linear-gradient(135deg, #1a1a2e, #2d3436);
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background: #f8faff;
        }

        tbody tr:hover {
            background: #eef2f7;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #eef2f7;
            display: flex;
            justify-content: space-between;
            font-size: 14px;
            color: #6c757d;
        }

        .footer .date {
            text-align: right;
        }

        .footer .page {
            text-align: left;
        }

        /* Print Styles */
        @media print {
            body {
                margin: 20px;
            }
            th {
                background: #f2f2f2 !important;
                color: #000000 !important;
            }
            tbody tr:nth-child(even) {
                background: #f9f9f9 !important;
            }
            .header {
                border-bottom-color: #000;
            }
            .footer {
                border-top-color: #000;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            body {
                margin: 15px;
            }
            th, td {
                padding: 6px 8px;
                font-size: 11px;
            }
            .header {
                flex-direction: column;
                gap: 8px;
                text-align: center;
            }
            .header .right,
            .header .left {
                width: 100%;
                text-align: center;
            }
            .header .center {
                font-size: 16px;
            }
            .report-title {
                font-size: 18px;
            }
        }

        @media (max-width: 480px) {
            th, td {
                padding: 4px 6px;
                font-size: 10px;
            }
            .header .center {
                font-size: 14px;
            }
            .report-title {
                font-size: 16px;
            }
        }
    </style>

</head>

<body onload="window.print()">

<!-- Header -->
<div class="header">

    <div class="right">
        <strong>استعلام ذاتية الطلاب</strong>
    </div>

    <div class="center">
        @if($course)
            <span style="color: #667eea;">📚</span> {{ $course->subject_name }}
        @endif
    </div>

    <div class="left">
        @if($course)
            <strong>رقم الدورة :</strong> {{ $course->id }}
        @endif
    </div>

</div>

<!-- Report Title -->
<div class="report-title">
    قائمة الطلاب المسجلين في الدورة
</div>

<!-- Table -->
<table>

    <thead>

    <tr>
        <th>#</th>
        <th>الاسم والشهرة</th>
        <th>اسم الأب</th>
        <th>اسم الأم</th>
        <th>الرقم الوطني</th>
        <th>تاريخ ومكان الولادة</th>
        <th>رقم الهاتف</th>
        <th>الجوال</th>
        <th>عنوان السكن</th>
    </tr>

    </thead>

    <tbody>

    @forelse($students as $index => $student)

        <tr>
            <td>{{ $index + 1 }}</td>
            <td><strong>{{ $student->fullname }}</strong></td>
            <td>{{ $student->fathername }}</td>
            <td>{{ $student->Extrastudent->mothername ?? '-' }}</td>
            <td>{{ $student->national_number ?? '-' }}</td>
            <td>{{ $student->Extrastudent->date_of_birth ?? '-' }}</td>
            <td>{{ $student->Extrastudent->telephone ?? '-' }}</td>
            <td>{{ $student->Extrastudent->mobile ?? '-' }}</td>
            <td>{{ $student->Extrastudent->address ?? '-' }}</td>
        </tr>

    @empty

        <tr>
            <td colspan="9" style="text-align: center; padding: 30px; color: #adb5bd;">
                <i class="fas fa-info-circle"></i> لا يوجد طلاب مسجلين في هذه الدورة
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

<!-- Footer -->
<div class="footer">

    <div class="date">
        <strong>تاريخ الطباعة :</strong> {{ date('Y-m-d') }}
    </div>

    <div class="page">
        <strong>عدد الطلاب :</strong> {{ $students->count() }}
    </div>

</div>

</body>

</html>
