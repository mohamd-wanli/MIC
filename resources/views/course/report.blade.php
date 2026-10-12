@extends('layouts.master')

@section('title', 'تقرير مجموعات')

@section('css')
<style>
    /* ============================================
       MODERN GROUP REPORT STYLES
       ============================================ */

    /* Page Header */
    .page-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        border-radius: 16px 16px 0 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }

    .page-header-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .page-header-modern::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }

    .page-header-modern h3 {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.6rem;
        margin: 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header-modern p {
        color: rgba(255, 255, 255, 0.85);
        margin: 5px 0 0 0;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    /* Main Card */
    .main-card-modern {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f7;
    }

    /* Search Section */
    .search-section-modern {
        background: #f8faff;
        padding: 25px;
        border-bottom: 1px solid #eef2f7;
    }

    .search-section-modern .input-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
    }

    .search-section-modern .form-control {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 10px 20px !important;
        font-size: 0.95rem !important;
        height: 48px !important;
        flex: 1;
        min-width: 200px;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
    }

    .search-section-modern .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .search-section-modern .form-control::placeholder {
        color: #adb5bd;
        font-size: 0.9rem;
    }

    .btn-search-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border: none;
        padding: 10px 35px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 48px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn-search-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
        color: #ffffff;
    }

    .btn-search-modern:active {
        transform: translateY(0);
    }

    /* Report Container */
    .report-container-modern {
        padding: 25px;
    }

    /* Table Container - Hide scrollbar in print */
    .table-container-modern {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #eef2f7;
    }

    /* Modern Table */
    .table-modern {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
        font-size: 0.85rem;
        margin-bottom: 0;
    }

    .table-modern thead {
        background: #1a1a2e;
    }

    .table-modern thead th {
        color: #ffffff !important;
        font-weight: 600;
        padding: 12px 15px;
        text-align: center;
        border: none;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        background: #1a1a2e !important;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .table-modern tbody tr {
        border-bottom: 1px solid #f1f3f8;
        transition: all 0.2s ease;
        background: #ffffff;
    }

    .table-modern tbody tr:hover {
        background: #f8faff;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody td {
        padding: 10px 12px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
        font-size: 0.82rem;
        border-bottom: 1px solid #f1f3f8;
    }

    /* Row Number */
    .table-modern tbody td:first-child {
        font-weight: 700;
        color: #667eea;
        font-size: 0.9rem;
    }

    /* Certificate Number */
    .cert-number {
        font-weight: 700;
        color: #667eea;
        font-family: monospace;
        font-size: 0.9rem;
    }

    /* Status Badge */
    .status-badge {
        padding: 3px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.7rem;
        display: inline-block;
    }

    .status-badge.success {
        background: #d4edda;
        color: #155724;
    }

    /* Print Button */
    .btn-print-modern {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
        border: none;
        padding: 12px 40px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.35);
        margin-top: 20px;
    }

    .btn-print-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(17, 153, 142, 0.45);
        color: #ffffff;
    }

    /* Alert Styles */
    .alert-modern {
        border-radius: 12px !important;
        padding: 16px 20px !important;
        border: none !important;
        font-weight: 500 !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06) !important;
        margin-bottom: 25px !important;
    }

    .alert-modern i {
        font-size: 1.3rem !important;
    }

    .alert-modern.alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb) !important;
        color: #721c24 !important;
        border-right: 4px solid #dc3545 !important;
    }

    .alert-modern .btn-close {
        filter: none !important;
    }

    /* Empty State */
    .empty-state-modern {
        padding: 60px 20px;
        text-align: center;
    }

    .empty-state-modern i {
        font-size: 3.5rem;
        color: #e8edf5;
        margin-bottom: 15px;
        display: block;
    }

    .empty-state-modern h5 {
        color: #2d3436;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .empty-state-modern p {
        color: #adb5bd;
        font-size: 0.9rem;
    }

    /* ==========================================
       PRINT STYLES
       ========================================== */
    .print-header,
    .print-report-text,
    .print-footer {
        display: none;
    }

   @media print {

    @page {
        size: A4;
        margin: 0;
    }

    html, body {
        margin: 0 !important;
        padding: 0 !important;
    }

    /* Hide everything except print area */
    body * {
        visibility: hidden;
    }

    #print-area,
    #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        padding: 15mm;
        background: #ffffff;
        box-sizing: border-box;
    }


        /* Hide scrollbar container and overflow */
        .table-container-modern {
            overflow: visible !important;
            border: none !important;
            border-radius: 0 !important;
        }

        /* Hide scrollbar in print */
        .table-container-modern::-webkit-scrollbar {
            display: none !important;
            width: 0 !important;
            height: 0 !important;
        }

        /* Table styles for print */
        .table-modern {
            min-width: auto !important;
            width: 100% !important;
            font-size: 11px !important;
            border-collapse: collapse !important;
        }

        .table-modern thead th {
            background: #f2f2f2 !important;
            color: #000000 !important;
            font-size: 10px !important;
            padding: 6px 8px !important;
            border: 1px solid #000 !important;
            text-transform: none !important;
        }

        .table-modern tbody td {
            padding: 5px 8px !important;
            font-size: 10px !important;
            border: 1px solid #000 !important;
            color: #000000 !important;
        }

        .table-modern tbody tr {
            border: 1px solid #000 !important;
        }

        .table-modern tbody tr:nth-child(25n) {
            page-break-after: always;
            break-after: page;
        }

        /* Show print elements */
        .print-header,
        .print-report-text,
        .print-footer {
            display: block !important;
        }

        /* ===== الترويسة ===== */
        .print-header {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 15px;
            direction: ltr;
        }

        .print-logo {
            width: 150px;
            margin-left: 20px;
        }

        .print-right {
            text-align: right;
            direction: rtl;
            font-size: 16px;
            line-height: 1.8;
        }

        .print-right .title {
            font-size: 18px;
            font-weight: bold;
        }

        .print-right .number {
            font-size: 16px;
        }

        /* ===== نص التقرير ===== */
        .print-report-text {
            display: block !important;
            direction: rtl;
            text-align: center;
            line-height: 1.8;
            margin-bottom: 5px;
        }

        .print-report-text h1 {
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 6px 0;
            line-height: 1.6;
        }

        .print-report-text p {
            margin: 0 0 8px 0;
            font-weight: bold;
        }

        /* ===== تذييل ===== */
        .print-footer {
            display: block !important;
            margin-top: 40px;
            direction: rtl;
            text-align: right;
            font-size: 16px;
            line-height: 2;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .footer-box {
            width: 40%;
            text-align: center;
        }

        /* Hide modern elements in print */
        .btn-print-modern,
        .btn-search-modern,
        .search-section-modern,
        .page-header-modern,
        .alert-modern {
            display: none !important;
        }

        /* Reset certificate number color for print */
        .cert-number {
            color: #000000 !important;
        }

        .status-badge {
            background: transparent !important;
            color: #000000 !important;
            padding: 0 !important;
        }
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-header-modern {
            padding: 20px;
        }
        .page-header-modern h3 {
            font-size: 1.3rem;
        }
        .search-section-modern {
            padding: 20px;
        }
        .search-section-modern .form-control {
            min-width: 150px;
            height: 42px !important;
            font-size: 0.85rem !important;
        }
        .btn-search-modern {
            height: 42px !important;
            padding: 8px 25px !important;
            font-size: 0.85rem !important;
        }
        .report-container-modern {
            padding: 15px;
        }
        .table-modern {
            min-width: 900px;
            font-size: 0.8rem;
        }
        .table-modern thead th {
            font-size: 0.7rem;
            padding: 10px 10px;
        }
        .table-modern tbody td {
            padding: 8px 10px;
            font-size: 0.78rem;
        }
    }

    @media (max-width: 767px) {
        .search-section-modern .input-group {
            flex-direction: column;
        }
        .search-section-modern .form-control {
            width: 100%;
            min-width: auto;
        }
        .btn-search-modern {
            width: 100%;
            justify-content: center;
        }
        .table-modern {
            min-width: 800px;
            font-size: 0.75rem;
        }
        .table-modern thead th {
            font-size: 0.65rem;
            padding: 8px 8px;
        }
        .table-modern tbody td {
            padding: 6px 8px;
            font-size: 0.72rem;
        }
        .btn-print-modern {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .table-modern {
            min-width: 700px;
            font-size: 0.7rem;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 6px;
        }
        .table-modern tbody td {
            padding: 5px 6px;
            font-size: 0.65rem;
        }
    }
    /* Excel Button */
.btn-excel-modern {
    background: linear-gradient(135deg, #107e3e, #21a95c);
    color: #ffffff;
    border: none;
    padding: 12px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(16, 126, 62, 0.35);
    margin-top: 20px;
}

.btn-excel-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(16, 126, 62, 0.45);
    color: #ffffff;
}

@media print {
    .btn-excel-modern { display: none !important; }
}
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    @if (session('error'))
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Card -->
    <div class="main-card-modern">

        <!-- Page Header -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3>
                        <i class="fas fa-users"></i>
                        تقرير مجموعات
                    </h3>
                    <p><i class="fas fa-info-circle"></i> أدخل رقم المجموعة لعرض تقرير شامل بالطلاب المسجلين</p>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <span style="color: rgba(255,255,255,0.8); font-size: 0.85rem;">
                        <i class="fas fa-print"></i> قابل للطباعة
                    </span>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section-modern">
            <form method="GET" action="{{ route('group.report') }}" id="searchForm">
                <div class="input-group">
                    <input
                        type="text"
                        name="group_number"
                        class="form-control"
                        placeholder="أدخل رقم المجموعة للبحث..."
                        required
                        value="{{ request('group_number') }}"
                        autofocus
                    >
                    <button type="submit" class="btn-search-modern">
                        <i class="fas fa-search"></i>
                        بحث
                    </button>
                </div>
            </form>
        </div>

        <!-- Report Content -->
        @if (isset($students) && $students->isNotEmpty())

            <div class="report-container-modern" id="print-area">

                <!-- ===== PRINT HEADER ===== -->
                <div class="print-header">
                    <img src="{{ asset('images/logo.png') }}" class="print-logo" alt="Logo">
                    <div class="print-right">
                        <div class="title">مركز المأمون الدولي</div>
                        <div class="number">الرقم : <span style="font-weight: bold;">{{ request('group_number') ?? '—' }}</span></div>
                    </div>
                </div>

                <!-- ===== PRINT REPORT TEXT ===== -->
                <div class="print-report-text">
                    <h1>الاتحاد العام للحرفيين ع/ط الجمعية الحرفية</h1>
                    <h1>لمراكز التدريب المهني والحرفي بدمشق وريفها</h1>
                    <p>
                        بناءً على طلبكم نرسل لكم قائمة بأسماء الطلاب الذين اتبعوا دورات
                        ويرغبون بالحصول على شهادات بقوائم مدمجة، علماً بأننا وافيناكم
                        بصورة عن القوائم بشكل متفرق مسبقاً.
                    </p>
                    {{-- <p style="font-weight: bold; font-size: 16px; color: #667eea;">
                        رقم المجموعة: {{ request('group_number') }}
                    </p> --}}
                </div>

                <!-- ===== TABLE ===== -->
                <div class="table-container-modern">
                    <table class="table-modern" id="reportTable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">م</th>
                                <th>الاسم الثلاثي</th>
                                <th>محل وتاريخ الولادة</th>
                                <th>الرقم الوطني</th>
                                <th>اسم الدورة</th>
                                <th>تاريخ البداية</th>
                                <th>تاريخ النهاية</th>
                                <th>اسم المدرب</th>
                                <th style="width: 8%;">رقم الشهادة</th>
                                <th>رقم الصفحة</th>
                                <th>الملاحظة</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $index => $student)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $student->fullname }}</strong></td>
                                    <td>{{ $student->date_of_birth ?? '—' }}</td>
                                    <td>
                                        @if($student->national_number)
                                            <span style="font-family: monospace; font-weight: 600; color: #667eea;">
                                                {{ $student->national_number }}
                                            </span>
                                        @else
                                            <span style="color: #adb5bd;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span style="background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1)); padding: 3px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; color: #667eea;">
                                            {{ $student->subject_name ?? '—' }}
                                        </span>
                                    </td>
                                    <td>{{ $student->start_date ?? '—' }}</td>
                                    <td>{{ $student->end_date ?? '—' }}</td>
                                    <td>{{ $student->teacherName ?? '—' }}</td>
                                    <td>
                                        @if($student->certificate_number)
                                            <span class="cert-number">{{ $student->certificate_number }}</span>
                                        @else
                                            <span style="color: #adb5bd;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->page_number)
                                            <span class="status-badge success">
                                                <i class="fas fa-file-alt"></i>
                                                {{ $student->page_number }}
                                            </span>
                                        @else
                                            <span style="color: #adb5bd;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($student->notes)
                                            <span style="font-size: 0.75rem; color: #6c757d;">{{ $student->notes }}</span>
                                        @else
                                            <span style="color: #adb5bd;">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- ===== PRINT FOOTER ===== -->
                <div class="print-footer">
                    <div class="footer-row">
                        <div class="footer-box">
                            <strong>قسم الشهادات</strong>
                            <br><br>
                        </div>
                        <div class="footer-box" style="text-align:center; font-weight:bold;">
                            المهندس مأمون الحلاق<br>
                            المدير العام لمركز المأمون الدولي
                            <br><br>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Print Button -->
            <div style="padding: 0 25px 25px 25px;">
                <button class="btn-print-modern" onclick="window.print()">
                    <i class="fas fa-print"></i>
                    طباعة التقرير
                </button>
           <a href="{{ route('group.report.export', ['group_number' => request('group_number')]) }}"
       class="btn-excel-modern">
        <i class="fas fa-file-excel"></i>
        تصدير Excel
    </a>
                <span style="color: #6c757d; font-size: 0.85rem; margin-right: 15px;">
                    <i class="fas fa-info-circle"></i>
                    عدد الطلاب: <strong>{{ $students->count() }}</strong>
                </span>
            </div>

        @elseif(isset($students))
            <!-- Empty State -->
            <div class="report-container-modern">
                <div class="empty-state-modern">
                    <i class="fas fa-search"></i>
                    <h5>لا توجد نتائج</h5>
                    <p>لا توجد طلاب مسجلين برقم المجموعة <strong style="color: #667eea;">{{ request('group_number') }}</strong></p>
                    <button class="btn-search-modern" onclick="document.getElementById('searchForm').querySelector('input').focus();" style="margin-top: 15px; padding: 8px 25px; font-size: 0.85rem; height: auto;">
                        <i class="fas fa-arrow-left"></i>
                        بحث جديد
                    </button>
                </div>
            </div>
        @else
            <!-- Initial Empty State -->
            <div class="report-container-modern">
                <div class="empty-state-modern">
                    <i class="fas fa-users"></i>
                    <h5>أدخل رقم المجموعة</h5>
                    <p>قم بإدخال رقم المجموعة في حقل البحث أعلاه لعرض التقرير</p>
                </div>
            </div>
        @endif

    </div>

</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit on Enter key
        document.getElementById('searchForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.submit();
            }
        });

        // Print handling
        window.onbeforeprint = function() {
            // Any pre-print preparation
        };

        window.onafterprint = function() {
            // Any post-print cleanup
        };
    });
</script>
@endsection
