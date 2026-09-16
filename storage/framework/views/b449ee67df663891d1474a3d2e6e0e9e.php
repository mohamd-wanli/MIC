
<?php $__env->startSection('title'); ?>
    إضافة مدرس
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <form method="post" action="<?php echo e(route('storeteacher')); ?>" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        <?php echo csrf_field(); ?>
        <label for="name">الاسم الأول</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأول
        </div>
        <label for="lastname">الاسم الأخير</label>
        <input type="text" class="form-control" id="lastname" name="lastname" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأخير
        </div>
        <label for="phone_num">الموبايل</label>
        <input type="text" class="form-control" id="phone_num" name="phone_num" required>
        <div class="invalid-feedback">
            الرجاء ادخال رقم الموبايل
        </div>

        <div class="row row-cols-2">
            <div class="col">
                <label for="salary">الراتب</label>
                <input type="number" id="salary" name="salary" class="form-control" required>
            </div>
            <div class="col">
                <select id="salarytype" name="salarytype" style="  margin-top: 7%;">
                    <option value="مقطوع" selected>مقطوع</option>
                    <option value="%">نسبة(%)</option>
                </select>
            </div>
        </div>
        <label for="subject" class="form-label">المواد</label>
        <select id="subject" class="form-select" name="subject[]" multiple="multiple" required>
            <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($subject->name); ?>"><?php echo e($subject->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

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
        
        </br> </br>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
    </br>

    <script>
        $(document).ready(function() {
            $('.form-select').select2();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\teacher\create_teacher.blade.php ENDPATH**/ ?>