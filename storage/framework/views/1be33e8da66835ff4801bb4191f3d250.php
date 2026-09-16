

<?php $__env->startSection('title', 'إدارة المواد'); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-4">
    <h2 class="mb-4">قائمة المواد</h2>

    <!-- رسالة نجاح -->
    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <!-- زر إضافة مادة جديدة -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMeterModal">إضافة مادة جديدة</button>

    <!-- جدول عرض المواد -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>اسم المادة</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $meters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $meter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($index + 1); ?></td>
                    <td><?php echo e($meter->name); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<!-- نموذج إضافة مادة جديدة -->
<div class="modal fade" id="addMeterModal" tabindex="-1" aria-labelledby="addMeterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMeterModalLabel">إضافة مادة جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo e(route('meters.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المادة</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\meters\index.blade.php ENDPATH**/ ?>