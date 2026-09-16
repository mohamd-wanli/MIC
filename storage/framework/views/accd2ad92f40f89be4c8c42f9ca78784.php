<?php $__env->startSection('title', 'العهدة الحالية'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <div class="card" style="border:none; border-radius:16px; box-shadow:0 4px 25px rgba(0,0,0,.08);">
        <div class="card-body">

            <h3 style="font-weight:700;">
                <i class="fas fa-wallet" style="color:#667eea;"></i>
                النقدية في العهدة
            </h3>
            <p style="color:#6c757d;">إجمالي الإيصالات التي لم يتم تسليمها للصندوق بعد</p>

            <table class="table" style="margin-top:20px;">
                <thead style="background:#1a1a2e; color:#fff;">
                    <tr>
                        <th>القسم</th>
                        <th>عدد الإيصالات</th>
                        <th>الإجمالي (ل.س)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($row->department->name ?? 'غير محدد'); ?></td>
                            <td><?php echo e($row->receipts_count); ?></td>
                            <td><strong><?php echo e(number_format($row->total_amount)); ?> ل.س</strong></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="3" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد إيصالات في العهدة حالياً
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\payments\cash_in_hand.blade.php ENDPATH**/ ?>