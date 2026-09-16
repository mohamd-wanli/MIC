
<?php $__env->startSection('title'); ?>
    قائمة الدورات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success mt-3">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger mt-3">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('students.assignGroup')); ?>">
        <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="groupNumber" class="form-label">أدخل رقم المجموعة</label>
            <input type="text" id="groupNumber" name="group_number" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">تعيين رقم المجموعة لأول 25 طالب</button>
    </form>
    <?php if(isset($assignedStudents) && $assignedStudents->isNotEmpty()): ?>
        <h3>الطلاب الذين تم تعيين رقم المجموعة لهم:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم الكامل</th>
                    <th>اسم الأب</th>
                    <th>رقم المجموعة</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $assignedStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($student->fullname); ?></td>
                        <td><?php echo e($student->fathername); ?></td>
                        <td><?php echo e($student->group_number); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>الطلاب المسجلين في الدورة:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>الرقم العام</th>
                <th>الاسم الكامل</th>
                <th>اسم الأب</th>
                <th>اسم الأم</th>
                <th>الجنسية</th>
                <th>رقم المجموعة</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($student->general_number); ?></td>
                    <td><?php echo e($student->fullname); ?></td>
                    <td><?php echo e($student->fathername); ?></td>
                    <td><?php echo e($student->mothername); ?></td>
                    <td><?php echo e($student->nationality); ?></td>
                    <td><?php echo e($student->group_number ?? 'غير معيّن'); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\course\ended.blade.php ENDPATH**/ ?>