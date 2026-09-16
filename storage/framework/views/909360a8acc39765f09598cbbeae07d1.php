
<?php $__env->startSection('title'); ?>
    قائمة المدرسون
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <div class="card-header pb-0">
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة مدرس')): ?>
<a href="<?php echo e(route('createteacher')); ?>" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
    class="fas fa-plus"></i>&nbsp; اضافة مدرس</a><br><br>  
<?php endif; ?> 
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">الاسم الأول</th>
                <th scope="col">الاسم الأخير</th>
                <th scope="col">الموبايل</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td><?php echo e($teacher->name); ?></td>
                    <td><?php echo e($teacher->lastname); ?></td>
                    <td><?php echo e($teacher->phone_num); ?></td>
                    <td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل مدرس')): ?>
                        <a href="<?php echo e(route('editteacher', ['id' => $teacher->id])); ?>" class="btn btn-primary">تعديل</a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('حذف مدرس')): ?>
                        <a href="<?php echo e(route('deleteteacher', ['id' => $teacher->id])); ?>" class="btn btn-primary">حذف</a> 
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تفاصيل مدرس')): ?>
                        <a href="<?php echo e(route('showteacher', ['id' => $teacher->id])); ?>" class="btn btn-primary">تفاصيل</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    </br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\teacher\show_teachers.blade.php ENDPATH**/ ?>