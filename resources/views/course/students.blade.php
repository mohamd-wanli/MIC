@extends('layouts.master')

@section('title', 'البحث برقم الصفحة والشهادات')

@section('css')
<style>
    /* ============================================================
       Modern Styling for Page Search & Certificate Data Management
       ============================================================ */
    .cert-page-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        padding-bottom: 2rem;
    }

    /* Page Header */
    .cert-header-card {
        background: linear-gradient(135deg, #122140 0%, #1f3563 100%);
        border: none;
        border-radius: 16px;
        color: #ffffff;
        padding: 1.5rem 1.75rem;
        box-shadow: 0 10px 25px rgba(18, 33, 64, 0.12);
        position: relative;
        overflow: hidden;
    }

    .cert-header-card::before {
        content: '';
        position: absolute;
        top: -40%;
        left: -10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(185, 135, 60, 0.25) 0%, transparent 70%);
        pointer-events: none;
    }

    .cert-header-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .cert-header-title i {
        color: #e7d2a6;
    }

    .cert-header-subtitle {
        color: rgba(255, 255, 255, 0.75);
        font-size: 0.875rem;
        margin-top: 0.35rem;
        margin-bottom: 0;
    }

    /* Modern Cards */
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
        font-size: 1rem;
        font-weight: 700;
        color: #122140;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Table & Container */
    .cert-table-container {
        max-height: 560px;
        overflow-y: auto;
        border-radius: 0 0 14px 14px;
    }

    .cert-table {
        white-space: nowrap;
        margin-bottom: 0;
        font-size: 0.88rem;
    }

    .cert-table thead {
        position: sticky;
        top: 0;
        background: #122140;
        color: #ffffff;
        z-index: 3;
    }

    .cert-table thead th {
        font-weight: 600;
        font-size: 0.82rem;
        padding: 0.85rem 0.65rem;
        text-align: center;
        vertical-align: middle;
        border: none;
        letter-spacing: 0.2px;
    }

    .cert-table tbody td {
        padding: 0.65rem 0.65rem;
        text-align: center;
        vertical-align: middle;
        border-color: #f1f4f8;
    }

    .cert-table tbody tr:hover {
        background-color: #f7f9fd !important;
    }

    /* Table Input Fields */
    .table-input {
        width: 105px;
        text-align: center;
        font-size: 0.82rem;
        padding: 0.35rem 0.5rem;
        border: 1.5px solid #dce2eb;
        border-radius: 8px;
        transition: all 0.2s ease;
        background-color: #ffffff;
    }

    .table-input:focus {
        border-color: #1f3563;
        box-shadow: 0 0 0 3px rgba(31, 53, 99, 0.12);
        background-color: #fdfdfd;
        outline: none;
    }

    /* Status Badges */
    .badge-status {
        padding: 0.4rem 0.75rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
    }

    .badge-status-requested {
        background-color: #e6f9ed;
        color: #107e3e;
        border: 1px solid #b7edd0;
    }

    .badge-status-pending {
        background-color: #fff8e6;
        color: #9a6503;
        border: 1px solid #fde7b3;
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

    /* Action bar */
    .action-bar {
        background: #fafbfe;
        border-top: 1px solid #eef1f6;
        padding: 0.9rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
</style>
@endsection

@section('content')
<div class="cert-page-wrapper">

    {{-- ==========================================================
         PAGE HEADER
         ========================================================== --}}
    <div class="cert-header-card d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div>
            <h1 class="cert-header-title">
                <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                <span>البحث برقم الصفحة وإدارة الشهادات</span>
            </h1>
            <p class="cert-header-subtitle">
                عرض الطلاب المسجلين بالصفحة، وتحديث أرقام الشهادات والمجموعات وتواريخ الإدخال دفعة واحدة
            </p>
        </div>

        <button type="button" onclick="window.history.back();" class="btn btn-outline-light btn-sm px-3 rounded-pill d-inline-flex align-items-center gap-2">
            <i class="bi bi-arrow-right"></i>
            <span>عودة</span>
        </button>
    </div>

    {{-- ==========================================================
         FLASH ALERTS (Consolidated & Dismissible)
         ========================================================== --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm border-0" role="alert">
            <i class="bi bi-check-circle-fill fs-5"></i>
            <div>{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm border-0" role="alert">
            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
            <div>{{ session('error') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('delete'))
        <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center gap-2 rounded-3 shadow-sm border-0" role="alert">
            <i class="bi bi-info-circle-fill fs-5"></i>
            <div>{{ session('delete') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ==========================================================
         SEARCH & FILTER FORM
         ========================================================== --}}
    <div class="modern-card">
        <div class="modern-card-header">
            <h2 class="modern-card-title">
                <i class="bi bi-funnel-fill text-primary"></i>
                <span>معايير البحث</span>
            </h2>
        </div>

        <div class="p-3 p-md-4">
            <form method="GET" action="{{ route('students.search') }}" class="row g-3 align-items-end">
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
                               placeholder="أدخل رقم الصفحة..."
                               value="{{ request('page_number') }}"
                               required>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <label for="year" class="form-label fw-semibold text-secondary small">
                        <i class="bi bi-calendar3 text-primary me-1"></i>
                        السنة
                    </label>
                    <select name="year" id="year" class="form-select">
                        <option value="">جميع السنوات</option>
                        @if (isset($availableYears))
                            @foreach ($availableYears as $availableYear)
                                <option value="{{ $availableYear }}" {{ request('year') == $availableYear ? 'selected' : '' }}>
                                    {{ $availableYear }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                </div>

                <div class="col-12 col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 d-inline-flex align-items-center justify-content-center gap-2 rounded-3">
                        <i class="bi bi-search"></i>
                        <span>بحث</span>
                    </button>

                    @if (request()->has('page_number') || request()->has('year'))
                        <a href="{{ route('students.search') }}" class="btn btn-outline-secondary rounded-3" title="إعادة تعيين">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- ==========================================================
         RESULTS & CERTIFICATE DATA FORM
         ========================================================== --}}
    @if (request()->has('page_number') || request()->has('year'))
        @if (isset($students) && $students->isEmpty())
            {{-- Empty Results State --}}
            <div class="modern-card">
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="bi bi-search"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">لم يتم العثور على أي نتائج</h5>
                    <p class="text-muted mb-0">
                        لا يوجد طلاب مسجلون برقم الصفحة <strong class="text-dark">"{{ request('page_number') }}"</strong>
                        @if (request('year')) للسنة <strong class="text-dark">{{ request('year') }}</strong>@endif.
                    </p>
                </div>
            </div>
        @elseif (isset($students))
            {{-- Results Table & Bulk Update Form --}}
            <div class="modern-card">
                <form action="{{ route('saveCertificateData') }}" method="POST">
                    @csrf

                    <div class="modern-card-header">
                        <div class="d-flex align-items-center gap-2">
                            <h2 class="modern-card-title mb-0">
                                <i class="bi bi-people-fill text-success"></i>
                                <span>قائمة الطلاب</span>
                            </h2>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1 rounded-pill">
                                {{ $students->count() }} طالب
                            </span>
                        </div>

                        <button type="submit" class="btn btn-success btn-sm px-3 rounded-pill d-inline-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-check2-all"></i>
                            <span>حفظ جميع البيانات</span>
                        </button>
                    </div>

                    <div class="cert-table-container">
                        <table class="table cert-table table-hover table-bordered align-middle">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>اسم الطالب</th>
                                    <th>اسم الأب</th>
                                    <th>اسم الأم</th>
                                    <th>المواليد</th>
                                    <th>الجنسية</th>
                                    <th>الدورة</th>
                                    <th>تاريخ البداية</th>
                                    <th>تاريخ النهاية</th>
                                    <th style="background-color: #0f1c35;">رقم الشهادة</th>
                                    <th style="background-color: #0f1c35;">رقم المجموعة</th>
                                    <th style="background-color: #0f1c35;">تاريخ الإدخال</th>
                                    <th>حالة الطلب</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td class="text-muted fw-bold">{{ $student->general_number }}</td>
                                        <td class="fw-semibold text-dark text-start px-3">{{ $student->fullname }}</td>
                                        <td>{{ $student->fathername }}</td>
                                        <td>{{ $student->mothername }}</td>
                                        <td>{{ $student->date_of_birth }}</td>
                                        <td>{{ $student->nationality }}</td>
                                        <td>
                                            <span class="badge bg-light text-dark border">
                                                {{ $student->course_name }}
                                            </span>
                                        </td>
                                        <td class="text-muted small">{{ $student->course_start_date }}</td>
                                        <td class="text-muted small">{{ $student->course_end_date }}</td>

                                        {{-- Input Fields for Bulk Update --}}
                                        <td class="bg-light-subtle">
                                            <input type="text"
                                                   name="certificate_number[{{ $student->id }}]"
                                                   class="table-input"
                                                   placeholder="الشهادة"
                                                   value="{{ old('certificate_number.' . $student->id, $student->certificate_number ?? '') }}">
                                        </td>

                                        <td class="bg-light-subtle">
                                            <input type="text"
                                                   name="group_number[{{ $student->id }}]"
                                                   class="table-input"
                                                   placeholder="المجموعة"
                                                   value="{{ old('group_number.' . $student->id, $student->group_number ?? '') }}">
                                        </td>

                                        <td class="bg-light-subtle">
                                            <input type="text"
                                                   name="input_date[{{ $student->id }}]"
                                                   class="table-input"
                                                   placeholder="التاريخ"
                                                   value="{{ old('input_date.' . $student->id, $student->input_date ?? '') }}">
                                        </td>

                                        {{-- Request Status Badge --}}
                                        <td>
                                            @if (str_contains($student->request_status, '✅'))
                                                <span class="badge-status badge-status-requested" title="تم إنشاء طلب شهادة">
                                                    <i class="bi bi-check-circle-fill"></i>
                                                    <span>تم الطلب</span>
                                                </span>
                                            @else
                                                <span class="badge-status badge-status-pending" title="لم يتم طلب شهادة بعد">
                                                    <i class="bi bi-hourglass-split"></i>
                                                    <span>قيد الانتظار</span>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="action-bar">
                        <div class="text-muted small">
                            <i class="bi bi-info-circle me-1"></i>
                            سيتم تطبيق التعديلات على جميع الحقول المعدلة عند النقر على حفظ.
                        </div>

                        <button type="submit" class="btn btn-success px-4 rounded-3 d-inline-flex align-items-center gap-2 shadow-sm">
                            <i class="bi bi-save2-fill"></i>
                            <span>حفظ جميع البيانات</span>
                        </button>
                    </div>
                </form>
            </div>
        @endif
    @else
        {{-- Initial Helpful State --}}
        <div class="modern-card">
            <div class="empty-state">
                <div class="empty-state-icon" style="background-color: #f6f8fb; color: #837d6e;">
                    <i class="bi bi-file-earmark-arrow-up"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1">يرجى تحديد رقم الصفحة للبدء</h5>
                <p class="text-muted mb-0">أدخل رقم الصفحة من نموذج البحث أعلاه لعرض قائمة الطلاب وإدخال بيانات الشهادات والمجموعات.</p>
            </div>
        </div>
    @endif

</div>
@endsection
