<!-- ghinwa -->

<?php $__env->startSection('title'); ?>
    تعديل الحسم
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('updatesale', ['stuid' => $stuid, 'coid' => $coid])); ?>" style="width: 80%; margin:auto;"
        id="form" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <label for="sale">الحسم</label>
        <input type="number" id="sale" name="sale" step="1000" class="form-control" value="<?php echo e($sale); ?>"
            required>
        <button type="submit" class="btn btn-primary" style="margin-top: 4%">تعديل</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\student\edit_sale.blade.php ENDPATH**/ ?>