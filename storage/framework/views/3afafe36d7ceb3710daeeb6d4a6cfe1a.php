<?php $__env->startSection('css'); ?>
<!-- Internal Font Awesome -->
<link href="<?php echo e(URL::asset('assets/plugins/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
<!-- Internal Treeview -->
<link href="<?php echo e(URL::asset('assets/plugins/treeview/treeview-rtl.css')); ?>" rel="stylesheet" type="text/css" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('title'); ?>
اضافة الصلاحيات
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<!-- Breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto text-primary"><i class="fas fa-user-shield"></i> إدارة الصلاحيات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / إضافة نوع مستخدم</span>
        </div>
    </div>
</div>
<!-- Breadcrumb -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- عرض الأخطاء إن وجدت -->
<?php if($errors->any()): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>⚠ خطأ!</strong> يرجى التحقق من الأخطاء التالية:
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>❌ <?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<!-- Form -->
<form action="<?php echo e(route('roles.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-plus-circle"></i> إضافة صلاحية جديدة</h5>
                    <a class="btn btn-light btn-sm" href="<?php echo e(route('roles.index')); ?>"><i class="fas fa-arrow-left"></i> رجوع</a>
                </div>
                <div class="card-body">
                    <!-- إدخال اسم الصلاحية -->
                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-key"></i> اسم الصلاحية:</label>
                        <input type="text" name="name" class="form-control" placeholder="أدخل اسم الصلاحية"
                               value="<?php echo e(old('name', $role->name ?? '')); ?>">
                    </div>

                    <!-- عرض الصلاحيات -->
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="border rounded p-3">
                                <h6 class="text-center font-weight-bold"><i class="fas fa-lock"></i> قائمة الصلاحيات</h6>
                                <ul id="treeview1" class="list-group">
                                    <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex align-items-center">
                                            <input type="checkbox" name="permission[]" value="<?php echo e($value->name); ?>" class="mr-2">
                                            <i></i> <?php echo e($value->name); ?>

                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- زر الإضافة -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-success btn-lg"><i class="fas fa-save"></i> تأكيد</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<!-- Internal Treeview js -->
<script src="<?php echo e(URL::asset('assets/plugins/treeview/treeview.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\roles\create.blade.php ENDPATH**/ ?>