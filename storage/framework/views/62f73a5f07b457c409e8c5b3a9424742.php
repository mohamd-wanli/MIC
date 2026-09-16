
<?php $__env->startSection('title'); ?>
    تعديل فاتورة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <form method="post"action="<?php echo e(route('updateinv', $inv->id)); ?>" style="width: 80%; margin:auto;" class="needs-validation"
        novalidate>
        <?php echo csrf_field(); ?>
        <br>
        <label for="coname">اسم الدورة</label>
        <input type="text" value="<?php echo e($inv->course_name); ?>" name="coname" class="form-control" readonly>
        <br>
        <label for="stuname">اسم الطالب</label>
        <input type="text" value="<?php echo e($inv->student_name); ?>" name="stuname" class="form-control" readonly>
        <br>
        <label for="sale">الحسم</label>
        <input type="text" value="<?php echo e($sale); ?>" name="sale" class="form-control" readonly>
        <br>
        <label for="paymenttype" class="form-label">نوع الدفعة</label>
        <select id="paymenttype" class="form-select form-select-lg mb-3" name="paymenttype" required>
            <option value="<?php echo e($inv->payment_type); ?>" selected><?php echo e($inv->payment_type); ?></option>
            <?php if($inv->payment_type != 'قسط'): ?>
                <option value="قسط">قسط</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'قسط+رسم'): ?>
                <option value="قسط+رسم">قسط+رسم</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'قسط نهائي'): ?>
                <option value="قسط نهائي">قسط نهائي</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'رسم شهادة أمريكية'): ?>
                <option value="رسم شهادة أمريكية">رسم شهادة أمريكية</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'رسم شهادة حرفية'): ?>
                <option value="رسم شهادة حرفية">رسم شهادة حرفية</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'ثمن نوطة'): ?>
                <option value="ثمن نوطة">ثمن نوطة</option>
            <?php endif; ?>
            <?php if($inv->payment_type != 'وثيقة دوام'): ?>
                <option value="وثيقة دوام">وثيقة دوام</option>
            <?php endif; ?>
        </select>
        
        <br>
        <label for="paymentamount">قيمة الدفعة</label>
        <input type="number" id="paymentamount" name="paymentamount" class="form-control"
            value="<?php echo e($inv->payment_amount); ?>" required>
        
        <br>
        <label for="paymentdate">تاريخ الدفعة</label>
        <input type="date" id="paymentdate" name="paymentdate" class="form-control" value="<?php echo e($inv->payment_date); ?>"
            required>
        
        <br>
        <label for="invoicenum">رقم الوصل</label>
        <input type="number" id="invoicenum" name="invoicenum" class="form-control" value="<?php echo e($inv->invoice_num); ?>"
            required>
        
        <br>
        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\invoice\edit_inv.blade.php ENDPATH**/ ?>