<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title><?php echo e($title); ?></title>
    <style>
        body { font-family: "DejaVu Sans", sans-serif; padding: 20px; direction: rtl; font-size: 13px; }
        h2   { text-align:center; margin: 0 0 5px; }
        .meta{ text-align:center; color:#555; margin-bottom: 15px; font-size: 12px; }
        .summary { display:flex; justify-content:space-around; margin: 15px 0; padding:10px; border:1px solid #000; }
        .summary div { text-align:center; }
        .summary .num { font-size: 16px; font-weight: bold; }
        table { width:100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border:1px solid #000; padding:6px; text-align:center; font-size: 11px; }
        th { background:#f2f2f2; }
        tfoot tr { background:#f2f2f2; font-weight: bold; }
        .signatures { margin-top: 60px; display:flex; justify-content:space-between; }
        .signatures div { width: 40%; text-align:center; border-top: 1px solid #000; padding-top: 8px; }

        @media print {
            @page { size: A4 landscape; margin: 10mm; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <h2>مركز المأمون الدولي</h2>
<div class="meta">
    <?php echo e($title); ?><br>
    <?php echo e($subtitle); ?><br>

    <?php if(request('department_id')): ?>
        <?php
            $deptName = \App\Models\Department::find(request('department_id'))?->name;
        ?>
        <strong>القسم: <?php echo e($deptName); ?></strong><br>
    <?php endif; ?>

    تاريخ الطباعة: <?php echo e(now()->format('Y-m-d H:i')); ?>

    — بواسطة: <?php echo e(auth()->user()->name); ?>

</div>

    <div class="summary">
        <div>
            <div class="num"><?php echo e($payments->count()); ?></div>
            <div>عدد الإيصالات</div>
        </div>
        <div>
            <div class="num"><?php echo e(number_format($payments->sum('payment_value'))); ?> ل.س</div>
            <div>الإجمالي</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>رقم الوصل</th>
                
                <th>الطالب</th>
                   <th>الدورة</th>
                 <th>رقم الدورة</th>
                <th>المبلغ</th>
                <th>الحسم</th>
                <th>نوع الدفعة</th>

                <?php if(isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at): ?>
                    <th>تاريخ التسليم</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td><?php echo e($p->receipt_number ?? '—'); ?></td>
                    
                      <td><?php echo e($p->student->fullname ?? '—'); ?></td>
                    <td><?php echo e($p->course->subject_name ?? '—'); ?></td>
                   <td><?php echo e($p->course->coursenumber ?? '—'); ?></td>
                    <td><?php echo e(number_format($p->payment_value)); ?> ل.س</td>
                    <td><?php echo e($p->discount); ?></td>
                    <td><?php echo e($p->payment_category); ?></td>
                    <?php if(isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at): ?>
                        <td><?php echo e($p->surrendered_at ? $p->surrendered_at->format('Y-m-d H:i') : '—'); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">الإجمالي</td>
                <td><?php echo e(number_format($payments->sum('payment_value'))); ?> ل.س</td>
                <td colspan="<?php echo e(isset($payments->first()->surrendered_at) && $payments->first()->surrendered_at ? 2 : 1); ?>"></td>
            </tr>
        </tfoot>
    </table>

    <div class="signatures">
        <div>توقيع المُسلِّم</div>
        <div>توقيع المستلم</div>
    </div>

</body>
</html>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/payments/reports/print_document.blade.php ENDPATH**/ ?>