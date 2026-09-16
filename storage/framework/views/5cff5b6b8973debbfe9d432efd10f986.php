
<?php $__env->startSection('title'); ?>
    إضافة مادة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>

    <form method="post" class="needs-validation" novalidate action="<?php echo e(route('storesubject')); ?>"
        style="width: 80%; margin:auto;">
        <?php echo csrf_field(); ?>
        <label for="name">اسم المادة</label>
        <input type="text" class="form-control" id="name" name="name" required></br>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المادة
        </div>

        <!-- عرض القسم الحالي فقط -->
        <label for="department">اختر القسم:</label>
        <select id="department" name="department_id" class="form-select" required>
            <?php if(auth()->user()->department_id == null): ?>
                <option value="">اختر القسم</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <option value="<?php echo e(auth()->user()->department_id); ?>" selected>
                    <?php echo e($departments->firstWhere('id', auth()->user()->department_id)->name ?? 'القسم غير متوفر'); ?>

                </option>
            <?php endif; ?>
        </select>
        

        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">حفظ</button>
    </form>
    </br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\subject\create_subject.blade.php ENDPATH**/ ?>