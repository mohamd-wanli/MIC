

<?php $__env->startSection('title', 'تقرير العهدة الحالية'); ?>

<?php $__env->startSection('css'); ?>
    <?php echo $__env->make('payments.reports._styles', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <div class="report-card">
        <div class="report-header">
            <h3><i class="fas fa-wallet"></i> العهدة الحالية</h3>
            <p>جميع الإيصالات التي لم يتم تسليمها للصندوق حتى الآن</p>
        </div>

        <div class="report-body">

            
            <form method="GET" action="<?php echo e(route('payments.reports.pending')); ?>" class="filter-bar">
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
                <a href="<?php echo e(route('payments.reports.pending.print', request()->all())); ?>"
                   target="_blank" class="btn-print">
                    <i class="fas fa-print"></i> طباعة
                </a>
            </form>

            
            <div class="summary-cards">
                <?php $__currentLoopData = $byDepartment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="summary-card">
                        <div class="num"><?php echo e(number_format($row['total'])); ?></div>
                        <div class="lbl">
                            <?php echo e($row['department']); ?>

                            <br>
                            <small><?php echo e($row['count']); ?> إيصال</small>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="summary-card" style="background:linear-gradient(135deg,#667eea,#764ba2); color:#fff;">
                    <div class="num" style="color:#fff;"><?php echo e(number_format($payments->sum('payment_value'))); ?></div>
                    <div class="lbl" style="color:rgba(255,255,255,.9);">الإجمالي العام (ل.س)</div>
                </div>
            </div>

            
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>رقم الوصل</th>
                            <th>تاريخ التحصيل</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>القسم</th>
                            <th>أُدخل بواسطة</th>
                            <th>الأيام منذ التحصيل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <?php
                                $days = $p->collected_at ? $p->collected_at->diffInDays(now()) : null;
                            ?>
                            <tr>
                                <td><?php echo e($i + 1); ?></td>
                                <td><strong style="color:#667eea;"><?php echo e($p->receipt_number ?? '—'); ?></strong></td>
                                <td><?php echo e($p->collected_at ? $p->collected_at->format('Y-m-d') : '—'); ?></td>
                                <td><?php echo e($p->student->fullname ?? '—'); ?></td>
                                <td><?php echo e($p->course->subject_name ?? '—'); ?></td>
                                <td><strong><?php echo e(number_format($p->payment_value)); ?> ل.س</strong></td>
                                <td><?php echo e($p->department->name ?? '—'); ?></td>
                                <td><?php echo e($p->enteredBy->name ?? '—'); ?></td>
                                <td>
                                    <?php if($days !== null): ?>
                                        <span class="status-badge <?php echo e($days > 7 ? 'danger' : 'warning'); ?>">
                                            <?php echo e($days); ?> يوم
                                        </span>
                                    <?php else: ?>
                                        —
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="9" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد إيصالات في العهدة حالياً ✅
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\payments\reports\pending.blade.php ENDPATH**/ ?>