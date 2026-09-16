
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تقرير المدفوعات المفصل</title>
    <style>
        /* ===== Font for Arabic ===== */
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: normal;
            src: url("<?php echo e(storage_path('fonts/DejaVuSans.ttf')); ?>") format('truetype');
        }
        @font-face {
            font-family: 'DejaVu Sans';
            font-style: normal;
            font-weight: bold;
            src: url("<?php echo e(storage_path('fonts/DejaVuSans-Bold.ttf')); ?>") format('truetype');
        }

        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            padding: 20px;
            line-height: 1.6;
            direction: rtl;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #667eea;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #667eea;
            font-size: 22px;
            margin: 0;
            font-weight: bold;
        }
        .header p {
            color: #777;
            margin: 5px 0 0;
        }

        .summary {
            display: flex;
            justify-content: space-around;
            background: #f8faff;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary .item {
            font-weight: bold;
        }
        .summary .item span {
            color: #667eea;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 9px;
            direction: rtl;
        }
        table thead {
            background: #1a1a2e;
            color: #ffffff;
        }
        table thead th {
            padding: 8px 4px;
            text-align: center;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: bold;
        }
        table tbody td {
            padding: 6px 4px;
            text-align: center;
            border-bottom: 1px solid #eef2f7;
            font-size: 9px;
        }
        table tbody tr:nth-child(even) {
            background: #f8faff;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        /* Fix for Arabic */
        .arabic-text {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            direction: rtl;
            unicode-bidi: embed;
        }
        th, td {
            unicode-bidi: embed;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="arabic-text">تقرير المدفوعات المفصل</h1>
        <p>تاريخ التقرير: <?php echo e(\Carbon\Carbon::now()->format('Y-m-d H:i')); ?></p>
        <?php if($from || $to): ?>
            <p style="font-size: 10px; color: #888;">
                الفترة: <?php echo e($from ?? 'بداية'); ?> إلى <?php echo e($to ?? 'الآن'); ?>

            </p>
        <?php endif; ?>
    </div>

    
    <div class="summary">
        <div class="item">عدد الدفعات: <span><?php echo e($totalPaymentCount); ?></span></div>
                <div class="item">المجموع الكلي: <span><?php echo e(number_format($totalSum)); ?> ل.س</span></div>
        <div class="item">عدد الطلاب: <span><?php echo e(count($reportData)); ?></span></div>
    </div>

    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>اسم الطالب</th>
                <th>رقم الدورة</th>
                <th>اسم الدورة</th>
                <th>سعر الدورة</th>
                <th>المبلغ المدفوع</th>
                <th>نوع الدفع</th>
                <th>الملاحظة</th>
                <th>تاريخ الدفع</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?>
            <?php $__empty_1 = true; $__currentLoopData = $reportData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                
                <?php $__currentLoopData = $student->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($counter++); ?></td>
                        <td><strong><?php echo e($student->student_name); ?></strong></td>
                        <td><?php echo e($student->course_number); ?></td>
                        <td><?php echo e($student->course_name); ?></td>
                        <td><?php echo e(number_format($student->course_price)); ?></td>
                        <td><strong><?php echo e(number_format($payment->payment_value)); ?></strong></td>
                        <td>
                            <?php switch($payment->payment_type):
                                case ('cash'): ?> 💰 نقدي <?php break; ?>
                                <?php case ('visa'): ?> 💳 وثيقة حضور<?php break; ?>
                                <?php case ('bank'): ?> 🏦رسوم شهادة <?php break; ?>
                                <?php default: ?> <?php echo e($payment->payment_type); ?>

                            <?php endswitch; ?>
                        </td>
                        <td><?php echo e($payment->note ?? '—'); ?></td>
                        <td><?php echo e($payment->created_at ? $payment->created_at->format('Y-m-d') : '—'); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" style="text-align: center; padding: 20px; color: #999;">
                        لا توجد مدفوعات مسجلة
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        تم إنشاء هذا التقرير بواسطة النظام - <?php echo e(\Carbon\Carbon::now()->format('Y-m-d H:i')); ?>

    </div>
</body>
</html>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\report\payments_pdf.blade.php ENDPATH**/ ?>