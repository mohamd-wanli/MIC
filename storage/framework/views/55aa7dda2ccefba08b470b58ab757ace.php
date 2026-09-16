<?php $__env->startSection('title'); ?>
    إضافة فاتورة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
        عودة
    </button>
    <form method="POST" action="<?php echo e(route('storeinv')); ?>" style="width: 80%; margin:auto;" class="needs-validation" novalidate>
        <?php echo csrf_field(); ?>
        <br>
        <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
        <input type="hidden" name="course_id" value="<?php echo e($course->id); ?>">
        <!-- تحديد القسم بناءً على المستخدم -->
        <?php if(auth()->user()->department_id == null): ?>
            <label for="department">القسم</label>
            <select class="form-control" id="department" name="department_id" required>
                <option value="">اختر القسم</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($department->id); ?>"><?php echo e($department->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        <?php else: ?>
            <input type="hidden" name="department_id" id="department_id" value="<?php echo e(auth()->user()->department_id); ?>">
        <?php endif; ?>
        <br>

        <label>اسم الدورة</label>
        <input type="text" value="<?php echo e($course->subject_name); ?>" class="form-control" readonly>
        <br>
        <label>اسم الطالب</label>
        <input type="text" value="<?php echo e($student->firstname); ?>" class="form-control" readonly>
        <br>
        <label for="sale">الحسم</label>
        <input type="text" value="<?php echo e($sale); ?>" name="sale" class="form-control" readonly>
        <br>

        <label for="paymenttype" class="form-label">نوع الدفعة</label>
        <select id="paymenttype" class="form-select form-select-lg mb-3" name="paymenttype" required>
            <option value="">اختر النوع</option>
            <?php if(auth()->user()->department_id == null || auth()->user()->department_id == 9): ?>
            <option value="رسم بطاقة امتحانية">رسم بطاقة امتحانية</option>
            <option value="رسم امتحان ">رسم امتحان </option>
            <option value="كتاب الكتروني">كتاب الكتروني</option>
                <?php endif; ?>
            <option value="قسط">قسط</option>
            <option value="قسط+رسم">قسط+رسم</option>
            <option value="قسط نهائي">قسط نهائي</option>
            <option value="رسم شهادة أمريكية">رسم شهادة أمريكية</option>
            <option value="رسم شهادة حرفية">رسم شهادة حرفية</option>
            <option value="ثمن نوطة">ثمن نوطة</option>
            <option value="وثيقة دوام">وثيقة دوام</option>
        </select>
        <br>

        <label for="paymentamount">قيمة الدفعة</label>
        <input type="number" id="paymentamount" name="paymentamount" class="form-control" required>
        <br>

        <label for="paymentdate">تاريخ الدفعة</label>
        <input type="date" id="paymentdate" name="paymentdate" class="form-control" required>
        <br>

        <label for="invoicenum">رقم الوصل</label>
        <input type="number" id="invoicenum" name="invoicenum" class="form-control" required>
        <br>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\invoice\createinv.blade.php ENDPATH**/ ?>