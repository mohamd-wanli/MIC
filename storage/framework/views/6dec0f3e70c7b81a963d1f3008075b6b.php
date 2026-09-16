
<?php $__env->startSection('title'); ?>
تعديل قسم
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<p  style="color:green"><?php echo e(session('success')); ?></p>
<?php elseif(session('delete')): ?>
<p  style="color:red" ><?php echo e(session('delete')); ?></p>
<?php elseif(session('error')): ?>
<p  style="color:red" ><?php echo e(session('error')); ?> </p>
<?php endif; ?>
    <form method="post" action="<?php echo e(route('updatedepartment',$department->id)); ?>" class="needs-validation" novalidate style="width: 80%; margin:auto;">
        <?php echo csrf_field(); ?>
            <label for="name">اسم القسم</label>  
            <input type="text" class="form-control" id="name" name="name" value=<?php echo e($department->name); ?> required></br>  
            <div class="invalid-feedback">
                الرجاء ادخال اسم القسم
            </div>  
        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">تعديل</button>
    </form>
</br>   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\department\edit_dep.blade.php ENDPATH**/ ?>