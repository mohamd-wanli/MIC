
<?php $__env->startSection('title'); ?>
    قائمة المواد
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <style>
        .hidden {
            display: none
        }
    </style>
    <div class="card-header pb-0 row">
        <div class="col-2">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة مادة')): ?>
            <a href="<?php echo e(route('createsubject')); ?>" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                class="fas fa-plus"></i>&nbsp; اضافة مادة</a><br><br>  
            <?php endif; ?>
           
        </div>
    </div>
    <table class="table-striped" id="table">
        <thead class="thead-dark">
            <tr>
                
                <th scope="col">اسم المادة</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    
                    <td><?php echo e($subject->name); ?></td>
                    <td>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل مادة')): ?>
                        <a href="<?php echo e(route('editsub', ['id' => $subject->id])); ?>" class="btn btn-primary">تعديل</a>   
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('حذف مادة')): ?>
                        <a href="<?php echo e(route('deletesubject', ['id' => $subject->id])); ?>" class="btn btn-primary">حذف</a>     
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    </br>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/subject/show_subjects.blade.php ENDPATH**/ ?>