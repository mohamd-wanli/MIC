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
        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($department->id); ?></td>
                <td><?php echo e($department->name); ?></td>

            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
</br>

<div>
    <a href="<?php echo e(route('showdepartment')); ?>">show department</a>
</div>



<script src="<?php echo e(asset('assets/js/jquery-3.7.1.js')); ?>"></script>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\department\department_show.blade.php ENDPATH**/ ?>