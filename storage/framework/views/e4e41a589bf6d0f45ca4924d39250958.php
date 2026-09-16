
<?php $__env->startSection('title'); ?>
    تعديل مدرس
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <form action="<?php echo e(route('updateteacher', $teacher->id)); ?>" method="POST" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        <?php echo csrf_field(); ?>
        <label for="name">الاسم الأول</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo e($teacher->name); ?>" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأول
        </div>
        <label for="lastname">الاسم الأخير </label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo e($teacher->lastname); ?>" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأخير
        </div>
        <label for="phone_num">الموبايل</label>
        <input type="text" class="form-control" id="phone_num" name="phone_num" value="<?php echo e($teacher->phone_num); ?>"
            required>
        <div class="invalid-feedback">
            الرجاء ادخال رقم الموبايل
        </div>
        <div class="row row-cols-2">
            <div class="col">
                <label for="salary">الراتب</label>
                <input type="number" id="salary" name="salary" class="form-control" value="<?php echo e($teacher->salary); ?>"
                    required>
                <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="error" style="color: red"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col">
                <select id="salarytype" name="salarytype" style="  margin-top: 7%;" required>
                    <?php if($teacher->salarytype == '%'): ?>
                        <option value="%" selected><?php echo e($teacher->salarytype); ?></option>
                        <option value="مقطوع">مقطوع</option>
                    <?php else: ?>
                        <option value="مقطوع" selected>مقطوع</option>
                        <option value="%">نسبة(%)</option>
                    <?php endif; ?>
                </select>
            </div>
        </div>
        <label for="subject" class="form-label">المواد</label>
        <select id="subject" class="form-select" name="subject[]" multiple="multiple">
            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(in_array($subject->id, $subject_id)): ?>
                    <option value="<?php echo e($subject->name); ?>" selected> <?php echo e($subject->name); ?></option>
                <?php else: ?>
                    <option value="<?php echo e($subject->name); ?>"><?php echo e($subject->name); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        </br> </br>
        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\teacher\editteacher.blade.php ENDPATH**/ ?>