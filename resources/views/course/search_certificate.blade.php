@extends('layouts.master')

@section('title', 'البحث برقم الشهادة')

@section('css')
<style>
    /* ============================================
       CERTIFICATE SEARCH STYLES
       ============================================ */

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

    .search-section-modern .form-group {
        margin-bottom: 0;
    }

    .search-section-modern label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.95rem;
        margin-bottom: 8px;
        display: block;
    }

    .search-section-modern label i {
        color: #667eea;
        margin-left: 8px;
    }

    .search-section-modern .form-control {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 10px 18px !important;
        font-size: 0.95rem !important;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
        height: 48px !important;
        box-shadow: none !important;
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

    .search-section-modern .search-group {
        display: flex;
        gap: 12px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .search-section-modern .search-group .form-group {
        flex: 1;
        min-width: 250px;
    }

    .btn-search-modern {
        background: linear-gradient(135deg, #11998e, #38ef7d);
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
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
        white-space: nowrap;
    }

    .btn-search-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(17, 153, 142, 0.4);
        color: #ffffff;
    }

    .btn-search-modern:active {
        transform: translateY(0);
    }

    .btn-back-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        text-decoration: none;
    }

    .btn-back-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(102, 126, 234, 0.4);
        color: #ffffff;
        text-decoration: none;
    }

    /* Results Container */
    .results-container-modern {
        padding: 25px;
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #eef2f7;
    }

    .results-header h4 {
        font-weight: 700;
        color: #2d3436;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .results-header h4 .cert-number {
        color: #667eea;
        font-family: monospace;
        font-size: 1.2rem;
    }

    .results-header .count-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        color: #667eea;
        padding: 4px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Modern Table */
    .table-container-modern {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #eef2f7;
    }

    .table-modern {
        width: 100%;
        min-width: 800px;
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
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
        background: #1a1a2e !important;
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
        padding: 10px 15px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
        font-size: 0.85rem;
    }

    /* Student Name Cell */
    .student-name-cell {
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .student-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    /* Certificate Badge */
    .cert-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        color: #667eea;
        font-family: monospace;
    }

    .cert-badge i {
        font-size: 0.7rem;
    }

    /* Page Badge */
    .page-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 12px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        background: #d4edda;
        color: #155724;
    }

    .page-badge i {
        font-size: 0.65rem;
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

    /* Initial State */
    .initial-state-modern {
        padding: 60px 20px;
        text-align: center;
    }

    .initial-state-modern i {
        font-size: 4rem;
        color: #e8edf5;
        margin-bottom: 15px;
        display: block;
    }

    .initial-state-modern h5 {
        color: #2d3436;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .initial-state-modern p {
        color: #adb5bd;
        font-size: 0.9rem;
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
            height: 42px !important;
            font-size: 0.9rem !important;
        }
        .btn-search-modern {
            height: 42px !important;
            font-size: 0.9rem !important;
            padding: 8px 25px !important;
        }
        .btn-back-modern {
            padding: 8px 20px;
            font-size: 0.85rem;
        }
        .results-container-modern {
            padding: 15px;
        }
        .table-modern {
            font-size: 0.8rem;
            min-width: 700px;
        }
        .table-modern thead th {
            font-size: 0.7rem;
            padding: 10px 10px;
        }
        .table-modern tbody td {
            padding: 10px 10px;
            font-size: 0.8rem;
        }
    }

    @media (max-width: 767px) {
        .search-section-modern .search-group {
            flex-direction: column;
            align-items: stretch;
        }
        .search-section-modern .search-group .form-group {
            min-width: auto;
        }
        .btn-search-modern {
            width: 100%;
            justify-content: center;
        }
        .results-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .table-modern {
            min-width: 600px;
            font-size: 0.75rem;
        }
        .table-modern thead th {
            font-size: 0.65rem;
            padding: 8px 8px;
        }
        .table-modern tbody td {
            padding: 8px 8px;
            font-size: 0.75rem;
        }
        .student-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.6rem;
        }
        .btn-back-modern {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .table-modern {
            min-width: 500px;
            font-size: 0.7rem;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 6px;
        }
        .table-modern tbody td {
            padding: 6px 6px;
            font-size: 0.7rem;
        }
        .cert-badge {
            font-size: 0.7rem;
            padding: 2px 10px;
        }
        .page-badge {
            font-size: 0.65rem;
            padding: 2px 10px;
        }
        .student-avatar {
            width: 24px;
            height: 24px;
            font-size: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Main Card -->
    <div class="main-card-modern">

        <!-- Page Header -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h3>
                        <i class="fas fa-certificate"></i>
                        البحث برقم الشهادة
                    </h3>
                    <p><i class="fas fa-info-circle"></i> أدخل رقم الشهادة للبحث عن الطالب المرتبط بها</p>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <a href="javascript:void(0);" onclick="window.history.back();" class="btn-back-modern">
                        <i class="fas fa-arrow-right"></i>
                        عودة
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section-modern">
            <form method="GET" action="{{ route('courses.searchPage', $courseId ?? 0) }}">
                <div class="search-group">
                    <div class="form-group">
                        <label for="certificate_number">
                            <i class="fas fa-search"></i>
                            رقم الشهادة
                        </label>
                        <input type="text"
                               name="certificate_number"
                               id="certificate_number"
                               class="form-control"
                               value="{{ request('certificate_number') }}"
                               placeholder="أدخل رقم الشهادة للبحث..."
                               autofocus>
                    </div>
                    <button type="submit" class="btn-search-modern">
                        <i class="fas fa-search"></i>
                        بحث
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="results-container-modern">

            @if (isset($certificateNumber) && $certificateNumber)

                @if ($results->isEmpty())
                    <!-- No Results -->
                    <div class="empty-state-modern">
                        <i class="fas fa-search"></i>
                        <h5>لا توجد نتائج مطابقة</h5>
                        <p>لم يتم العثور على أي طالب برقم الشهادة <strong style="color: #667eea;">{{ $certificateNumber }}</strong></p>
                        <button class="btn-search-modern" onclick="document.getElementById('certificate_number').focus();" style="margin-top: 15px; padding: 8px 25px; font-size: 0.85rem; height: auto;">
                            <i class="fas fa-arrow-left"></i>
                            بحث جديد
                        </button>
                    </div>
                @else
                    <!-- Results Found -->
                    <div class="results-header">
                        <h4>
                            <i class="fas fa-certificate" style="color: #667eea;"></i>
                            نتائج البحث لرقم الشهادة:
                            <span class="cert-number">{{ $certificateNumber }}</span>
                        </h4>
                        <span class="count-badge">
                            <i class="fas fa-user-graduate"></i>
                            عدد النتائج: {{ $results->count() }}
                        </span>
                    </div>

                    <div class="table-container-modern">
                        <table class="table-modern">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>الاسم والشهرة</th>
                                    <th>اسم الأب</th>
                                    <th>نوع الدورة</th>
                                    <th>تاريخ البداية</th>
                                    <th>تاريخ النهاية</th>
                                    <th>رقم الشهادة</th>
                                    <th>رقم الصفحة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $index => $result)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <div class="student-name-cell">
                                                <span class="student-avatar">
                                                    {{ mb_substr($result->fullname, 0, 1) }}
                                                </span>
                                                <span style="font-weight: 600;">{{ $result->fullname }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $result->fathername }}</td>
                                        <td>
                                            @php
                                                $subject = \App\Models\Subject::find($result->subject_id);
                                            @endphp
                                            <span style="background: linear-gradient(135deg, rgba(102,126,234,0.1), rgba(118,75,162,0.1)); padding: 3px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 600; color: #667eea;">
                                                {{ $subject->name ?? $result->subject_id }}
                                            </span>
                                        </td>
                                        <td>{{ $result->start_date ?? '—' }}</td>
                                        <td>{{ $result->end_date ?? '—' }}</td>
                                        <td>
                                            <span class="cert-badge">
                                                <i class="fas fa-certificate"></i>
                                                {{ $result->certificate_number }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($result->page_number)
                                                <span class="page-badge">
                                                    <i class="fas fa-file-alt"></i>
                                                    {{ $result->page_number }}
                                                </span>
                                            @else
                                                <span style="color: #adb5bd;">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            @else
                <!-- Initial State -->
                <div class="initial-state-modern">
                    <i class="fas fa-certificate"></i>
                    <h5>ابحث عن طالب برقم الشهادة</h5>
                    <p>قم بإدخال رقم الشهادة في حقل البحث أعلاه لعرض معلومات الطالب المرتبط بها</p>
                </div>
            @endif

        </div>

    </div>

</div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus on search input if there's a certificate number
        @if(!request('certificate_number'))
            document.getElementById('certificate_number').focus();
        @endif

        // Auto-submit on Enter key (already handled by form)
        // Auto-select all text on focus
        document.getElementById('certificate_number').addEventListener('focus', function() {
            this.select();
        });
    });
</script>
@endsection
