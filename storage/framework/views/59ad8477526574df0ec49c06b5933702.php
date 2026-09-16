<form action="<?php echo e(route('session_number.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <label for="exam_day_id">يوم الامتحان:</label>
    <select name="exam_day_id" id="exam_day_id">
        <?php $__currentLoopData = $exam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $examDay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($examDay->id); ?>"><?php echo e($examDay->id); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <label for="session_name">اسم الجلسة:</label>
    <input type="text" name="session_name" id="session_name">

    <button type="submit">إضافة جلسة</button>
</form>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\sessionnumber\add_sessionnumber.blade.php ENDPATH**/ ?>