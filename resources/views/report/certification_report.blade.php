@extends('layouts.master')

@section('title', 'تقرير الشهادات والقوائم')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery-ui.css') }}">

    <style>
        /* ============================================================
           PREMIUM DESIGN FOR CERTIFICATION REPORT & DATA EXPORT
           ============================================================ */
        .cert-report-wrapper {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            padding-bottom: 2.5rem;
        }

        /* Hero Header */
        .cert-hero {
            background: linear-gradient(135deg, #122140 0%, #1f3563 100%);
            border-radius: 16px;
            color: #ffffff;
            padding: 1.75rem 2rem;
            box-shadow: 0 10px 25px rgba(18, 33, 64, 0.12);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .cert-hero::before {
            content: '';
            position: absolute;
            top: -40%;
            left: -10%;
            width: 240px;
            height: 240px;
            background: radial-gradient(circle, rgba(185, 135, 60, 0.28) 0%, transparent 70%);
            pointer-events: none;
        }

        .cert-hero-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #fdfbf6;
        }

        .cert-hero-title i {
            color: #e7d2a6;
            font-size: 1.6rem;
        }

        .cert-hero-desc {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
            margin: 0.35rem 0 0 0;
        }

        /* Modern Card Containers */
        .modern-card {
            background: #ffffff;
            border: 1px solid #edf0f5;
            border-radius: 14px;
            box-shadow: 0 4px 18px rgba(18, 33, 64, 0.04);
            overflow: hidden;
        }

        .modern-card-header {
            background: #fafbfe;
            border-bottom: 1px solid #eef1f6;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .modern-card-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: #122140;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Course Info Badge Strip */
        .course-info-strip {
            background: linear-gradient(135deg, #f8faff 0%, #f0f4fa 100%);
            border: 1px solid #e1e7f0;
            border-right: 4px solid #b9873c;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .info-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            background: #ffffff;
            padding: 0.45rem 0.85rem;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #334155;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        .info-pill strong {
            color: #122140;
        }

        /* Table Aesthetics */
        .table-responsive {
            padding: 1.25rem;
        }

        table.dataTable {
            width: 100% !important;
            border-collapse: separate !important;
            border-spacing: 0 !important;
            border: 1px solid #e9edf4 !important;
            border-radius: 10px !important;
            overflow: hidden !important;
            margin-top: 1rem !important;
            margin-bottom: 1rem !important;
        }

        table.dataTable thead th {
            background-color: #122140 !important;
            color: #fdfbf6 !important;
            font-weight: 600 !important;
            font-size: 0.88rem !important;
            text-align: center !important;
            vertical-align: middle !important;
            padding: 12px 10px !important;
            border: none !important;
            letter-spacing: 0.2px;
        }

        table.dataTable tbody td {
            text-align: center !important;
            vertical-align: middle !important;
            padding: 11px 10px !important;
            border-bottom: 1px solid #f0f3f8 !important;
            border-top: none !important;
            font-size: 0.92rem !important;
            color: #24292f;
        }

        table.dataTable tbody tr:nth-child(even) {
            background-color: #fbfcfe !important;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f5fb !important;
            transition: background-color 0.15s ease;
        }

        /* DataTables Custom Export Buttons */
        .dt-buttons {
            display: flex !important;
            gap: 8px !important;
            flex-wrap: wrap !important;
            margin-bottom: 14px !important;
        }

        .dt-button {
            border-radius: 8px !important;
            padding: 7px 16px !important;
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            border: 1px solid #dce2eb !important;
            background: #ffffff !important;
            color: #122140 !important;
            transition: all 0.2s ease !important;
            box-shadow: 0 2px 4px rgba(18, 33, 64, 0.04) !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 6px !important;
            cursor: pointer !important;
        }

        .dt-button:hover {
            background: #f4f6fb !important;
            border-color: #122140 !important;
            color: #122140 !important;
            transform: translateY(-1px);
        }

        .dt-button.buttons-print {
            background: #122140 !important;
            color: #ffffff !important;
            border-color: #122140 !important;
        }

        .dt-button.buttons-print:hover {
            background: #1f3563 !important;
            color: #ffffff !important;
        }

        .dt-button.buttons-excel {
            background: #107e3e !important;
            color: #ffffff !important;
            border-color: #107e3e !important;
        }

        .dt-button.buttons-excel:hover {
            background: #0d6531 !important;
            color: #ffffff !important;
        }

        .dt-button.buttons-copy {
            background: #475569 !important;
            color: #ffffff !important;
            border-color: #475569 !important;
        }

        .dt-button.buttons-copy:hover {
            background: #334155 !important;
            color: #ffffff !important;
        }

        /* Empty State */
        .empty-state {
            padding: 3.5rem 1.5rem;
            text-align: center;
        }

        .empty-state-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background-color: #f0f4fa;
            color: #1f3563;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
<div class="cert-report-wrapper">

    {{-- ==========================================================
         PAGE HERO HEADER
         ========================================================== --}}
    <div class="cert-hero">
        <div>
            <h1 class="cert-hero-title">
                <i class="bi bi-award-fill"></i>
                <span>تقرير الشهادات والقوائم الرسمية</span>
            </h1>
            <p class="cert-hero-desc">
                استعلام عن قوائم الطلاب حسب رقم الصفحة وتصدير ملفات Excel وطباعة وثائق الجمعية الحرفية الرسمية
            </p>
        </div>

        <button type="button" onclick="window.history.back();" class="btn btn-outline-light btn-sm px-3 rounded-pill d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-right"></i>
            <span>رجوع</span>
        </button>
    </div>

    {{-- ==========================================================
         FLASH ALERTS & ERRORS
         ========================================================== --}}
    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible fade show rounded-3 shadow-sm border-0 d-flex align-items-center gap-2" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>
                <strong>تنبيه: </strong>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ==========================================================
         SEARCH FORM CARD
         ========================================================== --}}
    <div class="modern-card">
        <div class="modern-card-header">
            <h2 class="modern-card-title">
                <i class="bi bi-search text-primary"></i>
                <span>بحث حسب رقم الصفحة</span>
            </h2>
        </div>

        <div class="p-3 p-md-4">
            <form action="{{ route('searchcertifications') }}" method="POST" role="search" autocomplete="off" class="row g-3 align-items-end">
                @csrf

                <div class="col-12 col-md-5">
                    <label for="page_number" class="form-label fw-semibold text-secondary small">
                        <i class="bi bi-hash text-primary me-1"></i>
                        رقم الصفحة <span class="text-danger">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0">
                            <i class="bi bi-journal-text"></i>
                        </span>
                        <input type="text"
                               name="page_number"
                               id="page_number"
                               class="form-control border-start-0"
                               value="{{ request('page_number') ?? ($page_number ?? '') }}"
                               placeholder="أدخل رقم الصفحة للبحث..."
                               required>
                    </div>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button class="btn btn-primary flex-grow-1 d-inline-flex align-items-center justify-content-center gap-2 rounded-3 shadow-sm" type="submit">
                        <i class="bi bi-search"></i>
                        <span>بحث واستخراج</span>
                    </button>

                    @if(request('page_number') || isset($page_number))
                        <a href="{{ url('certifications_Report') }}" class="btn btn-outline-secondary rounded-3" title="إعادة تعيين">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- ==========================================================
         COURSE INFO BANNER (When Available)
         ========================================================== --}}
    @if(isset($courseInfo) && $courseInfo)
        <div class="course-info-strip">
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <span class="info-pill">
                    <i class="bi bi-journal-bookmark-fill text-primary"></i>
                    الدورة: <strong>{{ $courseInfo->course_name ?? '—' }}</strong>
                </span>

                @if(!empty($courseInfo->department_name))
                    <span class="info-pill">
                        <i class="bi bi-grid-fill text-info"></i>
                        القسم: <strong>{{ $courseInfo->department_name }}</strong>
                    </span>
                @endif

                @if(!empty($courseInfo->days_of_course))
                    <span class="info-pill">
                        <i class="bi bi-calendar-week text-warning"></i>
                        الأيام: <strong>{{ $courseInfo->days_of_course }}</strong>
                    </span>
                @endif

                @if(!empty($courseInfo->start_date) || !empty($courseInfo->end_date))
                    <span class="info-pill">
                        <i class="bi bi-calendar-range text-success"></i>
                        الفترة: <strong>من {{ $courseInfo->start_date ?? '' }} إلى {{ $courseInfo->end_date ?? '' }}</strong>
                    </span>
                @endif
            </div>

            @if(!empty($page_number))
                <span class="badge bg-dark px-3 py-2 rounded-pill fs-6">
                    صفحة رقم: {{ $page_number }}
                </span>
            @endif
        </div>
    @endif

    {{-- ==========================================================
         STUDENTS REPORT TABLE & EXPORT ACTIONS
         ========================================================== --}}
    <div class="modern-card">
        <div class="modern-card-header">
            <div class="d-flex align-items-center gap-2">
                <h2 class="modern-card-title mb-0">
                    <i class="bi bi-people-fill text-success"></i>
                    <span>قائمة طلاب التقرير</span>
                </h2>
                @if(isset($students))
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill">
                        {{ count($students) }} طالب
                    </span>
                @endif
            </div>
        </div>

        <div class="table-responsive">
            @if (isset($students) && count($students) > 0)
                <table id="studentReport" class="display nowrap table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">المعرف</th>
                            <th scope="col">الرقم العام</th>
                            <th scope="col">الاسم الكامل</th>
                            <th scope="col">اسم الأب</th>
                            <th scope="col">اسم الأم</th>
                            <th scope="col">تاريخ الولادة</th>
                            <th scope="col">الجنسية</th>
                            <th scope="col">رقم الصفحة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td class="text-muted small">{{ $student->student_id }}</td>
                                <td class="fw-bold">{{ $student->general_number }}</td>
                                <td class="fw-semibold text-dark text-start px-3">{{ $student->fullname }}</td>
                                <td>{{ $student->fathername }}</td>
                                <td>{{ $student->mothername }}</td>
                                <td>{{ $student->date_of_birth }}</td>
                                <td>
                                    <span class="badge bg-light text-secondary border">
                                        {{ $student->nationality }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2">
                                        {{ $student->page_number }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @elseif(isset($students))
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-folder-x"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">لا توجد بيانات متاحة</h5>
                    <p class="text-muted mb-0">لم يتم العثور على أي طلاب مطابقين لرقم الصفحة المحدد.</p>
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-file-earmark-spreadsheet"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">يرجى البحث برقم الصفحة</h5>
                    <p class="text-muted mb-0">أدخل رقم الصفحة في نموذج البحث أعلاه لتوليد التقرير وعرض خيارات الطباعة والتصدير.</p>
                </div>
            @endif
        </div>
    </div>

</div>
@endsection

@section('js')
    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/datatable/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery-ui.min.js') }}"></script>

    <!-- DataTables JS -->
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>

    <!-- JSZip (Excel export) -->
    <script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>

    <!-- PDFMake (PDF export) -->
    <script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>

    <!-- Buttons for export to PDF and Excel -->
    <script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            if ($('.fc-datepicker').length) {
                $('.fc-datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
            }
            if ($("#datepicker").length) {
                $("#datepicker").datepicker();
            }
            if ($('.select2').length) {
                $('.select2').select2();
            }
        });

        function formatTo12Hour(time) {
            if (!time) return '';
            let [hours, minutes] = time.split(':');
            hours = parseInt(hours);
            let formattedHours = hours % 12 || 12;
            return String(formattedHours).padStart(2, '0') + ':' + minutes;
        }

        function getBranchName(courseName) {
            const halabouniKeywords = [
                'حلاقة نسائية', 'تجميل', 'احترافي', 'تخصصي', 'حلاقة نسائية', 'حلاقه نسائية', 'حلاقة نسائيه', 'حلاقه نسائيه',
                'تكنيك الوان الشعر', 'عناية بالبشرة', 'اكريليك', 'جل', 'عناية بشرة',
                'رموش تجميليه', 'خياطه', 'القيادة الاداريه', 'قيادة ادارية', 'سبورات',
                'ادارة الأعمال', 'قيادة إدارية', 'قيادة إدارية',
                'ادارة الاعمال', 'ادارة الأعمال', 'ادارة الاعمال',
                'ادارة الأعمال', 'ادارة الاعمال', 'ادارة الأعمال',
                ' احترافي', 'إحترافي', 'أحترافي',
                'تكنيك الوان الشعر', 'تكنيك ألوان الشعر', 'تكنيك الوان شعر',
                'عنايه بالبشره', 'عناية بالبشره',
                'اكريليك', 'أكريليك', 'إكريليك', 'اكريللك', 'أكريللك',
                'رموش تجميليه', 'رموش تجميلية', 'رموش تجميلى', 'رموش تجميلي',
                'رموش تجميله', 'رموش تجميلة', 'الرموش التجميليه', 'الرموش التجميلة',
                'سهرة وعرايسي', 'TOT'
            ];
            const courseText = courseName || '';
            const isHalabouni = halabouniKeywords.some(keyword => courseText.includes(keyword));
            return isHalabouni ? 'حلبوني' : 'فيكتوريا';
        }

        $('#studentReport').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: '<i class="bi bi-printer-fill me-1"></i> طباعة الوثيقة الرسمية',
                    title: '',
                    messageTop: '',
                    messageBottom: '',
                    customize: function (win) {
                        win.document.title = 'تقرير القوائم';

                        $(win.document.body).empty();
                        $(win.document.body).css('margin', '0');
                        $(win.document.body).css('padding', '0');
                        $(win.document.body).css('direction', 'rtl');
                        $(win.document.body).css('font-family', 'Tahoma, Arial, sans-serif');
                        $(win.document.body).css('font-size', '12px');
                        $(win.document.body).css('color', '#111');

                        // Data from PHP
                        var pageNumber     = '{{ $page_number ?? "" }}';
                        var year           = '{{ date("Y") }}';
                        var courseName     = '{{ $courseInfo->course_name ?? "" }}';
                        var courseDays     = '{{ $courseInfo->days_of_course ?? "" }}';
                        var startHour      = formatTo12Hour('{{ $courseInfo->start_hour ?? "" }}');
                        var endHour        = formatTo12Hour('{{ $courseInfo->end_hour ?? "" }}');
                        var branchName     = getBranchName(courseName);
                        var studentsData   = @json($students ?? []);
                        var departmentName = '{{ $courseInfo->department_name ?? "" }}';

                        // Header
                        $(win.document.body).prepend(`
                            <div style="text-align:center; margin-bottom:2px;">
                                <h2 style="margin:0; font-size:18px; font-weight:900; color:#1a1a2e;">مركز المأمون الدولي للتدريب على الحرف والمهن</h2>
                                <div style="height:2px; background:#1a1a2e; width:60%; margin:6px auto 0;"></div>
                            </div>
                            <div style="text-align:right; margin-bottom:2px; line-height:1.4;">
                                <p style="margin:0; font-weight:bold; font-size:12px;">الجمعية الحرفية لمراكز التدريب</p>
                                <p style="margin:0; font-weight:bold; font-size:12px;">المهني والحرفي بدمشق وريفها</p>
                            </div>
                            <div style="width:100%; overflow:hidden; margin-bottom:2px;">
                                <table style="width:18%; border-collapse:collapse; float:right; font-size:11px; background:#f4f6fa;">
                                     <tr>
                                        <td style="border:1px solid #333; padding:1px 3px; font-weight:bold; background:#e8edf5; font-size:11px; line-height:1.2;">الرقم</td>
                                        <td style="border:1px solid #333; padding:1px 3px; text-align:center; font-size:11px; line-height:1.2;">${pageNumber}</td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #333; padding:1px 3px; font-weight:bold; background:#e8edf5; font-size:11px; line-height:1.2;">السنة</td>
                                        <td style="border:1px solid #333; padding:1px 3px; text-align:center; font-size:11px; line-height:1.2;">${year}</td>
                                    </tr>
                                </table>
                                <div style="float:left; padding-top:3px;">
                                    <img src="{{ asset('images/logo.png') }}" style="width:100px;">
                                </div>
                            </div>
                            <div style="text-align:center; margin:0 0 0px 0; clear:both; line-height:1;">
                                <p style="margin:3px 0; font-weight:bold; font-size:14px; text-decoration:underline;">إلى رئيس الجمعية الحرفية</p>
                                <p style="margin:3px 0; font-weight:bold; font-size:14px;">نعلمكم بافتتاح دورة ${departmentName} (${courseName}) في مركزنا (${branchName})</p>
                                <p style="margin:3px 0; font-weight:bold; font-size:14px;">أيام الدورة (${courseDays})</p>
                                <p style="margin:3px 0; font-weight:bold; font-size:14px;">وقت الدورة من الساعة (${startHour}) إلى الساعة (${endHour})</p>
                            </div>
                        `);

                        // Create print table
                        var newTable = $('<table class="print-data-table" border="1" style="width:100%; border-collapse:collapse; font-size:13px;"></table>');
                        newTable.append(`
                            <thead>
                                <tr>
                                    <th style="padding:3px;">المدينة</th>
                                    <th style="padding:3px;">اسم المركز</th>
                                    <th style="padding:3px;">اسم الدورة</th>
                                    <th style="padding:3px;">الاسم والشهرة</th>
                                    <th style="padding:3px;">اسم الأب</th>
                                    <th style="padding:3px;">اسم الأم</th>
                                    <th style="padding:3px;">رقم الموبايل</th>
                                    <th style="padding:3px;">تاريخ الميلاد</th>
                                    <th style="padding:3px; min-width:80px;">الرقم الوطني</th>
                                    <th style="padding:3px;">الجنسية</th>
                                    <th style="padding:3px;">بداية الدورة</th>
                                    <th style="padding:3px;">نهاية الدورة</th>
                                    <th style="padding:3px;">هل الشهادة مطلوبة</th>
                                    <th style="padding:3px;">اسم المدرب</th>
                                    <th style="padding:3px;">الرقم العام</th>
                                </tr>
                            </thead>
                        `);

                        var tbody = $('<tbody></tbody>');
                        studentsData.forEach(function(student) {
                            var eligible = student.certificate_eligible ? 'نعم' : 'لا';
                            var fullname = (student.firstname || '') + ' ' + (student.lastname || '');
                            tbody.append(`
                                <tr>
                                    <td style="padding:3px;">دمشق</td>
                                    <td style="padding:3px;">مركز المأمون</td>
                                    <td style="padding:3px;">${courseName}</td>
                                    <td style="padding:3px;">${fullname}</td>
                                    <td style="padding:3px;">${student.fathername || ''}</td>
                                    <td style="padding:3px;">${student.mothername || ''}</td>
                                    <td style="padding:3px;">${student.mobile || ''}</td>
                                    <td style="padding:3px;">${student.date_of_birth || ''}</td>
                                    <td style="padding:3px; white-space:nowrap;">${student.national_number || ''}</td>
                                    <td style="padding:3px;">${student.nationality || ''}</td>
                                    <td style="padding:3px;">${student.start_date || ''}</td>
                                    <td style="padding:3px;">${student.end_date || ''}</td>
                                    <td style="padding:3px; font-weight:bold;">${eligible}</td>
                                    <td style="padding:3px;">${student.teacherfull || ''}</td>
                                    <td style="padding:3px;">${student.page_number || ''}</td>
                                </tr>
                            `);
                        });

                        newTable.append(tbody);
                        $(win.document.body).find('table.dataTable').remove();
                        $(win.document.body).append(newTable);

                        // Footer
                        newTable.after(`
                            <div style="margin-top:25px; width:100%; font-size:15px; display:flex; justify-content:space-between; direction:rtl; color:#000; padding:0 40px;">
                                <div style="text-align:right; font-weight:900;">قسم الشهادات</div>
                                <div style="text-align:center; font-weight:900; line-height:1.5;">
                                    المهندس مأمون الحلاق<br>
                                    <span style="font-weight:700; font-size:13px;">المدير العام لمركز المأمون الدولي</span>
                                </div>
                            </div>
                        `);

                        // Print styles
                        $(win.document.head).append(`
                            <style>
                                @page {
                                    size: A4 landscape;
                                    margin: 8mm;
                                }
                                @media print {
                                    body {
                                        margin: 0;
                                        padding: 5px;
                                        -webkit-print-color-adjust: exact;
                                        print-color-adjust: exact;
                                    }
                                    table {
                                        border-collapse: collapse;
                                        width: 100%;
                                    }
                                    .print-data-table thead th {
                                        background: #ffffff !important;
                                        color: #000 !important;
                                        border: 1px solid #1a1a2e !important;
                                        padding: 6px 3px !important;
                                        font-size: 11px !important;
                                        font-weight: 700 !important;
                                        text-align: center !important;
                                        -webkit-print-color-adjust: exact;
                                        print-color-adjust: exact;
                                    }
                                    .print-data-table tbody td {
                                        border: 1px solid #9aa3b3 !important;
                                        padding: 5px 3px !important;
                                        text-align: center !important;
                                        font-size: 11.5px !important;
                                        height: 22px;
                                    }
                                    .print-data-table tbody tr:nth-child(even) {
                                        background: #f8fafd !important;
                                        -webkit-print-color-adjust: exact;
                                        print-color-adjust: exact;
                                    }
                                    .print-data-table thead { display: table-header-group; }
                                    .print-data-table tr    { page-break-inside: avoid; }
                                }
                            </style>
                        `);

                        setTimeout(function () {
                            win.focus();
                            win.print();
                            win.close();
                        }, 50);
                    }
                },
                {
                    text: '<i class="bi bi-file-earmark-excel-fill me-1"></i> تصدير Excel',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {
                        let params = new URLSearchParams({
                            page_number: '{{ request('page_number') ?? ($page_number ?? '') }}',
                            start_at: '{{ request('start_at') }}',
                            end_at: '{{ request('end_at') }}',
                            teacher_name: '{{ request('teacher_name') }}',
                        });

                        window.location.href = "{{ route('certifications.export.excel') }}?" + params.toString();
                    }
                },
                {
                    text: '<i class="bi bi-file-earmark-spreadsheet me-1"></i> Excel (الصفحة الحالية)',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {
                        let params = new URLSearchParams({
                            page_number: '{{ request('page_number') ?? ($page_number ?? '') }}',
                            start_at: '{{ request('start_at') }}',
                            end_at: '{{ request('end_at') }}',
                            teacher_name: '{{ request('teacher_name') }}',
                        });

                        window.location.href = "{{ route('certifications.export.excel.page') }}?" + params.toString();
                    }
                },
                {
                    extend: 'copy',
                    text: '<i class="bi bi-clipboard me-1"></i> نسخ',
                    className: 'buttons-copy'
                }
            ],
            pageLength: 17,
            searching: false,
            ordering: false,
            scrollX: true,
            language: {
                emptyTable: "لا توجد بيانات متاحة في الجدول",
                info: "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
                infoEmpty: "إظهار 0 إلى 0 من أصل 0 مدخل",
                infoFiltered: "(تمت التصفية من _MAX_ إجمالي المدخلات)",
                lengthMenu: "إظهار _MENU_ مدخلات",
                loadingRecords: "جارٍ التحميل...",
                processing: "جارٍ المعالجة...",
                zeroRecords: "لم يتم العثور على أية سجلات مطابقة",
                paginate: {
                    first: "الأولى",
                    last: "الأخيرة",
                    next: "التالية",
                    previous: "السابقة"
                }
            }
        });
    </script>
@endsection
