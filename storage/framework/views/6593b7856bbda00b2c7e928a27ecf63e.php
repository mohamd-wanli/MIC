

<?php $__env->startSection('title', 'تقرير تسليمات الصندوق'); ?>

<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('payments.reports._styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <div class="report-card">
        <div class="report-header">
            <h3><i class="fas fa-hand-holding-usd"></i> تقرير تسليمات الصندوق</h3>
            <p>الإيصالات التي تم تسليمها للمحاسب حسب تاريخ التسليم</p>
        </div>

        <div class="report-body">

            
            <form method="GET" action="<?php echo e(route('payments.reports.handovers')); ?>" class="filter-bar">
                <div>
                    <label>من تاريخ</label>
                    <input type="date" name="from" value="<?php echo e($from); ?>">
                </div>
                <div>
                    <label>إلى تاريخ</label>
                    <input type="date" name="to" value="<?php echo e($to); ?>">
                </div>
                <?php if(auth()->user()->hasRole('Admin')): ?>
                <div>
                    <label>القسم</label>
                    <select name="department_id">
                        <option value="">جميع الأقسام</option>
                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($d->id); ?>" <?php echo e(request('department_id') == $d->id ? 'selected' : ''); ?>>
                                <?php echo e($d->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <?php endif; ?>
                <button type="submit" class="btn-filter"><i class="fas fa-search"></i> بحث</button>
                <a href="<?php echo e(route('payments.reports.handovers.print', request()->all())); ?>"
                   target="_blank" class="btn-print">
                    <i class="fas fa-print"></i> طباعة
                </a>
            </form>

            
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="num"><?php echo e($payments->count()); ?></div>
                    <div class="lbl">عدد الإيصالات المسلّمة</div>
                </div>
                <div class="summary-card">
                    <div class="num"><?php echo e(number_format($payments->sum('payment_value'))); ?></div>
                    <div class="lbl">الإجمالي المسلّم (ج.م)</div>
                </div>
                <div class="summary-card">
                    <div class="num"><?php echo e($daily->count()); ?></div>
                    <div class="lbl">عدد أيام التسليم</div>
                </div>
            </div>

            
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ التسليم</th>
                            <th>رقم الوصل</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>تاريخ التحصيل</th>
                            <th>تم التسليم إلى</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($i + 1); ?></td>
                                <td><?php echo e($p->surrendered_at ? $p->surrendered_at->format('Y-m-d H:i') : '—'); ?></td>
                                <td><strong style="color:#667eea;"><?php echo e($p->receipt_number ?? '—'); ?></strong></td>
                                <td><?php echo e($p->student->fullname ?? '—'); ?></td>
                                <td><?php echo e($p->course->subject_name ?? '—'); ?></td>
                                <td><strong><?php echo e(number_format($p->payment_value)); ?> ج.م</strong></td>
                                <td><?php echo e($p->collected_at ? $p->collected_at->format('Y-m-d') : '—'); ?></td>
                                <td><?php echo e($p->surrenderedTo->name ?? '—'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="8" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد تسليمات في هذه الفترة
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if($payments->count()): ?>
                    <tfoot>
                        <tr style="background:#f8faff; font-weight:700;">
                            <td colspan="5">الإجمالي</td>
                            <td><?php echo e(number_format($payments->sum('payment_value'))); ?> ج.م</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                    <?php endif; ?>
                </table>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/payments/reports/handovers.blade.php ENDPATH**/ ?>