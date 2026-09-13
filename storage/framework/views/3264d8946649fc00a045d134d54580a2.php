<?php $__env->startSection('title', 'قائمة الطلاب'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ============================================
       MODERN STUDENT LIST STYLES
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

    .action-bar-modern .btn-success-modern {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
    }

    .action-bar-modern .btn-danger-modern {
        background: linear-gradient(135deg, #eb3349, #f45c43);
        color: #ffffff;
    }

    /* Search Box */
    .search-box-modern {
        position: relative;
        flex: 1;
        min-width: 250px;
        max-width: 400px;
    }

    .search-box-modern .form-control {
        border-radius: 50px !important;
        border: 2px solid #e8edf5 !important;
        padding: 10px 20px 10px 45px !important;
        font-size: 0.9rem !important;
        background: #ffffff !important;
        transition: all 0.3s ease !important;
        height: 45px !important;
    }

    .search-box-modern .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .search-box-modern .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        z-index: 2;
    }

    /* Table Container */
    .table-container-modern {
        padding: 20px;
        background: #ffffff;
        overflow-x: auto;
    }

    /* Modern Table */
    .table-modern {
        width: 100%;
        min-width: 800px;
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
        transform: scale(1.001);
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

    /* Row Number */
    .table-modern tbody td:first-child {
        font-weight: 700;
        color: #667eea;
        font-size: 0.9rem;
    }

    /* Action Buttons in Table */
    .table-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
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

    .table-action-btn.edit-btn {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #2d3436;
    }

    .table-action-btn.edit-btn:hover {
        box-shadow: 0 4px 15px rgba(247, 151, 30, 0.4);
        color: #2d3436;
    }

    .table-action-btn.delete-btn {
        background: linear-gradient(135deg, #eb3349, #f45c43);
        color: #ffffff;
    }

    .table-action-btn.delete-btn:hover {
        box-shadow: 0 4px 15px rgba(235, 51, 73, 0.4);
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

    /* Empty State */
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
        .search-box-modern {
            max-width: 100%;
            min-width: auto;
        }
        .action-bar-modern .btn-modern {
            justify-content: center;
        }
        .table-modern {
            min-width: 700px;
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
        .page-header-modern .header-stats .stat-item {
            font-size: 0.75rem;
            padding: 6px 14px;
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
            min-width: 600px;
            font-size: 0.7rem;
        }
        .table-modern thead th {
            font-size: 0.6rem;
            padding: 8px 6px;
        }
        .table-modern tbody td {
            padding: 8px 6px;
            font-size: 0.7rem;
        }
        .table-action-btn {
            padding: 4px 10px;
            font-size: 0.65rem;
        }
    }

    @media (max-width: 480px) {
        .table-modern {
            min-width: 500px;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 4px;
        }
        .table-modern tbody td {
            font-size: 0.6rem;
            padding: 6px 4px;
        }
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .action-bar-modern .btn-modern {
            font-size: 0.8rem;
            padding: 8px 18px;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    <?php if(session()->has('Add')): ?>
        <div class="alert-modern alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong><?php echo e(session()->get('Add')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

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
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong><?php echo e(session('error')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Card -->
    <div class="card" style="border: none !important; border-radius: 16px !important; overflow: hidden !important; box-shadow: 0 4px 25px rgba(0,0,0,0.08) !important;">

        <!-- Page Header -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h3>
                        <i class="fas fa-users"></i>
                        قائمة الطلاب
                    </h3>
                    <p><i class="fas fa-info-circle"></i> عرض وإدارة جميع الطلاب المسجلين في النظام</p>
                </div>
                <div class="col-md-6 mt-2 mt-md-0">
                    <div class="header-stats justify-content-md-end">
                        <span class="stat-item">
                            <i class="fas fa-user-graduate"></i>
                            الإجمالي: <strong><?php echo e($students->count()); ?></strong>
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-calendar-alt"></i>
                            اليوم: <strong><?php echo e(date('Y-m-d')); ?></strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar - CHANGED: Button now links to create page -->
        <div class="action-bar-modern">
    <div class="d-flex flex-wrap gap-2">
        <a href="<?php echo e(route('student.create')); ?>" class="btn-modern btn-primary-modern">
            <i class="fas fa-plus-circle"></i> إضافة طالب جديد
        </a>
        <a href="<?php echo e(route('student.index')); ?>" class="btn-modern btn-success-modern">
            <i class="fas fa-sync-alt"></i> تحديث
        </a>
    </div>

    <!-- Search Form -->
   <form method="GET" action="<?php echo e(route('student.index')); ?>" class="search-box-modern" style="display:flex; align-items:center; gap:0; flex:1; min-width:250px; max-width:400px;">
    <input type="text" name="search" class="form-control" placeholder="ابحث بالاسم، الكنية، الرقم الوطني..." value="<?php echo e(request('search')); ?>" style="border-radius:50px; height:45px; flex:1; border:2px solid #e8edf5; padding-right:45px;">
    <i class="fas fa-search" style="position:relative; right:40px; color:#adb5bd; pointer-events:none;"></i>
</form>
</div>
        <!-- Table -->
        <div class="table-container-modern">
            <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                <table class="table-modern" id="studentsTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم الأول</th>
                            <th>اسم الأب</th>
                            <th>الكنية</th>
                            <th>الاسم الكامل</th>
                            <th>الرقم الوطني</th>
                            <th>العمر</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody id="studentsBody">
                        <?php $i = 0; ?>
                        <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php $i++; ?>
                            <tr>
                                <td><?php echo e($i); ?></td>
                                <td><span style="font-weight: 600;"><?php echo e($student->firstname); ?></span></td>
                                <td><?php echo e($student->fathername); ?></td>
                                <td><?php echo e($student->lastname); ?></td>
                                <td>
                                    <span style="background: #f8faff; padding: 3px 12px; border-radius: 50px; font-size: 0.8rem;">
                                        <?php echo e($student->fullname); ?>

                                    </span>
                                </td>
                                <td>
                                    <span style="font-family: monospace; font-weight: 600; color: #667eea;">
                                        <?php echo e($student->national_number ?? '—'); ?>

                                    </span>
                                </td>
                                <td>
                                      <?php
            $age = $student->getAge();
        ?>
        <?php if($age !== null): ?>
            <small class="text-muted d-block mt-1">
                العمر: <strong><?php echo e($age); ?> سنة</strong>
                <?php if($student->isCertificateEligible()): ?>
                    <span class="badge bg-success">✅ مؤهل للشهادة</span>
                <?php else: ?>
                    <span class="badge bg-danger">❌ غير مؤهل (أقل من 15)</span>
                <?php endif; ?>
            </small>
        <?php endif; ?>
                                     
                                </td>

                                <td>
                                    <a href="<?php echo e(route('student.show', $student->id)); ?>" class="table-action-btn view-btn">
                                        <i class="fas fa-eye"></i>
                                        تفاصيل
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7">
                                    <div class="empty-state-modern">
                                        <i class="fas fa-inbox"></i>
                                        <h5>لا توجد طلاب حالياً</h5>
                                        <p>قم بإضافة طالب جديد باستخدام زر "إضافة طالب جديد"</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
 <?php echo e($students->appends(request()->all())->links()); ?>

</div>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script>

    document.addEventListener('DOMContentLoaded', function() {
    var searchForm = document.querySelector('form.search-box-modern');
    var searchInput = searchForm.querySelector('input[name="search"]');
    var timeout;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        timeout = setTimeout(function() {
            searchForm.submit();
        },5000);
    });
});
        // Auto-close alerts after 5 seconds
        setTimeout(function() {
            $('.alert-modern').fadeOut('slow');
        }, 5000);

</script>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/student/student.blade.php ENDPATH**/ ?>