
<?php $__env->startSection('title'); ?>
    تفاصيل
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">الاسم الأول</th>
                <th scope="col">الاسم الأخير</th>
                <th scope="col">الموبايل</th>
                <th scope="col">الراتب</th>
                <th scope="col">المواد</th>
                <th scope="col">الدورات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $teacher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td><?php echo e($teacher->name); ?></td>
                    <td><?php echo e($teacher->lastname); ?></td>
                    <td><?php echo e($teacher->phone_num); ?></td>
                    <?php if($teacher->salarytype == '%'): ?>
                        <td><?php echo e($teacher->salary); ?> <?php echo e($teacher->salarytype); ?></td>
                    <?php else: ?>
                        <td><?php echo e($teacher->salary); ?></td>
                    <?php endif; ?>
                    <td>
                        <?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($item); ?>|
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($course); ?>|
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    </br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\teacher\show_teacher.blade.php ENDPATH**/ ?>