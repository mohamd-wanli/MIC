<?php $__env->startSection('title', 'دورات قيد العمل'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ============================================
       MODERN COURSES IN PROGRESS STYLES
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

    /* Action Bar */
    .action-bar-modern {
        background: #f8faff;
        padding: 18px 25px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .action-bar-modern .btn-modern {
        padding: 10px 25px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .action-bar-modern .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .action-bar-modern .btn-primary-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
    }

    /* Main Card */
    .main-card-modern {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f7;
    }

    /* Table Container */
    .table-container-modern {
        padding: 20px;
        overflow-x: auto;
    }

    /* Modern Table */
    .table-modern {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
        font-size: 0.85rem;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-modern thead {
        background: #1a1a2e;
    }

    .table-modern thead th {
        color: #ffffff !important;
        font-weight: 600;
        padding: 14px 15px;
        text-align: center;
        border: none;
        font-size: 0.78rem;
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
        cursor: default;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody td {
        padding: 12px 15px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
        font-size: 0.85rem;
    }

    /* Warning Row */
    .table-modern tbody tr.warning-row {
        background: #fff5f5 !important;
        border-left: 3px solid #dc3545;
    }

    .table-modern tbody tr.warning-row:hover {
        background: #fff0f0 !important;
    }

    /* Subject Badge */
    .subject-badge-modern {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        color: #667eea;
        padding: 4px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
    }

    /* Teacher Cell */
    .teacher-cell-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .teacher-avatar-modern {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.65rem;
        flex-shrink: 0;
    }

    /* Students Count Badge */
    .students-count-badge {
        background: linear-gradient(135deg, rgba(17, 153, 142, 0.15), rgba(56, 239, 125, 0.15));
        color: #11998e;
        padding: 4px 12px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-block;
    }

    /* Session Badge (now used for course number) */
    .course-number-badge {
        background: #f8faff;
        padding: 3px 12px;
        border-radius: 50px;
        font-weight: 700;
        color: #667eea;
        font-size: 0.9rem;
        display: inline-block;
        font-family: monospace;
    }

    /* Days Tags */
    .day-tag-modern {
        background: #f1f3f5;
        padding: 2px 8px;
        border-radius: 4px;
        font-size: 0.6rem;
        font-weight: 600;
        display: inline-block;
        margin: 1px 2px;
        color: #2d3436;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    /* Warning Badge */
    .warning-badge-modern {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }

    .warning-badge-modern.danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .warning-badge-modern.success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .warning-badge-modern i {
        font-size: 0.9rem;
    }

    /* Action Buttons in Table */
    .table-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
        margin: 0 3px;
    }

    .table-action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .table-action-btn.view-btn {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
    }

    .table-action-btn.view-btn:hover {
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        color: #ffffff;
    }

    .table-action-btn.page-btn {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
    }

    .table-action-btn.page-btn:hover {
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
        color: #ffffff;
    }

    /* Page Number Form */
    .page-form-modern {
        background: #f8faff;
        padding: 12px 15px;
        border-radius: 10px;
        margin-top: 8px;
        border: 1px solid #eef2f7;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .page-form-modern .form-control {
        border-radius: 50px !important;
        border: 2px solid #e8edf5 !important;
        padding: 8px 15px !important;
        font-size: 0.85rem !important;
        width: 150px !important;
        height: 38px !important;
        text-align: center !important;
    }

    .page-form-modern .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .page-form-modern .btn-save {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
        border: none;
        padding: 6px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        cursor: pointer;
        height: 38px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .page-form-modern .btn-save:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 16px rgba(17, 153, 142, 0.4);
    }

    /* Details Sub-table */
    .details-table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        background: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .details-table-modern thead {
        background: #f8faff;
    }

    .details-table-modern thead th {
        font-weight: 600;
        color: #2d3436;
        padding: 10px 15px;
        text-align: center;
        border-bottom: 2px solid #eef2f7;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .details-table-modern tbody td {
        padding: 10px 15px;
        text-align: center;
        color: #2d3436;
        border-bottom: 1px solid #f1f3f8;
    }

    .details-table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    .details-table-modern tbody tr:hover {
        background: #f8faff;
    }

    /* Student Name with Avatar */
    .student-cell-modern {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .student-avatar-modern {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.6rem;
        flex-shrink: 0;
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
        max-width: 100%;
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

    .alert-modern.alert-warning {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7) !important;
        color: #856404 !important;
        border-right: 4px solid #ffc107 !important;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-header-modern {
            padding: 20px;
        }
        .page-header-modern h3 {
            font-size: 1.3rem;
        }
        .action-bar-modern {
            padding: 15px;
            flex-direction: column;
            align-items: stretch;
        }
        .action-bar-modern .btn-modern {
            justify-content: center;
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
            padding: 10px 10px;
            font-size: 0.8rem;
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
        .table-modern {
            min-width: 800px;
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
        .table-action-btn {
            padding: 4px 10px;
            font-size: 0.65rem;
        }
        .page-form-modern .form-control {
            width: 120px !important;
            height: 34px !important;
            font-size: 0.8rem !important;
        }
        .page-form-modern .btn-save {
            height: 34px !important;
            font-size: 0.75rem !important;
            padding: 4px 14px !important;
        }
        .warning-badge-modern {
            font-size: 0.65rem;
            padding: 4px 10px;
        }
        .details-table-modern {
            font-size: 0.75rem;
        }
        .details-table-modern thead th,
        .details-table-modern tbody td {
            padding: 8px 10px;
        }
    }

    @media (max-width: 480px) {
        .table-modern {
            min-width: 700px;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 6px;
        }
        .table-modern tbody td {
            font-size: 0.65rem;
            padding: 6px 6px;
        }
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .page-form-modern {
            flex-direction: column;
            align-items: stretch;
        }
        .page-form-modern .form-control {
            width: 100% !important;
        }
        .page-form-modern .btn-save {
            justify-content: center;
        }
        .student-avatar-modern {
            width: 22px;
            height: 22px;
            font-size: 0.5rem;
        }
        .teacher-avatar-modern {
            width: 24px;
            height: 24px;
            font-size: 0.55rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="alert-modern alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong><?php echo e(session('success')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('delete')): ?>
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-trash-alt"></i>
            <strong><?php echo e(session('delete')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert-modern alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-triangle"></i>
            <strong><?php echo e(session('error')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="main-card-modern">

        <!-- Page Header -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>
                        <i class="fas fa-play-circle"></i>
                        دورات قيد العمل
                    </h3>
                    <p><i class="fas fa-info-circle"></i> عرض الدورات النشطة حالياً مع تفاصيل الطلاب المسجلين</p>
                </div>
                <div class="col-md-6 mt-2 mt-md-0">
                    <div class="header-stats justify-content-md-end">
                        <span class="stat-item">
                            <i class="fas fa-book"></i>
                            الدورات: <strong><?php echo e($courses->whereIn('id', session('selected_courses', []))->count()); ?></strong>
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-users"></i>
                            الطلاب: <strong><?php echo e($courses->whereIn('id', session('selected_courses', []))->sum(function($c) { return $c->students->count(); })); ?></strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="action-bar-modern">
            <a href="<?php echo e(route('students.search')); ?>" class="btn-modern btn-primary-modern">
                <i class="fas fa-search"></i>
                بحث برقم الصفحة
            </a>
            <span style="color: #6c757d; font-size: 0.85rem;">
                <i class="fas fa-info-circle"></i>
                عرض الدورات المحددة من قائمة الدورات
            </span>
        </div>

        <!-- Table -->
        <div class="table-container-modern">
            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th>المادة</th>
                            <th>المدرس</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>ساعة البداية</th>
                            <th>ساعة النهاية</th>
                            <th>عدد الطلاب</th>        <!-- replaced price -->
                            <th>رقم الدورة</th>          <!-- replaced num_of_sessions -->
                            <th>أيام الدورة</th>
                            <th>تحذير</th>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تفاصيل دورة قيد العمل')): ?>
                                <th style="min-width: 200px;">الإجراءات</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $selectedCourses = $courses->whereIn('id', session('selected_courses', []));
                        ?>

                        <?php $__empty_1 = true; $__currentLoopData = $selectedCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $start_date = \Carbon\Carbon::parse($course->start_date)->startOfDay();
                                $today = \Carbon\Carbon::now()->startOfDay();
                                $diff_days = $start_date->diffInDays($today);
                                $warning = $diff_days >= 10;
                                $subject = $subjects->firstWhere('id', $course->subject_id);
                                $teacher = $teachers->firstWhere('id', $course->teacher_id);
                                $studentsCount = $course->students->count();
                            ?>

                            <tr class="<?php echo e($warning ? 'warning-row' : ''); ?>">
                                <td>
                                    <?php if($subject): ?>
                                        <span class="subject-badge-modern">
                                            <i class="fas fa-book"></i>
                                            <?php echo e($subject->name); ?>

                                        </span>
                                    <?php else: ?>
                                        <span style="color: #adb5bd;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($teacher): ?>
                                        <span class="teacher-cell-modern">
                                            <span class="teacher-avatar-modern"><?php echo e(mb_substr($teacher->name, 0, 1)); ?></span>
                                            <?php echo e($teacher->name); ?>

                                        </span>
                                    <?php else: ?>
                                        <span style="color: #adb5bd;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-calendar-alt" style="color: #667eea; font-size: 0.7rem;"></i>
                                        <?php echo e($course->start_date); ?>

                                    </span>
                                </td>
                                <td>
                                    <span style="display: inline-flex; align-items: center; gap: 5px;">
                                        <i class="fas fa-calendar-check" style="color: #667eea; font-size: 0.7rem;"></i>
                                        <?php echo e($course->end_date); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="time-cell" style="background: #f8faff; padding: 2px 10px; border-radius: 50px; font-size: 0.8rem;">
                                        <i class="fas fa-clock" style="color: #667eea;"></i>
                                        <?php echo e($course->start_hour); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="time-cell" style="background: #f8faff; padding: 2px 10px; border-radius: 50px; font-size: 0.8rem;">
                                        <i class="fas fa-clock" style="color: #667eea;"></i>
                                        <?php echo e($course->end_hour); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="students-count-badge">
                                        <i class="fas fa-user-graduate"></i>
                                        <?php echo e($studentsCount); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="course-number-badge">
                                        <?php echo e($course->coursenumber); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($course->days_of_course): ?>
                                        <?php
                                            $days = explode(',', $course->days_of_course);
                                        ?>
                                        <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="day-tag-modern"><?php echo e(trim($day)); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <span style="color: #adb5bd;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($warning): ?>
                                        <span class="warning-badge-modern danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            مرّ <?php echo e($diff_days); ?> يوم
                                        </span>
                                    <?php else: ?>
                                        <span class="warning-badge-modern success">
                                            <i class="fas fa-check-circle"></i>
                                            <?php echo e($diff_days); ?> يوم
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تفاصيل دورة قيد العمل')): ?>
                                    <td>
                                        <button class="table-action-btn view-btn" onclick="toggleDetails(<?php echo e($course->id); ?>)">
                                            <i class="fas fa-users"></i>
                                            تفاصيل
                                        </button>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة رقم صفحة')): ?>
                                            <button class="table-action-btn page-btn" onclick="togglePageForm(<?php echo e($course->id); ?>)">
                                                <i class="fas fa-file-alt"></i>
                                                رقم صفحة
                                            </button>

                                            <div id="page-form-<?php echo e($course->id); ?>" class="page-form-modern" style="display:none;">
                                                <form action="<?php echo e(route('courses.assignPageNumbers')); ?>" method="POST" style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; justify-content: center;">
                                                    <?php echo csrf_field(); ?>
                                                    <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                                    <input type="number" name="page_number" class="form-control" placeholder="أدخل رقم الصفحة" required min="1">
                                                    <button type="submit" class="btn-save">
                                                        <i class="fas fa-save"></i>
                                                        حفظ
                                                    </button>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php endif; ?>
                            </tr>

                            <!-- Details Row -->
                            <tr id="details-<?php echo e($course->id); ?>" style="display: none;">
                                <td colspan="11" style="padding: 20px; background: #f8faff;">
                                    <div style="max-height: 400px; overflow-y: auto;">
                                        <table class="details-table-modern">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>الاسم الكامل</th>
                                                    <th>رقم الموبايل</th>
                                                    <th>اسم الأم</th>
                                                    <th>الرقم الوطني</th>
                                                    <th>الجنسية</th>          <!-- new column -->
                                                    <th>تاريخ الميلاد</th>     <!-- new column -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_2 = true; $__currentLoopData = $course->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($loop->iteration); ?></td>
                                                        <td>
                                                            <span class="student-cell-modern">
                                                                <span class="student-avatar-modern">
                                                                    <?php echo e(mb_substr($student->fullname, 0, 1)); ?>

                                                                </span>
                                                                <?php echo e($student->fullname); ?>

                                                            </span>
                                                        </td>
                                                        <td>
                                                            <?php if(isset($student->extrastudent)): ?>
                                                                <span style="direction: ltr; font-family: monospace;">
                                                                    <?php echo e($student->extrastudent->mobile ?? '—'); ?>

                                                                </span>
                                                            <?php else: ?>
                                                                <span style="color: #adb5bd;">—</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo e($student->extrastudent->mothername ?? 'غير متوفر'); ?>

                                                        </td>
                                                        <td>
                                                            <?php if($student->national_number): ?>
                                                                <span style="font-family: monospace; font-weight: 600; color: #667eea;">
                                                                    <?php echo e($student->national_number); ?>

                                                                </span>
                                                            <?php else: ?>
                                                                <span style="color: #adb5bd;">غير متوفر</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo e($student->extrastudent->nationality ?? 'غير متوفر'); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($student->extrastudent->date_of_birth ?? 'غير متوفر'); ?>

                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                                    <tr>
                                                        <td colspan="7" style="text-align: center; padding: 30px; color: #adb5bd;">
                                                            <i class="fas fa-user-slash" style="display: block; font-size: 1.5rem; margin-bottom: 5px;"></i>
                                                            لا يوجد طلاب مسجلين في هذه الدورة
                                                        </td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="11">
                                    <div class="empty-state-modern">
                                        <i class="fas fa-inbox"></i>
                                        <h5>لا توجد دورات قيد العمل</h5>
                                        <p>قم بتحديد دورات من قائمة الدورات لعرضها هنا</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    // ==========================================
    // TOGGLE DETAILS ROW
    // ==========================================
    function toggleDetails(courseId) {
        let row = document.getElementById("details-" + courseId);
        if (row.style.display === "none") {
            row.style.display = "table-row";
            // Smooth scroll to the details
            row.scrollIntoView({ behavior: 'smooth', block: 'center' });
        } else {
            row.style.display = "none";
        }
    }

    // ==========================================
    // TOGGLE PAGE NUMBER FORM
    // ==========================================
    function togglePageForm(courseId) {
        let form = document.getElementById("page-form-" + courseId);
        if (form.style.display === "none") {
            form.style.display = "flex";
            // Focus the input
            let input = form.querySelector('input[type="number"]');
            if (input) setTimeout(function() { input.focus(); }, 100);
        } else {
            form.style.display = "none";
        }
    }

    // ==========================================
    // AUTO-CLOSE ALERTS
    // ==========================================
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            document.querySelectorAll('.alert-modern').forEach(function(alert) {
                alert.style.transition = 'opacity 0.5s ease';
                alert.style.opacity = '0';
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\course\active.blade.php ENDPATH**/ ?>