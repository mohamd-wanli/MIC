<?php $__env->startSection('title', 'بحث الدورات'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ============================================
       OVERRIDE NICEDMIN TEMPLATE STYLES
       ============================================ */

    /* Card-like container for the entire section */
    .courses-modern-wrapper {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        margin-bottom: 30px;
        border: 1px solid rgba(0, 0, 0, 0.06);
    }

    /* ============================================
       MODERN HEADER WITH GRADIENT
       ============================================ */
    .courses-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        position: relative;
        overflow: hidden;
    }

    .courses-header-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .courses-header-modern::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }

    .courses-header-modern h3 {
        color: #ffffff !important;
        font-weight: 700;
        font-size: 1.6rem;
        margin: 0;
        position: relative;
        z-index: 1;
    }

    .courses-header-modern .subtitle {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        margin-top: 4px;
        position: relative;
        z-index: 1;
    }

    .courses-header-modern .header-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 8px 20px;
        border-radius: 50px;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.15);
        display: inline-block;
        font-weight: 500;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    /* ============================================
       ACTION BUTTONS - CARD STYLE
       ============================================ */
    .action-buttons-modern {
        background: #f8faff;
        padding: 18px 25px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        align-items: center;
    }

    .action-buttons-modern .btn-modern {
        padding: 8px 22px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .action-buttons-modern .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .action-buttons-modern .btn-primary-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
    }

    .action-buttons-modern .btn-success-modern {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
    }

    .action-buttons-modern .btn-warning-modern {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #2d3436;
    }

    .action-buttons-modern .btn-info-modern {
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        color: #ffffff;
    }

    /* ============================================
       TABLE CONTAINER
       ============================================ */
    .table-container-modern {
        padding: 0 20px 20px 20px;
        overflow-x: auto;
        background: #ffffff;
    }

    /* ============================================
       MODERN TABLE STYLES
       ============================================ */
    .table-modern {
        width: 100%;
        min-width: 1000px;
        margin-bottom: 0;
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
        padding: 14px 12px;
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
        cursor: default;
    }

    .table-modern tbody tr:last-child {
        border-bottom: none;
    }

    .table-modern tbody td {
        padding: 12px 10px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
        font-size: 0.85rem;
    }

    /* Row number */
    .table-modern tbody td:first-child {
        font-weight: 700;
        color: #667eea;
        font-size: 0.9rem;
    }

    /* ============================================
       SUBJECT CELL
       ============================================ */
    .subject-cell {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #2d3436;
    }

    .subject-cell .subject-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.15));
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #667eea;
        flex-shrink: 0;
    }

    /* ============================================
       TEACHER CELL
       ============================================ */
    .teacher-cell {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .teacher-cell .teacher-avatar {
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

    .teacher-cell .teacher-name {
        font-weight: 500;
        color: #2d3436;
    }

    .no-teacher {
        color: #adb5bd;
        font-size: 0.75rem;
        background: #f1f3f5;
        padding: 4px 12px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       DATE & TIME
       ============================================ */
    .date-cell {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }

    .date-cell i {
        color: #667eea;
        font-size: 0.75rem;
        opacity: 0.7;
    }

    .time-cell {
        font-weight: 500;
        background: #f8faff;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        display: inline-block;
    }

    /* ============================================
       PRICE
       ============================================ */
    .price-cell {
        font-weight: 700;
        color: #667eea;
        font-size: 1rem;
    }

    /* ============================================
       SESSION BADGE
       ============================================ */
    .session-badge {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.12), rgba(118, 75, 162, 0.12));
        color: #667eea;
        padding: 4px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
        display: inline-block;
    }

    /* ============================================
       DAY TAGS
       ============================================ */
    .day-tag {
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

    /* ============================================
       PAGE BADGE
       ============================================ */
    .page-badge {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
        padding: 4px 16px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-block;
    }

    .page-badge.empty {
        background: #f1f3f5;
        color: #adb5bd;
    }

    /* ============================================
       FORM IN TABLE
       ============================================ */
    .form-inline-modern {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .form-inline-modern .form-control {
        width: 70px !important;
        height: 32px !important;
        font-size: 0.8rem !important;
        text-align: center !important;
        border-radius: 50px !important;
        border: 2px solid #e8edf5 !important;
        padding: 4px 8px !important;
        background: #f8faff !important;
        transition: all 0.3s ease !important;
    }

    .form-inline-modern .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .form-inline-modern .btn-save {
        background: linear-gradient(135deg, #11998e, #38ef7d) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 4px 16px !important;
        border-radius: 50px !important;
        font-weight: 600 !important;
        font-size: 0.75rem !important;
        height: 32px !important;
        transition: all 0.3s ease !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 4px !important;
    }

    .form-inline-modern .btn-save:hover {
        transform: scale(1.05) !important;
        box-shadow: 0 4px 16px rgba(17, 153, 142, 0.4) !important;
    }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state-modern {
        padding: 50px 20px;
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

    /* ============================================
       STATS CARDS
       ============================================ */
    .stats-grid-modern {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        padding: 20px 20px 25px 20px;
        background: #f8faff;
        border-top: 1px solid #eef2f7;
    }

    .stat-card-modern {
        background: #ffffff;
        border-radius: 12px;
        padding: 18px 15px;
        text-align: center;
        border: 1px solid #eef2f7;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card-modern::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
    }

    .stat-card-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    .stat-card-modern .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 2px;
        line-height: 1.2;
    }

    .stat-card-modern .stat-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }

    .stat-card-modern.primary::before {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }
    .stat-card-modern.primary .stat-number {
        color: #667eea;
    }

    .stat-card-modern.success::before {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }
    .stat-card-modern.success .stat-number {
        color: #11998e;
    }

    .stat-card-modern.warning::before {
        background: linear-gradient(135deg, #f7971e, #ffd200);
    }
    .stat-card-modern.warning .stat-number {
        color: #f7971e;
    }

    .stat-card-modern.info::before {
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
    }
    .stat-card-modern.info .stat-number {
        color: #2193b0;
    }

    /* ============================================
       ALERT STYLES
       ============================================ */
    .alert-modern {
        border-radius: 12px;
        padding: 14px 20px;
        margin-bottom: 20px;
        border: none;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .alert-modern i {
        font-size: 1.2rem;
    }

    .alert-modern.alert-success {
        background: #d4edda;
        color: #155724;
        border-right: 4px solid #28a745;
    }

    .alert-modern.alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-right: 4px solid #dc3545;
    }

    .alert-modern.alert-warning {
        background: #fff3cd;
        color: #856404;
        border-right: 4px solid #ffc107;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 991px) {
        .courses-header-modern {
            padding: 20px;
        }
        .courses-header-modern h3 {
            font-size: 1.3rem;
        }
        .action-buttons-modern {
            padding: 15px;
            gap: 8px;
        }
        .action-buttons-modern .btn-modern {
            padding: 6px 16px;
            font-size: 0.8rem;
        }
        .stats-grid-modern {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            padding: 15px;
        }
        .stat-card-modern .stat-number {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 767px) {
        .courses-header-modern .header-badge {
            font-size: 0.8rem;
            padding: 6px 14px;
            margin-top: 8px;
        }
        .action-buttons-modern {
            flex-direction: column;
            align-items: stretch;
        }
        .action-buttons-modern .btn-modern {
            justify-content: center;
        }
        .table-container-modern {
            padding: 0 10px 10px 10px;
        }
        .table-modern {
            min-width: 800px;
            font-size: 0.75rem;
        }
        .table-modern thead th {
            font-size: 0.65rem;
            padding: 10px 6px;
        }
        .table-modern tbody td {
            padding: 8px 6px;
            font-size: 0.7rem;
        }
        .form-inline-modern .form-control {
            width: 60px !important;
            height: 28px !important;
            font-size: 0.7rem !important;
        }
        .form-inline-modern .btn-save {
            height: 28px !important;
            font-size: 0.65rem !important;
            padding: 2px 12px !important;
        }
        .stats-grid-modern {
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        .stat-card-modern {
            padding: 12px 10px;
        }
        .stat-card-modern .stat-number {
            font-size: 1.2rem;
        }
        .stat-card-modern .stat-label {
            font-size: 0.7rem;
        }
    }

    @media (max-width: 480px) {
        .table-modern {
            min-width: 650px;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 4px;
        }
        .table-modern tbody td {
            font-size: 0.6rem;
            padding: 6px 4px;
        }
        .courses-header-modern h3 {
            font-size: 1.1rem;
        }
        .stats-grid-modern {
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3">

    <!-- ALERT MESSAGES -->
    <?php if(session('success')): ?>
        <div class="alert-modern alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>

    <?php if(session('delete')): ?>
        <div class="alert-modern alert-danger">
            <i class="fas fa-trash-alt"></i>
            <span><?php echo e(session('delete')); ?></span>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert-modern alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo e(session('error')); ?></span>
        </div>
    <?php endif; ?>

    <!-- MAIN CARD -->
    <div class="courses-modern-wrapper">

        <!-- HEADER -->
        <div class="courses-header-modern">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h3>
                        <i class="fas fa-graduation-cap me-2"></i>
                        قائمة الدورات
                    </h3>
                    <div class="subtitle">
                        <i class="fas fa-info-circle me-1"></i>
                        عرض جميع الدورات المتاحة في المركز
                    </div>
                </div>
                <div class="col-md-5 text-md-end mt-2 mt-md-0">
                    <span class="header-badge">
                        <i class="fas fa-book me-1"></i>
                        عدد الدورات: <strong><?php echo e($courses->count()); ?></strong>
                    </span>
                </div>
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="action-buttons-modern">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث برقم الشهادة')): ?>
                <a href="<?php echo e(route('courses.searchPage', 0)); ?>" class="btn-modern btn-primary-modern">
                    <i class="fas fa-certificate"></i>
                    بحث برقم الشهادة
                </a>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث برقم الصفحة')): ?>
                <a href="<?php echo e(route('students.search')); ?>" class="btn-modern btn-success-modern">
                    <i class="fas fa-file"></i>
                    بحث برقم الصفحة
                </a>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث بالاسم')): ?>
                <a href="<?php echo e(route('students.searchByName')); ?>" class="btn-modern btn-warning-modern">
                    <i class="fas fa-user-search"></i>
                    بحث بالاسم
                </a>
            <?php endif; ?>
        </div>
          <!-- NEW SEARCH INPUTS -->
     <div class="d-flex gap-2 align-items-center" style="flex:1; min-width:250px; max-width:500px;">
        <input type="text" id="searchCourseNumber" class="form-control" placeholder="رقم الدورة..." value="<?php echo e(request('course_number')); ?>" style="flex:1; border-radius: 50px; height:40px;">
        <input type="text" id="searchCourseName" class="form-control" placeholder="اسم الدورة..." value="<?php echo e(request('course_name')); ?>" style="flex:1; border-radius: 50px; height:40px;">
    </div>
</div>
</div>

        <!-- TABLE -->
        <div class="table-container-modern">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>المادة</th>
                        <th>المدرس</th>
                        <th>تاريخ البداية</th>
                        <th>تاريخ النهاية</th>
                        <th>ساعة البداية</th>
                        <th>ساعة النهاية</th>
                        <th>السعر</th>
                        <th>عدد الجلسات</th>
                        <th>أيام الدورة</th>
                        <th>رقم الصفحة</th>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة رقم صفحة')): ?>
                            <th>الإجراءات</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>

                            <td>
                                <?php
                                    $subjectName = $subjects->where('id', $course->subject_id)->first()->name ?? null;
                                ?>
                                <?php if($subjectName): ?>
                                    <span class="subject-cell">
                                        <span class="subject-icon"><i class="fas fa-book"></i></span>
                                        <?php echo e($subjectName); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd; font-size: 0.8rem;">غير محدد</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php
                                    $teacher = $teachers->where('id', $course->teacher_id)->first();
                                ?>
                                <?php if($teacher): ?>
                                    <span class="teacher-cell">
                                        <span class="teacher-avatar"><?php echo e(mb_substr($teacher->name, 0, 1)); ?></span>
                                        <span class="teacher-name"><?php echo e($teacher->name); ?></span>
                                    </span>
                                <?php else: ?>
                                    <span class="no-teacher">
                                        <i class="fas fa-user-slash"></i>
                                        لا يوجد
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->start_date): ?>
                                    <span class="date-cell">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo e($course->start_date); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->end_date): ?>
                                    <span class="date-cell">
                                        <i class="fas fa-calendar-check"></i>
                                        <?php echo e($course->end_date); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->start_hour): ?>
                                    <span class="time-cell">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($course->start_hour); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->end_hour): ?>
                                    <span class="time-cell">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($course->end_hour); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->price): ?>
                                    <span class="price-cell">
                                        <?php echo e(number_format($course->price)); ?> ج.م
                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->num_of_session): ?>
                                    <span class="session-badge">
                                        <i class="fas fa-video"></i>
                                        <?php echo e($course->num_of_session); ?>

                                    </span>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if($course->days_of_course): ?>
                                    <?php
                                        $days = explode(',', $course->days_of_course);
                                    ?>
                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="day-tag"><?php echo e(trim($day)); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <span style="color: #adb5bd;">-</span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php
                                    $pageNumber = $course->students->first()->pivot->page_number ?? null;
                                ?>
                                <?php if($pageNumber): ?>
                                    <span class="page-badge">
                                        <i class="fas fa-file-alt"></i>
                                        <?php echo e($pageNumber); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="page-badge empty">
                                        <i class="fas fa-minus"></i>
                                        غير محدد
                                    </span>
                                <?php endif; ?>
                            </td>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة رقم صفحة')): ?>
                                <td>
                                    <form action="<?php echo e(route('courses.assignPageNumbers')); ?>"
                                          method="POST"
                                          class="form-inline-modern">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
                                        <input type="number"
                                               name="page_number"
                                               class="form-control"
                                               placeholder="الرقم"
                                               required
                                               min="1">
                                        <button type="submit" class="btn-save">
                                            <i class="fas fa-save"></i>
                                            حفظ
                                        </button>
                                    </form>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="12">
                                <div class="empty-state-modern">
                                    <i class="fas fa-inbox"></i>
                                    <h5>لا توجد دورات حالياً</h5>
                                    <p>قم بإضافة دورة جديدة باستخدام زر "إضافة دورة جديدة"</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- STATS CARDS -->
        <div class="stats-grid-modern">
            <div class="stat-card-modern primary">
                <div class="stat-number"><?php echo e($courses->count()); ?></div>
                <div class="stat-label">إجمالي الدورات</div>
            </div>
            <div class="stat-card-modern success">
                <div class="stat-number">
                    <?php echo e($courses->where('status', 'نشط')->count() ?? $courses->count()); ?>

                </div>
                <div class="stat-label">دورات نشطة</div>
            </div>
            <div class="stat-card-modern warning">
                <div class="stat-number"><?php echo e($teachers->count()); ?></div>
                <div class="stat-label">المدرسين</div>
            </div>
            <div class="stat-card-modern info">
                <div class="stat-number"><?php echo e($subjects->count()); ?></div>
                <div class="stat-label">المواد</div>
            </div>
        </div>

    </div>

    <!-- PAGINATION -->
<div class="d-flex justify-content-center mt-3">
    <?php echo e($courses->appends(request()->all())->links()); ?>

</div>

</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchNumber = document.getElementById('searchCourseNumber');
        var searchName = document.getElementById('searchCourseName');
        var searchTimeout;

        function submitSearch() {
            var params = new URLSearchParams();
            if (searchNumber.value.trim()) params.append('course_number', searchNumber.value.trim());
            if (searchName.value.trim()) params.append('course_name', searchName.value.trim());
            window.location.href = window.location.pathname + '?' + params.toString();
        }

        if (searchNumber && searchName) {
            var inputs = [searchNumber, searchName];
            inputs.forEach(function(input) {
                input.addEventListener('input', function() {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(submitSearch, 500);
                });
                input.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        clearTimeout(searchTimeout);
                        submitSearch();
                    }
                });
            });
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/course/completed.blade.php ENDPATH**/ ?>