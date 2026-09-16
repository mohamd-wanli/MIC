
<?php $__env->startSection('title'); ?>
    تعديل مادة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('updatesubject', $subject->id)); ?>" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        <?php echo csrf_field(); ?>
        <label for="name">اسم المادة</label>
        <input type="text" class="form-control" id="name" name="name" value=<?php echo e($subject->name); ?> required></br>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المادة
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">تعديل</button>
    </form>
    </br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\subject\edit_sub.blade.php ENDPATH**/ ?>