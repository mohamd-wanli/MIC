<?php $__env->startSection('title', 'تقرير المدفوعات المفصل'); ?>

<?php $__env->startSection('css'); ?>
<style>
    .report-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 20px 30px;
        border-radius: 16px;
        color: #ffffff;
        margin-bottom: 25px;
    }
    .report-header h3 {
        margin: 0;
        font-weight: 700;
    }
    .report-header .stats {
        display: flex;
        gap: 20px;
        margin-top: 10px;
        flex-wrap: wrap;
    }
    .report-header .stats .stat-item {
        background: rgba(255,255,255,0.15);
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.9rem;
    }
    .table-container {
        background: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 4px 25px rgba(0,0,0,0.08);
        overflow-x: auto;
        margin-bottom: 25px;
    }
    .btn-pdf {
        background: linear-gradient(135deg, #dc3545, #c82333);
        color: #ffffff;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-pdf:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.4);
        color: #ffffff;
        text-decoration: none;
    }
    .table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }
    .table-modern thead {
        background: #1a1a2e;
        color: #ffffff;
    }
    .table-modern thead th {
        padding: 12px 15px;
        text-align: center;
        border: none;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        white-space: nowrap;
    }
    .table-modern tbody td {
        padding: 10px 15px;
        text-align: center;
        border-bottom: 1px solid #eef2f7;
    }
    .table-modern tbody tr:hover {
        background: #f8faff;
    }
    .table-modern tfoot td {
        background: #1a1a2e;
        color: #ffffff;
        font-weight: 700;
        padding: 12px 15px;
        text-align: center;
        border: none;
    }
    .table-modern tfoot td.total-label {
        text-align: left;
        padding-right: 15px;
    }
    .badge {
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    .badge-success { background: #d4edda; color: #155724; }
    .badge-warning { background: #fff3cd; color: #856404; }
    .badge-info { background: #d1ecf1; color: #0c5460; }
    .badge-danger { background: #f8d7da; color: #721c24; }
    .badge-secondary { background: #e2e3e5; color: #383d41; }
    .badge-primary { background: #cce5ff; color: #004085; }
    .toggle-details {
        cursor: pointer;
        color: #667eea;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .toggle-details:hover {
        text-decoration: underline;
    }
    .details-row {
        display: none;
        background: #f8faff;
    }
    .details-row td {
        padding: 10px 15px;
    }
    .details-row.show {
        display: table-row;
    }
    .details-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.8rem;
        margin: 10px 0;
    }
    .details-table th {
        background: #e8edf5;
        padding: 6px 12px;
        text-align: center;
        font-size: 0.75rem;
        text-transform: uppercase;
    }
    .details-table td {
        padding: 6px 12px;
        text-align: center;
        border-bottom: 1px solid #eef2f7;
    }
    .status-paid { color: #28a745; font-weight: 700; }
    .status-partial { color: #f7971e; font-weight: 700; }
    .status-unpaid { color: #dc3545; font-weight: 700; }
    .filter-bar {
        display: flex;
        align-items: end;
        flex-wrap: wrap;
        gap: 14px;
    }
    .filter-bar label {
        font-size: 0.8rem;
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }
    .filter-bar input {
        border-radius: 10px;
        border: 1px solid #e0e0e0;
        padding: 8px 12px;
    }
    .filter-bar .btn-filter {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .filter-bar .btn-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    .filter-bar .btn-clear {
        background: #adb5bd;
        color: #ffffff;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
    }
    .filter-bar .btn-clear:hover {
        background: #6c757d;
        color: #ffffff;
        text-decoration: none;
    }
    .filter-bar .btn-quick {
        background: #1a1a2e;
        color: #ffffff;
        border: none;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .filter-bar .btn-quick:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(26, 26, 46, 0.4);
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    <!-- Report Header -->
    <div class="report-header">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h3><i class="fas fa-file-invoice"></i> تقرير المدفوعات المفصل</h3>
                <p style="color: rgba(255,255,255,0.85); margin: 0;">
                    عرض المدفوعات مجمعة حسب الطالب والدورة مع المتبقي
                </p>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <a href="<?php echo e(route('reports.payments.pdf', ['from' => $from ?? '', 'to' => $to ?? ''])); ?>" class="btn-pdf" target="_blank">
                    <i class="fas fa-file-pdf"></i> تحميل PDF
                </a>
                <a href="<?php echo e(route('student.index')); ?>" class="btn-modern btn-back" style="background: rgba(255,255,255,0.2); color: #fff; padding: 10px 20px; border-radius: 50px; display: inline-flex; align-items: center; gap: 8px; text-decoration: none; margin-right: 10px;">
                    <i class="fas fa-arrow-right"></i> عودة
                </a>
            </div>
        </div>
       <div class="stats">
    <span class="stat-item"><i class="fas fa-receipt"></i> إجمالي المدفوعات: <strong><?php echo e($totalPaymentCount); ?></strong></span>
    <span class="stat-item"><i class="fas fa-money-bill-wave"></i> المجموع الكلي: <strong><?php echo e(number_format($totalSum)); ?> ل.س</strong></span>
    <span class="stat-item"><i class="fas fa-users"></i> عدد الطلاب: <strong><?php echo e($reportData ? count($reportData) : 0); ?></strong></span>
</div>
    </div>

    <!-- Filter Bar -->
    <div class="table-container" style="padding: 18px 20px;">
        <form method="GET" action="<?php echo e(route('reports.payments')); ?>" class="filter-bar">
            <div>
                <label>من تاريخ</label>
                <input type="date" name="from" id="from" value="<?php echo e($from ?? ''); ?>">
            </div>
            <div>
                <label>إلى تاريخ</label>
                <input type="date" name="to" id="to" value="<?php echo e($to ?? ''); ?>">
            </div>

            <button type="submit" class="btn-filter">
                <i class="fas fa-filter"></i> تصفية
            </button>

            

            <?php if($from || $to): ?>
                <a href="<?php echo e(route('reports.payments')); ?>" class="btn-clear">
                    <i class="fas fa-times"></i> مسح التصفية
                </a>
            <?php endif; ?>
        </form>
    </div>

    <!-- Main Table -->
    <div class="table-container">
        <div style="overflow-x: auto;">
            <table class="table-modern" id="paymentsTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الطالب</th>
                        <th>رقم الدورة</th>
                        <th>اسم الدورة</th>
                        <th>سعر الدورة</th>
                        <th>إجمالي المدفوع</th>
                        <th>عدد الدفعات</th>
                        <th>المتبقي</th>
                        <th>الحالة</th>
                        <th>آخر دفعة</th>
                        <th>التفاصيل</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i = 1;
                        $sumCoursePrice = 0;
                        $sumTotalPaid = 0;
                        $sumPaymentCount = 0;
                        $sumRemaining = 0;
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $sumCoursePrice += $data->course_price;
                            $sumTotalPaid += $data->total_paid;
                            $sumPaymentCount += $data->payment_count;
                            $sumRemaining += $data->remaining;
                        ?>
                        <tr>
                            <td><?php echo e($i++); ?></td>
                            <td><strong><?php echo e($data->student_name); ?></strong></td>
                            <td><?php echo e($data->course_number); ?></td>
                            <td><?php echo e($data->course_name); ?></td>
                            <td><strong><?php echo e(number_format($data->course_price)); ?> ل.س</strong></td>
                            <td><strong><?php echo e(number_format($data->total_paid)); ?> ل.س</strong></td>
                            <td><?php echo e($data->payment_count); ?></td>
                            <td>
                                <?php if($data->remaining == 0): ?>
                                    <span class="status-paid">0 ل.س</span>
                                <?php else: ?>
                                    <span class="status-partial"><?php echo e(number_format($data->remaining)); ?> ل.س</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($data->remaining == 0): ?>
                                    <span class="badge badge-success">✅ مسدد بالكامل</span>
                                <?php elseif($data->total_paid > 0): ?>
                                    <span class="badge badge-warning">⚠️ متبقي</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">❌ غير مسدد</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($data->last_payment ? $data->last_payment->format('Y-m-d') : '—'); ?></td>
                            <td>
                                <span class="toggle-details" onclick="toggleDetails(this, 'details-<?php echo e($loop->index); ?>')">
                                    <i class="fas fa-eye"></i> عرض
                                </span>
                            </td>
                        </tr>
                        <!-- Details Row -->
                        <tr class="details-row" id="details-<?php echo e($loop->index); ?>">
                            <td colspan="11">
                                <div style="padding: 10px;">
                                    <strong style="font-size: 0.9rem; display: block; margin-bottom: 10px;">
                                        <i class="fas fa-list-ul"></i> تفاصيل الدفعات
                                    </strong>
                                    <table class="details-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>رقم الدفعة</th>
                                                <th>المبلغ</th>
                                                <th>نوع الدفع</th>
                                                <th>ملاحظات</th>
                                                <th>التاريخ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $data->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td><strong><?php echo e($payment->id); ?></strong></td>
                                                    <td><?php echo e(number_format($payment->payment_value)); ?> ل.س</td>
                                                    <td>
                                                        <?php switch($payment->payment_type):
                                                            case ('cash'): ?> 💰 نقدي <?php break; ?>
                                                            <?php case ('visa'): ?> 💳 وثيقة حضور<?php break; ?>
                                                            <?php case ('bank'): ?> 🏦 رسم شهادة<?php break; ?>
                                                            
                                                            <?php default: ?> <?php echo e($payment->payment_type); ?>

                                                        <?php endswitch; ?>
                                                    </td>
                                                    <td><?php echo e($payment->note ?? '—'); ?></td>
                                                    <td><?php echo e($payment->created_at ? $payment->created_at->format('Y-m-d H:i') : '—'); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="11" style="text-align: center; padding: 30px; color: #adb5bd;">
                                <i class="fas fa-info-circle"></i> لا توجد مدفوعات مسجلة
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
                <?php if($reportData && count($reportData) > 0): ?>
                <tfoot>
                    <tr>
                        <td colspan="4" class="total-label">الإجمالي الكلي</td>
                        <td><?php echo e(number_format($sumCoursePrice)); ?> ل.س</td>
                        <td><?php echo e(number_format($sumTotalPaid)); ?> ل.س</td>
                        <td><?php echo e($sumPaymentCount); ?></td>
                        <td><?php echo e(number_format($sumRemaining)); ?> ل.س</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    function toggleDetails(element, rowId) {
        var row = document.getElementById(rowId);
        if (row.classList.contains('show')) {
            row.classList.remove('show');
            element.innerHTML = '<i class="fas fa-eye"></i> عرض';
        } else {
            row.classList.add('show');
            element.innerHTML = '<i class="fas fa-eye-slash"></i> إخفاء';
        }
    }

    function setToday() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('from').value = today;
        document.getElementById('to').value = today;
        document.querySelector('form').submit();
    }

    function setThisWeek() {
        const now = new Date();
        const day = now.getDay();
        const start = new Date(now);
        start.setDate(now.getDate() - day + (day === 0 ? -6 : 1)); // Monday as first day
        const end = new Date(start);
        end.setDate(start.getDate() + 6);

        document.getElementById('from').value = start.toISOString().split('T')[0];
        document.getElementById('to').value = end.toISOString().split('T')[0];
        document.querySelector('form').submit();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\report\payments.blade.php ENDPATH**/ ?>