@extends('layouts.master')

@section('title', 'تفاصيل الدورة - إدارة التقديرات')

@section('css')
<style>
    /* ============================================
       MODERN COURSES WITH GRADES STYLES
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

    .page-header-modern .header-stats {
        display: flex;
        gap: 20px;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }

    .page-header-modern .header-stats .stat-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 8px 18px;
        border-radius: 50px;
        color: #ffffff;
        font-size: 0.85rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .page-header-modern .header-stats .stat-item strong {
        font-size: 1.1rem;
    }

    /* Course Card */
    .course-card-modern {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        margin-bottom: 30px;
        border: 1px solid #eef2f7;
        transition: all 0.3s ease;
    }

    .course-card-modern:hover {
        box-shadow: 0 8px 35px rgba(0, 0, 0, 0.12);
        transform: translateY(-2px);
    }

    /* Course Header */
    .course-header-modern {
        background: linear-gradient(135deg, #1a1a2e, #2d3436);
        padding: 15px 25px;
        border-bottom: 3px solid #667eea;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .course-header-modern .course-title {
        display: flex;
        align-items: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .course-header-modern .course-title .course-badge {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        padding: 4px 16px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .course-header-modern .course-title h5 {
        color: #ffffff;
        margin: 0;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .course-header-modern .course-title .subject-name {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.9rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 4px 14px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .course-header-modern .course-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .course-header-modern .course-meta .meta-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 4px 14px;
        border-radius: 50px;
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .course-header-modern .course-meta .meta-item i {
        color: #667eea;
    }

    /* Course Body */
    .course-body-modern {
        padding: 20px 25px;
    }

    /* Course Info Grid */
    .course-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eef2f7;
    }

    .course-info-grid .info-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        background: #f8faff;
        border-radius: 10px;
        border: 1px solid #eef2f7;
    }

    .course-info-grid .info-item .info-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        display: flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        flex-shrink: 0;
    }

    .course-info-grid .info-item .info-content {
        display: flex;
        flex-direction: column;
    }

    .course-info-grid .info-item .info-content .info-label {
        font-size: 0.65rem;
        color: #adb5bd;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .course-info-grid .info-item .info-content .info-value {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.9rem;
    }

    /* Day Tags */
    .day-tag-modern {
        background: #f1f3f5;
        padding: 2px 10px;
        border-radius: 4px;
        font-size: 0.6rem;
        font-weight: 600;
        display: inline-block;
        margin: 1px 2px;
        color: #2d3436;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Students Section */
    .students-section {
        margin-top: 10px;
    }

    .students-section .section-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .students-section .section-title .student-count {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    /* Students Table */
    .students-table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        border-radius: 12px;
        overflow: hidden;
    }

    .students-table-modern thead {
        background: #f8faff;
    }

    .students-table-modern thead th {
        font-weight: 600;
        color: #2d3436;
        padding: 12px 15px;
        text-align: center;
        border-bottom: 2px solid #eef2f7;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .students-table-modern tbody tr {
        border-bottom: 1px solid #f1f3f8;
        transition: all 0.2s ease;
    }

    .students-table-modern tbody tr:hover {
        background: #f8faff;
    }

    .students-table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .students-table-modern tbody td {
        padding: 10px 15px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
    }

    .student-name-cell {
        display: flex;
        align-items: center;
        gap: 10px;
        justify-content: center;
    }

    .student-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    /* Grade Input */
    .grade-input-modern {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 8px 15px !important;
        font-size: 0.85rem !important;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
        height: 40px !important;
        width: 150px !important;
        text-align: center !important;
        font-weight: 600 !important;
    }

    .grade-input-modern:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .grade-input-modern.saved {
        border-color: #28a745 !important;
        background: #f0fff4 !important;
    }

    .grade-input-modern.has-grade {
        background: #f8faff !important;
        border-color: #667eea !important;
    }

    /* Status Badge */
    .status-badge {
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        display: inline-block;
    }

    .status-badge.has-grade {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.no-grade {
        background: #f8d7da;
        color: #721c24;
    }

    /* Save Button */
    .btn-save-grades {
        background: linear-gradient(135deg, #11998e, #38ef7d) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 10px 35px !important;
        border-radius: 50px !important;
        font-weight: 700 !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.35) !important;
        cursor: pointer !important;
    }

    .btn-save-grades:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 30px rgba(17, 153, 142, 0.45) !important;
        color: #ffffff !important;
    }

    .btn-save-grades:disabled {
        opacity: 0.6 !important;
        cursor: not-allowed !important;
        transform: none !important;
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

    .alert-modern.alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb) !important;
        color: #155724 !important;
        border-right: 4px solid #28a745 !important;
    }

    .alert-modern.alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb) !important;
        color: #721c24 !important;
        border-right: 4px solid #dc3545 !important;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-header-modern {
            padding: 20px;
        }
        .page-header-modern h3 {
            font-size: 1.3rem;
        }
        .course-header-modern {
            padding: 15px 20px;
        }
        .course-header-modern .course-title h5 {
            font-size: 1rem;
        }
        .course-body-modern {
            padding: 15px 20px;
        }
        .course-info-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 10px;
        }
        .grade-input-modern {
            width: 120px !important;
        }
    }

    @media (max-width: 767px) {
        .page-header-modern .header-stats {
            gap: 10px;
            margin-top: 10px;
        }
        .page-header-modern .header-stats .stat-item {
            font-size: 0.7rem;
            padding: 4px 12px;
        }
        .course-header-modern {
            flex-direction: column;
            align-items: stretch;
        }
        .course-header-modern .course-title {
            justify-content: center;
        }
        .course-header-modern .course-meta {
            justify-content: center;
        }
        .course-header-modern .course-meta .meta-item {
            font-size: 0.7rem;
            padding: 3px 10px;
        }
        .course-info-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        .course-info-grid .info-item {
            padding: 8px 12px;
        }
        .course-info-grid .info-item .info-content .info-value {
            font-size: 0.8rem;
        }
        .students-table-modern {
            min-width: 600px;
            font-size: 0.75rem;
        }
        .students-table-modern thead th {
            font-size: 0.65rem;
            padding: 8px 10px;
        }
        .students-table-modern tbody td {
            padding: 8px 10px;
            font-size: 0.75rem;
        }
        .grade-input-modern {
            width: 100px !important;
            height: 35px !important;
            font-size: 0.8rem !important;
        }
        .btn-save-grades {
            width: 100% !important;
            justify-content: center !important;
            padding: 10px 20px !important;
        }
        .student-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.6rem;
        }
    }

    @media (max-width: 480px) {
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .course-info-grid {
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        .course-info-grid .info-item {
            padding: 6px 10px;
        }
        .course-info-grid .info-item .info-icon {
            width: 28px;
            height: 28px;
            font-size: 0.7rem;
        }
        .course-info-grid .info-item .info-content .info-value {
            font-size: 0.7rem;
        }
        .grade-input-modern {
            width: 80px !important;
            height: 30px !important;
            font-size: 0.7rem !important;
            padding: 4px 8px !important;
        }
        .students-table-modern {
            min-width: 500px;
        }
        .students-table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 6px;
        }
        .students-table-modern tbody td {
            padding: 6px 6px;
            font-size: 0.65rem;
        }
        .student-name-cell {
            gap: 5px;
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

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert-modern alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('delete'))
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-trash-alt"></i>
            <strong>{{ session('delete') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Page Header -->
    <div class="page-header-modern">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3>
                    <i class="fas fa-graduation-cap"></i>
                    تفاصيل الدورة
                </h3>
                <p><i class="fas fa-info-circle"></i> عرض معلومات الدورة وإدارة تقديرات الطلاب</p>
            </div>
            <div class="col-md-6 mt-2 mt-md-0">
                <div class="header-stats justify-content-md-end">
                    <span class="stat-item">
                        <i class="fas fa-book"></i>
                        الدورة: <strong>{{ $course->coursenumber }}</strong>
                    </span>
                    <span class="stat-item">
                        <i class="fas fa-users"></i>
                        الطلاب: <strong>{{ $course->students->count() }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Course Card -->
    @if($course)
        <div class="course-card-modern" id="course-{{ $course->id }}">

            <!-- Course Header -->
            <div class="course-header-modern">
                <div class="course-title">
                    <span class="course-badge">
                        <i class="fas fa-hashtag"></i>
                        {{ $course->coursenumber }}
                    </span>
                    <h5>
                        @php
                            $subject = $subjects->where('id', $course->subject_id)->first();
                        @endphp
                        @if($subject)
                            <span class="subject-name">
                                <i class="fas fa-book"></i>
                                {{ $subject->name }}
                            </span>
                        @endif
                    </h5>
                    @php
                        $teacher = $teachers->where('id', $course->teacher_id)->first();
                    @endphp
                    @if($teacher)
                        <span class="subject-name">
                            <i class="fas fa-chalkboard-teacher"></i>
                            {{ $teacher->name }}
                        </span>
                    @endif
                </div>
                <div class="course-meta">
                    <span class="meta-item">
                        <i class="fas fa-calendar-alt"></i>
                        {{ $course->start_date ?? '—' }}
                    </span>
                    <span class="meta-item">
                        <i class="fas fa-calendar-check"></i>
                        {{ $course->end_date ?? '—' }}
                    </span>
                    <span class="meta-item">
                        <i class="fas fa-clock"></i>
                        {{ $course->start_hour ?? '—' }} - {{ $course->end_hour ?? '—' }}
                    </span>
                </div>
            </div>

            <!-- Course Body -->
            <div class="course-body-modern">

                <!-- Course Info Grid -->
                <div class="course-info-grid">
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-dollar-sign"></i></div>
                        <div class="info-content">
                            <span class="info-label">السعر</span>
                            <span class="info-value">{{ $course->price ? number_format($course->price) . ' ل.س' : '—' }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-video"></i></div>
                        <div class="info-content">
                            <span class="info-label">عدد الجلسات</span>
                            <span class="info-value">{{ $course->num_of_session ?? '—' }}</span>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="info-icon"><i class="fas fa-calendar-week"></i></div>
                        <div class="info-content">
                            <span class="info-label">أيام الدورة</span>
                            <span class="info-value">
                                @if($course->days_of_course)
                                    @php
                                        $days = explode(',', $course->days_of_course);
                                    @endphp
                                    @foreach($days as $day)
                                        <span class="day-tag-modern">{{ trim($day) }}</span>
                                    @endforeach
                                @else
                                    —
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Students Section -->
                <div class="students-section">
                    <div class="section-title">
                        <i class="fas fa-users" style="color: #667eea;"></i>
                        قائمة الطلاب
                        <span class="student-count">
                            {{ $course->students->count() }}
                        </span>
                    </div>

                    <div style="overflow-x: auto;">
                        <table class="students-table-modern">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>اسم الطالب</th>
                                    <th style="min-width: 180px;">التقدير</th>
                                    <th style="width: 120px;">الحالة</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($course->students as $index => $student)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="student-name-cell">
                                                <span class="student-avatar">
                                                    {{ mb_substr($student->firstname, 0, 1) }}
                                                </span>
                                                <span>{{ $student->firstname }} {{ $student->lastname }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text"
                                                   class="form-control grade-input-modern coursegrade"
                                                   name="coursegrade[{{ $student->id }}]"
                                                   id="coursegrade{{ $student->id }}"
                                                   placeholder="أدخل التقدير"
                                                   value="{{ $student->pivot->coursegrade ?? '' }}"
                                                   data-student-id="{{ $student->id }}"
                                                   data-course-id="{{ $course->id }}">
                                        </td>
                                        <td>
                                            @php
                                                $hasGrade = !empty($student->pivot->coursegrade);
                                            @endphp
                                            <span class="status-badge {{ $hasGrade ? 'has-grade' : 'no-grade' }}">
                                                <i class="fas {{ $hasGrade ? 'fa-check-circle' : 'fa-exclamation-circle' }}"></i>
                                                {{ $hasGrade ? 'تم التقييم' : 'غير مقيم' }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; padding: 20px; color: #adb5bd;">
                                            <i class="fas fa-user-slash" style="display: block; font-size: 1.5rem; margin-bottom: 5px;"></i>
                                            لا يوجد طلاب مسجلين في هذه الدورة
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Save Button -->
                    @if($course->students->count() > 0)
                        <div class="mt-3 d-flex justify-content-end">
                            <button class="btn-save-grades save-course-grades" data-course-id="{{ $course->id }}">
                                <i class="fas fa-save"></i>
                                حفظ جميع التقديرات
                            </button>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    @else
        <!-- Course Not Found -->
        <div class="text-center py-5" style="background: #ffffff; border-radius: 16px; box-shadow: 0 4px 25px rgba(0,0,0,0.08); padding: 50px;">
            <i class="fas fa-exclamation-circle" style="font-size: 3.5rem; color: #e8edf5; display: block; margin-bottom: 15px;"></i>
            <h5 style="color: #2d3436; font-weight: 600;">الدورة غير موجودة</h5>
            <p style="color: #adb5bd;">الرجاء التأكد من الرابط</p>
        </div>
    @endif

</div>
@endsection

@section('js')
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script>
    $(document).ready(function() {

        // ==========================================
        // SAVE GRADES FOR A SPECIFIC COURSE
        // ==========================================
        $('.save-course-grades').on('click', function() {
            var $button = $(this);
            var courseId = $button.data('course-id');
            var $inputs = $button.closest('.course-body-modern').find('.coursegrade');
            var gradesData = {};
            var hasGrades = false;

            // Collect all grades
            $inputs.each(function() {
                var studentId = $(this).data('student-id');
                var grade = $(this).val().trim();

                if (grade !== '') {
                    gradesData[studentId] = grade;
                    hasGrades = true;
                }
            });

            if (!hasGrades) {
                showNotification('يرجى إدخال التقديرات أولاً.', 'warning');
                return;
            }

            // Disable button and show loading
            $button.html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...').prop('disabled', true);

            $.ajax({
                url: "{{ route('save.all.coursegrades') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    grades: gradesData,
                    course_id: courseId
                },
                success: function(response) {
                    if (response.success) {
                        // Mark inputs as saved
                        $inputs.each(function() {
                            var studentId = $(this).data('student-id');
                            if (gradesData[studentId] !== undefined) {
                                $(this).addClass('saved').removeClass('has-grade');
                                // Update status badge
                                var $row = $(this).closest('tr');
                                $row.find('.status-badge')
                                    .removeClass('no-grade')
                                    .addClass('has-grade')
                                    .html('<i class="fas fa-check-circle"></i> تم التقييم');

                                // Remove saved class after animation
                                setTimeout(function() {
                                    $(this).removeClass('saved');
                                }.bind(this), 2000);
                            }
                        });

                        showNotification('تم حفظ جميع التقديرات بنجاح!', 'success');
                    } else {
                        showNotification('حدث خطأ أثناء حفظ التقديرات.', 'error');
                    }
                },
                error: function(xhr) {
                    showNotification('حدث خطأ أثناء حفظ التقديرات.', 'error');
                    console.log(xhr);
                },
                complete: function() {
                    // Reset button
                    $button.html('<i class="fas fa-save"></i> حفظ جميع التقديرات').prop('disabled', false);
                }
            });
        });

        // ==========================================
        // NOTIFICATION SYSTEM
        // ==========================================
        function showNotification(message, type) {
            var alertClass = type === 'success' ? 'alert-success' :
                            type === 'warning' ? 'alert-warning' : 'alert-danger';
            var icon = type === 'success' ? 'fa-check-circle' :
                       type === 'warning' ? 'fa-exclamation-triangle' : 'fa-exclamation-circle';

            var notification = $('<div class="alert-modern ' + alertClass + ' alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px; max-width: 500px;">' +
                '<i class="fas ' + icon + '"></i>' +
                '<strong>' + message + '</strong>' +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                '</div>');

            $('body').append(notification);

            // Auto-close after 5 seconds
            setTimeout(function() {
                notification.fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000);
        }

        // ==========================================
        // AUTO-CLOSE ALERTS
        // ==========================================
        setTimeout(function() {
            $('.alert-modern').fadeOut('slow');
        }, 5000);

        // ==========================================
        // ENTER KEY SUPPORT
        // ==========================================
        $('.coursegrade').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                var $button = $(this).closest('.course-body-modern').find('.save-course-grades');
                if ($button.length) {
                    $button.click();
                }
            }
        });

    });
</script>
@endsection
