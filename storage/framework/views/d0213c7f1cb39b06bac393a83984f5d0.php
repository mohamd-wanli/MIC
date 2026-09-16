
<?php $__env->startSection('title'); ?>
    قائمة الفواتير للطالب
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>
    <div class="card-header row">
        <h1 class = "title"><?php echo e($course_name); ?></h1>
        <div class="col-6">
            <table class="table table-bordered align-middle " style="width: 100%;margin-top: 5%;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">رقم الدفعة</th>
                        <th scope="col">مقدار الدفعة</th>
                        <th scope="col">تاريخ الدفع</th>
                        <th scope="col">رقم الوصل</th>
                        <th scope="col">نوع الدفعة</th>
                        <th scope="col"> العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($invoice->id); ?></td>
                            <td><?php echo e($invoice->payment_amount); ?></td>
                            <td><?php echo e($invoice->payment_date); ?></td>
                            <td><?php echo e($invoice->invoice_num); ?></td>
                            <td><?php echo e($invoice->payment_type); ?></td>
                            <td>
                                <a href="<?php echo e(route('editinv', ['id' => $invoice->id])); ?>" class="btn btn-primary">تعديل</a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="card col-6" style="width: 25%;  margin-right: 21%;">
            <div class="card-body" style="  padding: 30px 15px 20px 20px;">
                <label for="price" direction="rtl">سعر الدورة</label>
                <input type="text" value="<?php echo e($course_price); ?>" name="price" readonly direction="rtl">
                </br>
                <label for="totalpayment" direction="rtl">مجموع المدفوعات</label>
                <input type="text" value="<?php echo e($totalpayment); ?>" name="totalpayment" readonly direction="rtl">
                </br>
                <label for="remain_amount" direction="rtl">المبلغ المتبقي</label>
                <input type="text" value="<?php echo e($remain_amount); ?>" name="remain_amount" readonly direction="rtl">
                </br>
                <label for="sale" direction="rtl">الحسم</label>
                <input type="text" value="<?php echo e($sale); ?>" name="sale" readonly direction="rtl">
                </br></br>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\invoice\show_invoice.blade.php ENDPATH**/ ?>