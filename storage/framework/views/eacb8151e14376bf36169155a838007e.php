<link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
<script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">name</th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($subject->id); ?></td>
                <td><?php echo e($subject->name); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</br>

<div>
    <a href="<?php echo e(route('showsubject')); ?>">show subject</a>
</div>



<script src="<?php echo e(asset('assets/js/jquery-3.7.1.js')); ?>"></script>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\subject\subject_show.blade.php ENDPATH**/ ?>