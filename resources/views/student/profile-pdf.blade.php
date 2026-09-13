<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>الذاتية</title>

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            direction: rtl;
            unicode-bidi: embed;
            text-align: right;
        }

        .page-border {
            border: 2px solid #000;
            padding: 20px;
        }

        .top-section {
            width: 100%;
            margin-bottom: 20px;
        }

        .top-section table {
            width: 100%;
        }

        .top-section td {
            vertical-align: top;
        }

        .right-top {
            text-align: right;
            font-size: 14px;
        }

        .center-top {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .left-top {
            text-align: left;
        }

        .main-table {
            width: 100%;
            border: 2px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .main-table td {
            padding: 8px;
            vertical-align: middle;
        }

        .inner-table {
            width: 100%;
            border: 2px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .inner-table th, .inner-table td {
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
        }

        .no-border-table {
            width: 100%;
            margin-top: 15px;
        }

        .no-border-table td {
            padding: 6px;
        }

        .section {
            margin-top: 20px;
        }

        .signatures {
            width: 100%;
            margin-top: 40px;
        }

        .signatures td {
            text-align: center;
            padding-top: 40px;
        }
    </style>
</head>
<body>

<div class="page-border">

    <!-- Top Section -->
    <div class="top-section">
        <table>
            <tr>
                <td class="right-top">
                    <strong>قسم الدورة:</strong> {{ $course->subject_name ?? '-' }}<br>
                    <strong>الرقم الوطني:</strong> {{ $student->national_number ?? '-' }}
                </td>

                <td class="center-top">
                    شركة مامون الدولية<br>
                    Mamoun International Corporation<br>
                    استمارة طلب شهادة خبرة
                </td>

                <td class="left-top">
                    <img src="{{ public_path('images/logo.png') }}" width="100">
                </td>
            </tr>
        </table>
    </div>

    <div style="border: 2px solid #000; padding: 10px;">

        <!-- Main Info Table -->
        <table class="main-table">
           <tr>
    <td colspan="6" style="text-align:center padding: 10px;">
        @if(isset($student->extraStudent) && $student->extraStudent->gender == 'ذكر')
            السيد :
        @elseif(isset($student->extraStudent) && $student->extraStudent->gender == 'أنثى')
            السيدة :
        @else
            السيد/ة :
        @endif
        <strong>{{ $student->fullname ?? '-' }}</strong>
        &nbsp;&nbsp;—&nbsp;&nbsp;
        @if(isset($student->extraStudent) && $student->extraStudent->gender == 'ذكر')
            Mr.
        @elseif(isset($student->extraStudent) && $student->extraStudent->gender == 'أنثى')
            Miss
        @else
            Mr./Ms.
        @endif
        {{ trim(($student->extraStudent->engish_firstname ?? '') . ' ' .
               ($student->extraStudent->engish_fathername ?? '') . ' ' .
               ($student->extraStudent->english_lastname ?? '')) ?: '-' }}
    </td>
</tr>
            <tr>
                <td colspan="2">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:25%; text-align:right;">
                                اسم الأب: {{ $student->fathername ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                اسم الأم: {{ $student->extraStudent?->mothername ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                الجنسية: {{ $student->extraStudent?->nationality ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                المستوى الثقافي: {{ $student->extraStudent?->cultural_level ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:25%; text-align:right;">
                                مكان وتاريخ الولادة: {{ $student->extraStudent?->date_of_birth ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                رقم الهاتف: {{ $student->extraStudent?->telephone ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                الموبايل: {{ $student->extraStudent?->mobile ?? '-' }}
                            </td>
                            <td style="width:25%; text-align:right;">
                                العنوان: {{ $student->extraStudent?->address ?? '-' }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Course Detailed Table - DISPLAY ONLY, NO INPUTS -->
        <table class="inner-table">
            <tr>
                <th>اسم الدورة</th>
                <th>رقم الدورة</th>
                <th>رقم الصفحة</th>
                <th>رقم العام</th>
                <th>رقم تسلسل</th>
                <th>تاريخ البدء</th>
                <th>تاريخ النهاية</th>
                <th>التقدير</th>
            </tr>
            <tr>
                <td>{{ $course->subject_name ?? '-' }}</td>
                <td>{{ $course->coursenumber ?? '-' }}</td>
                <td>{{ $course->pivot->page_number ?? '-' }}</td>
                <td>{{ $course->pivot->year_number ?? '-' }}</td>
                <td>{{ $course->pivot->serial_number ?? '-' }}</td>
                <td>{{ $course->start_date ?? '-' }}</td>
                <td>{{ $course->end_date ?? '-' }}</td>
                <td>{{ $course->pivot->coursegrade ?? '-' }}</td>
            </tr>
        </table>

        <!-- Overall Dates -->
       <!-- Overall Dates -->
<table class="inner-table" style="margin-top: 15px;">
    <tr>
        <th style="width:50%;">تاريخ البداية الكلي</th>
        <th style="width:50%;">تاريخ النهاية الكلي</th>
    </tr>
    <tr>
        <td>{{ $course->start_date ?? '-' }}</td>
        <td>{{ $course->end_date ?? '-' }}</td>
    </tr>
</table>

        <!-- Student Signature -->
        <div class="section">
            اسم وتوقيع الطالب : {{ $student->fullname ?? '-' }}
        </div>

        <!-- Signatures -->
        <table class="signatures">
            <tr>
                <td>منظم الشهادة</td>
                <td>مديرة الفرع</td>
                <td>محاسب الفرع</td>
                <td>مدقق الحسابات</td>
            </tr>
        </table>

    </div>

</div>

</body>
</html>
