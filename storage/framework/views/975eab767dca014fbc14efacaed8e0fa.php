<?php $__env->startSection('title', 'تقرير طلاب ضمن دورة'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery-ui.css')); ?>">

    <style>
        /* ============================================
           MODERN STUDENT SEARCH BY COURSE STYLES
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
            font-size: 0.85rem;
            margin-bottom: 6px;
            display: block;
        }

        .search-section-modern .form-control {
            border-radius: 10px !important;
            border: 2px solid #e8edf5 !important;
            padding: 10px 15px !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease !important;
            background: #ffffff !important;
            height: 45px !important;
            box-shadow: none !important;
        }

        .search-section-modern .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
            outline: none !important;
        }

        .search-section-modern .form-control::placeholder {
            color: #adb5bd;
            font-size: 0.85rem;
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
            height: 45px;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            width: 100%;
            justify-content: center;
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

        /* Modern Table */
        .table-container-modern {
            overflow-x: auto;
            border-radius: 12px;
            border: 1px solid #eef2f7;
        }

        .table-modern {
            width: 100%;
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

        /* Row Number */
        .table-modern tbody td:first-child {
            font-weight: 700;
            color: #667eea;
            font-size: 0.9rem;
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

        /* Action Buttons */
        .table-action-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin: 2px;
        }

        .table-action-btn:hover {
            transform: translateY(-2px);
            text-decoration: none;
        }

        .table-action-btn.btn-certificate {
            background: linear-gradient(135deg, #2193b0, #6dd5ed);
            color: #ffffff;
        }

        .table-action-btn.btn-certificate:hover {
            box-shadow: 0 4px 15px rgba(33, 147, 176, 0.4);
            color: #ffffff;
        }

        /* Print Buttons */
        .print-buttons-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eef2f7;
        }

        .btn-print-modern {
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }

        .btn-print-modern:hover {
            transform: translateY(-3px);
            text-decoration: none;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-print-modern.btn-success {
            background: linear-gradient(135deg, #11998e, #38ef7d);
            color: #ffffff;
        }

        .btn-print-modern.btn-warning {
            background: linear-gradient(135deg, #f7971e, #ffd200);
            color: #2d3436;
        }

        .btn-print-modern.btn-danger {
            background: linear-gradient(135deg, #eb3349, #f45c43);
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
        }

        .alert-modern i {
            font-size: 1.3rem !important;
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
            .search-section-modern {
                padding: 20px;
            }
            .search-section-modern .form-control {
                height: 40px !important;
                font-size: 0.85rem !important;
            }
            .btn-search-modern {
                height: 40px !important;
                font-size: 0.85rem !important;
                padding: 8px 25px !important;
            }
            .report-container-modern {
                padding: 15px;
            }
            .table-modern {
                font-size: 0.8rem;
                min-width: 500px;
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
            .search-section-modern .row {
                gap: 15px;
            }
            .search-section-modern .form-control {
                height: 38px !important;
                font-size: 0.8rem !important;
            }
            .btn-search-modern {
                height: 38px !important;
                font-size: 0.8rem !important;
                width: 100%;
            }
            .table-modern {
                min-width: 400px;
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
                padding: 4px 12px;
                font-size: 0.7rem;
            }
            .print-buttons-group {
                flex-direction: column;
                align-items: stretch;
            }
            .btn-print-modern {
                justify-content: center;
                padding: 10px 20px;
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
            .table-modern {
                min-width: 350px;
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
            .student-avatar {
                width: 24px;
                height: 24px;
                font-size: 0.5rem;
            }
            .table-action-btn {
                padding: 3px 10px;
                font-size: 0.65rem;
            }
            .btn-print-modern {
                font-size: 0.8rem;
                padding: 8px 16px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <!-- Main Card -->
    <div class="main-card-modern">

        <!-- Page Header -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h3>
                        <i class="fas fa-users"></i>
                        تقرير طلاب ضمن دورة
                    </h3>
                    <p><i class="fas fa-info-circle"></i> البحث عن الطلاب المسجلين في دورة معينة</p>
                </div>
                <div class="col-md-5 mt-2 mt-md-0">
                    <div class="header-stats justify-content-md-end">
                        <span class="stat-item">
                            <i class="fas fa-user-graduate"></i>
                            الطلاب: <strong><?php echo e(isset($students) ? $students->count() : 0); ?></strong>
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-calendar-alt"></i>
                            اليوم: <strong><?php echo e(date('Y-m-d')); ?></strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section-modern">
            <form action="<?php echo e(route('search.students')); ?>" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="course_number">
                                <i class="fas fa-hashtag" style="color: #667eea;"></i>
                                رقم الدورة
                            </label>
                            <input type="text"
                                   name="course_number"
                                   id="course_number"
                                   value="<?php echo e(request('course_number')); ?>"
                                   class="form-control"
                                   placeholder="أدخل رقم الدورة">
                        </div>
                    </div>

                 <div class="col-md-5">
    <div class="form-group">
        <label for="teacher_name">
            <i class="fas fa-book" style="color: #667eea;"></i>
            اسم الدورة
        </label>
        <select name="teacher_name" id="teacher_name" class="form-control">
            <option value="">-- اختر دورة --</option>
            <?php $__currentLoopData = $courseNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($course->subject_name); ?>" <?php echo e(request('teacher_name') == $course->subject_name ? 'selected' : ''); ?>>
                    <?php echo e($course->subject_name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

                    <div class="col-md-2">
                        <button type="submit" class="btn-search-modern">
                            <i class="fas fa-search"></i>
                            بحث
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div class="report-container-modern">
            <?php if(isset($students) && $students->count()): ?>

                <div class="table-container-modern">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th style="width: 8%;">#</th>
                                <th>اسم الطالب</th>
                                <th style="width: 20%;">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <div class="student-name-cell">
                                            <span class="student-avatar">
                                                <?php echo e(mb_substr($student->fullname, 0, 1)); ?>

                                            </span>
                                            <span style="font-weight: 600;"><?php echo e($student->fullname); ?></span>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="<?php echo e(route('certificate.request')); ?>" method="POST" style="display: inline;">
                                            <?php echo csrf_field(); ?>
                                            <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                            <input type="hidden" name="course_id" value="<?php echo e(request('course_number')); ?>">
                                            <button type="submit" class="table-action-btn btn-certificate">
                                                <i class="fas fa-certificate"></i>
                                                طلب شهادة
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Print Buttons -->
                <div class="print-buttons-group">
                    <a href="<?php echo e(route('print.students', request()->all())); ?>"
                       target="_blank"
                       class="btn-print-modern btn-success">
                        <i class="fas fa-print"></i>
                        طباعة التقرير
                    </a>

                    <a href="<?php echo e(route('print', request()->all())); ?>"
                       target="_blank"
                       class="btn-print-modern btn-warning">
                        <i class="fas fa-print"></i>
                        طباعة بدون X
                    </a>

                    <a href="<?php echo e(route('financial.report', request()->all())); ?>"
                       target="_blank"
                       class="btn-print-modern btn-danger">
                        <i class="fas fa-file-invoice"></i>
                        طباعة التقرير المالي
                    </a>
                </div>

            <?php elseif(isset($students)): ?>
                <!-- No Results -->
                <div class="alert-modern alert-warning text-center" style="justify-content: center;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>لا يوجد طلاب مطابقين لمعايير البحث</strong>
                </div>

            <?php else: ?>
                <!-- Initial State -->
                <div style="text-align: center; padding: 40px 20px;">
                    <i class="fas fa-search" style="font-size: 3.5rem; color: #e8edf5; display: block; margin-bottom: 15px;"></i>
                    <h5 style="color: #2d3436; font-weight: 600;">أدخل معايير البحث</h5>
                    <p style="color: #adb5bd; font-size: 0.9rem;">قم بإدخال رقم الدورة أو اسم الدورة للبحث عن الطلاب المسجلين</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-submit on Enter key
        document.querySelector('form').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.submit();
            }
        });
document.getElementById('teacher_name').addEventListener('change', function() {
    this.closest('form').submit();
});
        // Focus on first input if empty
        <?php if(!request('course_number') && !request('teacher_name')): ?>
            document.getElementById('course_number').focus();
        <?php endif; ?>
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/report/student_by_course.blade.php ENDPATH**/ ?>