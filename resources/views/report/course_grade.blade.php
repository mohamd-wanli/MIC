<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>كشف درجات – {{ $course->subject_name }}</title>
    <style>
        * { box-sizing: border-box; }

        body {
            font-family: "Tahoma", "Arial", sans-serif;
            background: #e9e9e9;
            margin: 0;
            padding: 20px;
        }

        .sheet {
            background: #fff;
            width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #999;
        }

        /* ===== Header ===== */
        .header {
            text-align: center;
            border-bottom: 3px solid #1a1a2e;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .header .institute {
            font-size: 20px;
            font-weight: bold;
            color: #1a1a2e;
        }
        .header .report-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-top: 4px;
        }

        /* ===== Course info bar ===== */
        .course-info {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
            background: #f4f6fa;
        }
        .course-info td {
            border: 1px solid #333;
            padding: 6px 10px;
            font-size: 13px;
            font-weight: bold;
        }
        .course-info .label { background: #e8edf5; width: 15%; }

        /* ===== Grades table ===== */
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }
        .grades-table thead th {
            background: #1a1a2e;
            color: #fff;
            border: 1px solid #1a1a2e;
            padding: 8px 6px;
            text-align: center;
            font-weight: bold;
        }
        .grades-table tbody td {
            border: 1px solid #999;
            padding: 6px;
            text-align: center;
            height: 26px;
        }
        .grades-table tbody td.name-cell {
            text-align: right;
            padding-right: 10px;
            font-weight: bold;
        }
        .grades-table tbody tr:nth-child(even) {
            background: #fafbfd;
        }

        /* Empty rows to fill the sheet */
        .empty-row td { height: 26px; }

        /* ===== Footer signatures ===== */
        .signatures {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        .signatures td {
            border: 1px solid #333;
            padding: 8px;
            font-size: 12px;
            font-weight: bold;
            height: 60px;
            vertical-align: top;
            width: 33.33%;
        }

        /* ===== Print styles ===== */
        @media print {
            body { background: #fff; padding: 0; margin: 0; }
            .sheet { width: 100%; border: none; padding: 0; }
            .no-print { display: none !important; }
            @page { size: A4 portrait; margin: 10mm; }
            .grades-table thead th {
                background: #333 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .course-info { background: #f4f6fa !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }

        /* Print button */
        .no-print { text-align: center; margin-bottom: 15px; }
        .btn {
            border: none;
            padding: 10px 30px;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-print {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }
        .btn-close {
            background: #e9e9e9;
            color: #333;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    {{-- Print buttons (hidden in print) --}}
    <div class="no-print">
        <button class="btn btn-print" onclick="window.print()">🖨️ طباعة</button>
        <button class="btn btn-close" onclick="window.close()">✖ إغلاق</button>
    </div>

    <div class="sheet">

        {{-- ===== HEADER ===== --}}
        <div class="header">
            <div class="institute">مركز المأمون الدولي</div>
            <div class="report-title">كشف درجات الطلاب</div>
        </div>

        {{-- ===== COURSE INFO ===== --}}
        <table class="course-info">
            <tr>
                <td class="label">اسم الدورة :</td>
                <td>{{ $course->subject_name }}</td>
                <td class="label">رقم الدورة :</td>
                <td>{{ $course->coursenumber }}</td>
            </tr>
        </table>

        {{-- ===== GRADES TABLE ===== --}}
        <table class="grades-table">
            <thead>
                <tr>
                    <th style="width:8%;">#</th>
                    <th style="width:52%;">اسم الطالب</th>
                    <th style="width:20%;">نظري</th>
                    <th style="width:20%;">عملي</th>
                </tr>
            </thead>
            <tbody>
                @forelse($course->students as $index => $student)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="name-cell">{{ $student->fullname }}</td>
                        <td></td>
                        <td></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; color:#888; padding:15px;">
                            لا يوجد طلاب في هذه الدورة
                        </td>
                    </tr>
                @endforelse

                {{-- Extra empty rows to give writing space --}}
                @for($i = 0; $i < 5; $i++)
                    <tr class="empty-row">
                        <td></td><td></td><td></td><td></td>
                    </tr>
                @endfor
            </tbody>
        </table>

        {{-- ===== SIGNATURES ===== --}}
        <table class="signatures">
            <tr>
                <td>المدرس :<br><br><br>التوقيع :</td>
                {{-- <td>مدقق الأقساط والنتائج :<br><br><br>التوقيع :</td> --}}
                <td>المشرفة  :<br><br><br>التوقيع :</td>
            </tr>
        </table>

    </div>
</body>
</html>
