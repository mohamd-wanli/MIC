<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>استمارة تسجيل الطالب - {{ $student->fullname }}</title>
<style>
    /* ===== A5 = half A4 ===== */
    @page {
        size: A5 portrait;
        margin: 0%;
    }

    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Tahoma', 'Arial', sans-serif;
        font-size: 9pt;
        color: #000;
        background: #e9e9e9;
        padding: 12px;
        line-height: 1.4;
    }

    .sheet {
        width: 148mm;
        height: 210mm;
        background: #fff;
        margin: 0 auto;
        border: 1px solid #333;
        box-shadow: 0 6px 24px rgba(0,0,0,0.15);
    }

    .inner-border {
        border: 1px solid #333;
        margin: 3mm;
        padding: 3mm;
        height: calc(210mm - 6mm - 2px);
        display: flex;
        flex-direction: column;
    }

    /* ===== HEADER ===== */
    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-bottom: 3px;
        border-bottom: 2px solid #1a1a2e;
        margin-bottom: 5px;
        flex-shrink: 0;
    }
    .header .logo { width: 38px; height: auto; }
    .header .center { text-align: center; flex: 1; padding: 0 6px; }
    .header .center .name {
        font-size: 12pt;
        font-weight: 900;
        color: #1a1a2e;
    }
    .header .center .sub {
        font-size: 8pt;
        color: #555;
        font-weight: 700;
        letter-spacing: 2px;
        margin-top: 1px;
    }
    .header .spacer { width: 38px; }

    /* ===== TWO COLUMN BODY ===== */
    .body-row {
        display: flex;
        gap: 4px;
        flex: 1;
        margin-bottom: 5px;
    }

    /* Right column: student card */
    .col-card {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 0;
    }

    /* Left column: conditions */
    .col-conditions {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    /* ===== PERSONAL INFO ===== */
    .personal-info {
        border: 1px solid #555;
        border-radius: 3px;
        padding: 3px 5px;
        background: #fff;
    }
    .personal-info table {
        width: 100%;
        border-collapse: collapse;
    }
    .personal-info table td {
        padding: 1.5px 2px;
        font-size: 7.5pt;
        vertical-align: middle;
    }
    .personal-info table td:first-child {
        width: 40%;
        font-weight: 700;
        color: #1a1a2e;
    }
    .personal-info table td:last-child {
        border-bottom: 1px dotted #555;
        color: #111;
    }

    /* ===== COURSE BOX ===== */
    .course-box {
        border: 1.5px solid #1a1a2e;
        border-radius: 3px;
        padding: 3px;
        background: #fafbfd;
    }
    .course-box .box-title {
        text-align: center;
        font-weight: 700;
        font-size: 8.5pt;
        color: #1a1a2e;
        border-bottom: 1px solid #1a1a2e;
        padding-bottom: 1px;
        margin-bottom: 2px;
    }
    .course-box table { width: 100%; border-collapse: collapse; }
    .course-box table td {
        padding: 2px 2px;
        font-size: 7.5pt;
        font-weight: 600;
        vertical-align: middle;
    }
    .course-box table td:first-child {
        width: 45%;
        color: #333;
    }
    .course-box table td:last-child {
        border-bottom: 1px dotted #555;
        color: #1a1a2e;
    }

    /* ===== CONDITIONS ===== */
    .conditions-box {
        border: 1.5px solid #1a1a2e;
        border-radius: 3px;
        padding: 3px 5px;
        background: #fdfdfd;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .conditions-box .title {
        text-align: center;
        font-weight: 900;
        font-size: 9.5pt;
        color: #1a1a2e;
        border-bottom: 1px solid #1a1a2e;
        padding-bottom: 2px;
        margin-bottom: 3px;
        flex-shrink: 0;
    }

    .conditions-list {
        list-style: none;
        padding: 0;
        margin: 0;
        counter-reset: cond;
        flex: 1;
    }
    .conditions-list li {
        counter-increment: cond;
        padding: 1px 14px 1px 0;
        font-size: 7pt;
        line-height: 1.45;
        color: #222;
        position: relative;
        text-align: justify;
    }
    .conditions-list li::before {
        content: counter(cond) ".";
        position: absolute;
        right: 0;
        top: 1px;
        font-weight: 700;
        color: #1a1a2e;
        font-size: 7pt;
    }

    /* ===== SIGNATURE ===== */
    .signature-row {
        display: flex;
        justify-content: space-between;
        padding-top: 4px;
        font-size: 8.5pt;
        font-weight: 700;
        color: #1a1a2e;
        border-top: 1px solid #999;
        flex-shrink: 0;
    }
    .signature-row .sig-block { flex: 1; }
    .signature-row .sig-block.right { text-align: right; }
    .signature-row .sig-block.left  { text-align: left; }
    .signature-row .line {
        display: inline-block;
        width: 80px;
        border-bottom: 1px dotted #333;
        margin-right: 4px;
        height: 10px;
    }

    /* ===== SCREEN BUTTONS ===== */
    .no-print {
        text-align: center;
        padding: 12px;
        max-width: 148mm;
        margin: 0 auto 15px;
        background: #f0f0f5;
        border-radius: 10px;
    }
    .btn {
        padding: 9px 26px;
        border: none;
        border-radius: 50px;
        font-weight: 700;
        cursor: pointer;
        font-size: 13px;
        margin: 0 6px;
        font-family: inherit;
        transition: all .2s;
    }
    .btn-print {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #fff;
        box-shadow: 0 4px 12px rgba(17,153,142,.35);
    }
    .btn-print:hover { transform: translateY(-2px); }
    .btn-close { background: #e9ecef; color: #333; }

    /* ===== PRINT ===== */
    /* @media print {
        body {
            background: #fff;
            padding: 0;
            margin: 0;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .sheet {
            width: 100%;
            height: auto;
            min-height: auto;
            border: none;
            box-shadow: none;
            margin: 0;
        }
        .inner-border { height: auto; min-height: auto; margin: 0;
    padding: 2mm; }
        .no-print { display: none !important; }
    } */
         /* ===== PRINT ===== */
    @media print {
        @page {
            size: A5 portrait;
            margin: 0 !important;
           /* Force zero margin */
        }
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            background: #fff;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;

        }
        .sheet {
            width: 100% !important;
            height: auto !important;
            min-height: auto !important;
            border: none !important;
            box-shadow: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }
        .inner-border {
            height: auto !important;
            min-height: auto !important;
            margin: 0 !important; /* Removes outer margin */
            padding: 2mm !important; /* Keeps inner padding so border isn't cut off */
            border: 1px solid #333 !important; /* Keeps the box border */
        }
        .no-print {
            display: none !important;
        }
    }
</style>
</head>
<body>

    {{-- Screen-only buttons --}}
    <div class="no-print">
        <button class="btn btn-print" onclick="window.print()">🖨️ طباعة</button>
        <button class="btn btn-close" onclick="window.close()">✖ إغلاق</button>
    </div>

    <div class="sheet">
        <div class="inner-border">

            {{-- ===== HEADER ===== --}}
            <div class="header">
                <img src="{{ asset('images/logo.png') }}" class="logo" alt="logo" onerror="this.style.display='none'">
                <div class="center">
                    <div class="name">المركز المأمون الدولي</div>
                    <div class="sub">MIC</div>
                </div>
                <div class="spacer"></div>
            </div>

            {{-- ===== TWO COLUMNS: CARD | CONDITIONS ===== --}}
            <div class="body-row">

                {{-- RIGHT: Student card --}}
                <div class="col-card">

                    {{-- Personal Info --}}
                    <div class="personal-info">
                        <table>
                            <tr>
                                <td>الاسم واللقب</td>
                                <td>{{ $student->firstname }} {{ $student->lastname }}</td>
                            </tr>
                            <tr>
                                <td>الاسم بالإنكليزية</td>
                                <td>
                                    {{ $student->Extrastudent->engish_firstname ?? '' }}
                                    {{ $student->Extrastudent->english_lastname ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>اسم الأب</td>
                                <td>{{ $student->fathername ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>الجنسية</td>
                                <td>{{ $student->Extrastudent->nationality ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>مكان وتاريخ الولادة</td>
                                <td>{{ $student->Extrastudent->date_of_birth ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>العنوان</td>
                                <td>{{ $student->Extrastudent->address ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>رقم الهاتف</td>
                                <td>{{ $student->Extrastudent->telephone ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>رقم الجوال</td>
                                <td>{{ $student->Extrastudent->mobile ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>الرقم الوطني</td>
                                <td>{{ $student->national_number ?? '' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- Course Box --}}
                    <div class="course-box">
                        <div class="box-title">معلومات الدورة</div>
                        <table>
                            <tr>
                                <td>اسم الدورة</td>
                                <td>{{ $student->courses->first()->subject_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>رقم الدورة</td>
                                <td>{{ $student->courses->first()->coursenumber ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>اسم الطالب</td>
                                <td>{{ $student->fullname ?? '' }}</td>
                            </tr>
                        </table>
                    </div>

                </div>

                {{-- LEFT: Conditions --}}
                <div class="col-conditions">
                    <div class="conditions-box">
                        <div class="title">شروط التسجيل</div>
                        <ol class="conditions-list">
                            <li>يحق للمركز إجراء تعديل على موعد افتتاح الدورة</li>
                            <li>في حال تعبئة الطالب استمارة الدورة ولم يحضر خلال الفترة المحددة.</li>
                            <li>في حال تغيب الطالب عن نسبة 25% من جلسات الدورة يفقد حقه في الحصول على الشهادة</li>
                            <li>لا يحق للطالب الانسحاب واسترداد أي مبلغ بعد انطلاق الدورة</li>
                            <li>عند الانسحاب من الدورة يعاد للطالب المبلغ المدفوع بعد حسم رسم الانتساب</li>
                            <li>في حال الرسوب يحق للطالب إعادة الامتحان بعد تسديد الرسم</li>
                            <li>يمنع الأكل والشرب التدخين واستخدام الموبايل واصطحاب الأطفال داخل القاعات</li>
                            <li>يمنع بيع وشراء أي مواد داخل القاعات</li>
                            <li>يحق للإدارة فصل الطالب في حال عدم الالتزام بالشروط المذكورة أعلاه.</li>
                        </ol>
                    </div>
                </div>

            </div>

            {{-- ===== SIGNATURE + DATE ===== --}}
            <div class="signature-row">
                <div class="sig-block right">
                    التوقيع: <span class="line"></span>
                </div>
                <div class="sig-block left">
                    التاريخ: <span class="line"></span>
                </div>
            </div>

        </div>
    </div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () { window.print(); }, 350);
        });
    </script>

</body>
</html>
