<?php $__env->startSection('title', 'تقرير التحصيل اليومي'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .report-card { background:#fff; border-radius:16px; border:1px solid #eef2f7; box-shadow:0 4px 25px rgba(0,0,0,.08); overflow:hidden; }
    .report-header { background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; padding:25px 30px; }
    .report-header h3 { margin:0; font-weight:700; }
    .report-header p { margin:5px 0 0; opacity:.9; }
    .report-body { padding:25px; }
    .filter-bar { display:flex; gap:12px; flex-wrap:wrap; margin-bottom:20px; align-items:end; }
    .filter-bar label { font-size:.8rem; font-weight:600; color:#2d3436; display:block; margin-bottom:4px; }
    .filter-bar input, .filter-bar select { height:42px; border-radius:10px; border:2px solid #e8edf5; padding:0 12px; min-width:150px; }
    .btn-filter { height:42px; padding:0 25px; border-radius:50px; border:none; background:linear-gradient(135deg,#667eea,#764ba2); color:#fff; font-weight:600; cursor:pointer; }
    .btn-print { height:42px; padding:0 25px; border-radius:50px; border:none; background:linear-gradient(135deg,#11998e,#38ef7d); color:#fff; font-weight:600; cursor:pointer; text-decoration:none; display:inline-flex; align-items:center; gap:6px; }
    .summary-cards { display:grid; grid-template-columns:repeat(auto-fit,minmax(200px,1fr)); gap:15px; margin-bottom:20px; }
    .summary-card { background:#f8faff; padding:18px; border-radius:12px; border:1px solid #eef2f7; text-align:center; }
    .summary-card .num { font-size:1.6rem; font-weight:700; color:#667eea; }
    .summary-card .lbl { color:#6c757d; font-size:.85rem; }
    .report-table { width:100%; border-collapse:collapse; }
    .report-table th { background:#1a1a2e; color:#fff; padding:12px; font-size:.78rem; text-align:center; }
    .report-table td { padding:10px; text-align:center; border-bottom:1px solid #f1f3f8; }
    .report-table tbody tr:hover { background:#f8faff; }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <div class="report-card">
        <div class="report-header">
            <h3><i class="fas fa-money-bill-wave"></i> تقرير التحصيل اليومي</h3>
            <p>الحركة النقدية الحقيقية حسب تاريخ التحصيل (من دفتر الإيصالات)</p>
        </div>

        <div class="report-body">

            
            <form method="GET" action="<?php echo e(route('payments.reports.collections')); ?>" class="filter-bar">
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
                <a href="<?php echo e(route('payments.reports.collections.print', request()->all())); ?>"
                   target="_blank" class="btn-print">
                    <i class="fas fa-print"></i> طباعة
                </a>
            </form>

            
            <div class="summary-cards">
                <div class="summary-card">
                    <div class="num"><?php echo e($payments->count()); ?></div>
                    <div class="lbl">عدد الإيصالات</div>
                </div>
                <div class="summary-card">
                    <div class="num"><?php echo e(number_format($payments->sum('payment_value'))); ?></div>
                    <div class="lbl">إجمالي التحصيل (ل.س)</div>
                </div>
                <div class="summary-card">
                    <div class="num"><?php echo e($daily->count()); ?></div>
                    <div class="lbl">عدد الأيام</div>
                </div>
                <div class="summary-card">
                    <div class="num">
                        <?php echo e($daily->count() ? number_format($payments->sum('payment_value') / $daily->count()) : 0); ?>

                    </div>
                    <div class="lbl">متوسط اليوم (ل.س)</div>
                </div>
            </div>

            
            <div style="overflow-x:auto;">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>تاريخ التحصيل</th>
                            <th>رقم الوصل</th>
                            <th>الطالب</th>
                            <th>الدورة</th>
                            <th>المبلغ</th>
                            <th>القسم</th>
                            <th>أُدخل بواسطة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($i + 1); ?></td>
                                <td><?php echo e($p->collected_at ? $p->collected_at->format('Y-m-d') : '—'); ?></td>
                                <td><strong style="color:#667eea;"><?php echo e($p->receipt_number ?? '—'); ?></strong></td>
                                <td><?php echo e($p->student->fullname ?? '—'); ?></td>
                                <td><?php echo e($p->course->subject_name ?? '—'); ?></td>
                                <td><strong><?php echo e(number_format($p->payment_value)); ?> ل.س</strong></td>
                                <td><?php echo e($p->department->name ?? '—'); ?></td>
                                <td><?php echo e($p->enteredBy->name ?? '—'); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="8" style="text-align:center; padding:30px; color:#adb5bd;">
                                لا توجد بيانات في هذه الفترة
                            </td></tr>
                        <?php endif; ?>
                    </tbody>
                    <?php if($payments->count()): ?>
                    <tfoot>
                        <tr style="background:#f8faff; font-weight:700;">
                            <td colspan="5">الإجمالي</td>
                            <td><?php echo e(number_format($payments->sum('payment_value'))); ?> ل.س</td>
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

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\payments\reports\collections.blade.php ENDPATH**/ ?>