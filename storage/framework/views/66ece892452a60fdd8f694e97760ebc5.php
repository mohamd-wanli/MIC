<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تقرير مالي – <?php echo e($courseInfo->subject_name ?? 'دورة'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* ===== Screen Styles ===== */
        body {
            font-family: 'Tahoma', sans-serif;
            font-size: 14px;
            background: #fff;
            padding: 20px;
        }
        .container-fluid {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Header */
        .report-header {
            border-bottom: 3px solid #1a1a2e;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .report-header .institute-name {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a2e;
        }
        .report-header .report-title {
            font-size: 20px;
            font-weight: 700;
            color: #2d3436;
            text-align: center;
        }
        .report-header .report-date {
            font-size: 16px;
            font-weight: 600;
            text-align: left;
        }

        /* Header row — table-based (works in browsers AND PDF renderers like dompdf,
           which do not support CSS flexbox) */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .header-table td {
            vertical-align: top;
            padding: 0 5px;
        }
        .header-table .col-institute { width: 34%; text-align: right; }
        .header-table .col-title     { width: 32%; text-align: center; }
        .header-table .col-date      { width: 34%; text-align: left; }

        /* Course details box — table-based */
        .course-details {
            background: #f8faff;
            padding: 8px 12px;
            border-radius: 8px;
            margin: 15px 0 25px 0;
            border: 1px solid #e8edf5;
        }
        .course-details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .course-details-table td {
            text-align: center;
            padding: 4px 8px;
            font-size: 13px;
            white-space: nowrap;
        }

        /* Summary box (screen) — table-based */
        .summary-box {
            background: #eef2f7;
            border-radius: 10px;
            padding: 15px 20px;
            margin: 20px 0;
            border: 1px solid #dce3ed;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary-table td.stat {
            text-align: center;
            vertical-align: middle;
            font-weight: 600;
            font-size: 15px;
            width: 33.33%;
        }
        .summary-box .stat span {
            color: #1a1a2e;
            background: #fff;
            padding: 2px 12px;
            border-radius: 20px;
            margin-right: 8px;
        }
        .summary-box .stat.expected span { color: #2d6a9f; }
        .summary-box .stat.paid span { color: #27ae60; }
        .summary-box .stat.remaining span { color: #e74c3c; }

        /* Table */
        .table-report {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 10px;
        }
        .table-report thead th {
            background: #1a1a2e;
            color: #fff;
            padding: 10px 8px;
            text-align: center;
            border: 1px solid #1a1a2e;
            font-weight: 600;
            white-space: nowrap;
        }
        .table-report tbody td {
            border: 1px solid #ddd;
            padding: 8px 6px;
            text-align: center;
            vertical-align: middle;
        }
        .table-report tbody tr.summary-row {
            background: #ffffff;
            font-weight: 500;
        }
        .table-report tbody tr.summary-row td {
            border-bottom: 2px solid #1a1a2e;
        }
        .table-report tbody tr.payment-row td {
            background: #f9fafe;
            border-top: none;
            font-size: 12px;
        }
        .table-report tbody tr.payment-row td:first-child {
            border-left: none;
        }
        .table-report .student-name {
            font-weight: 600;
            color: #2d3436;
        }
        .table-report .remaining {
            font-weight: 700;
            color: #e74c3c;
        }
        .table-report .remaining.paid {
            color: #27ae60;
        }
        .table-report .payment-id {
            font-family: monospace;
            font-size: 12px;
        }
        .table-report .note-cell {
            max-width: 150px;
            font-size: 11px;
            color: #555;
        }
        .table-report tfoot td {
            background: #1a1a2e !important;
            color: #fff;
            font-weight: 700;
            padding: 10px 8px;
            border: 1px solid #1a1a2e;
        }
        .table-report tfoot td.total-label {
            text-align: left;
            padding-right: 15px;
        }

        .no-print { margin-bottom: 20px; }

        /* ===== Print Styles – Compact Header ===== */
        @media print {
            .no-print { display: none !important; }

            /* Page margins */
            @page {
                margin: 0.5cm 0.7cm;
            }

            body {
                padding: 0;
                margin: 0;
                font-size: 12px;
            }
            .container-fluid {
                padding: 0;
                max-width: 100%;
            }

            /* ---- Compact header ---- */
            .report-header {
                padding-bottom: 5px;
                margin-bottom: 8px;
                border-bottom-width: 2px;
            }
            .report-header .institute-name {
                font-size: 16px;
            }
            .report-header .report-title {
                font-size: 15px;
            }
            .report-header .report-date {
                font-size: 13px;
            }

            /* ---- Course details ---- */
            .course-details {
                padding: 4px 8px !important;
                margin: 4px 0 8px 0 !important;
                font-size: 11px !important;
                background: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border-radius: 4px;
            }
            .course-details-table td {
                font-size: 11px !important;
            }

            /* ---- Summary box (optional) ---- */
            .summary-box {
                padding: 6px 12px;
                margin: 6px 0 12px 0;
                font-size: 12px;
                background: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                border-radius: 4px;
            }
            .summary-table td.stat {
                font-size: 12px;
                white-space: nowrap;
            }

            /* ---- Table ---- */
            .table-report {
                font-size: 11px;
                margin-top: 4px;
            }
            .table-report thead th {
                padding: 4px 4px;
                font-size: 10px;
                background: #333 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .table-report tbody td {
                padding: 3px 4px;
                font-size: 10px;
            }
            .table-report tbody tr.payment-row td {
                background: #f5f5f5 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                font-size: 10px;
            }
            .table-report tfoot td {
                padding: 4px 4px;
                font-size: 10px;
            }
            .table-report .student-name {
                font-size: 11px;
            }
            .table-report .payment-id {
                font-size: 10px;
            }
            .table-report .note-cell {
                font-size: 9px;
            }
            .table-report .remaining {
                font-size: 11px;
            }

            /* Remove extra spacing */
            .mt-4 { margin-top: 4px !important; }
            .mb-3 { margin-bottom: 3px !important; }
            .mt-2 { margin-top: 2px !important; }
            .mt-3 { margin-top: 4px !important; }
            .p-3 { padding: 4px !important; }

            /* Badge in print (keep if needed) */
            .badge {
                font-size: 8px !important;
                padding: 1px 5px !important;
            }
        }

        /* ===== Responsive (screen only) ===== */
        @media screen and (max-width: 767px) {
            .table-report { font-size: 11px; }
            .table-report thead th,
            .table-report tbody td { padding: 5px 3px; }
            .report-header .institute-name,
            .report-header .report-title { font-size: 16px; }

            /* Stack the header columns on narrow screens */
            .header-table,
            .header-table tbody,
            .header-table tr,
            .header-table td {
                display: block;
                width: 100% !important;
            }
            .header-table td {
                text-align: center !important;
                padding: 4px 0;
            }

            /* Stack the course-details row on narrow screens */
            .course-details-table,
            .course-details-table tbody,
            .course-details-table tr,
            .course-details-table td {
                display: block;
                width: 100%;
            }
            .course-details-table td {
                text-align: right;
                white-space: normal;
                padding: 4px 0;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">

    <!-- Print Button (hidden in print) -->
    <div class="no-print text-start mb-3">
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> طباعة التقرير
        </button>
    </div>

    <!-- ===== HEADER ===== -->
    <div class="report-header">
        <table class="header-table">
            <tr>
                <td class="col-institute">
                    <div class="institute-name">مركز المأمون الدولي</div>
                    <small class="text-muted">فرع: الحلبوني</small><br>
                    <small class="text-muted">قسم: <?php echo e($courseInfo->department->name ?? ''); ?></small>
                </td>
                <td class="col-title">
                    <div class="report-title">تقرير مالي – نهاية الدورة</div>
                </td>
                <td class="col-date">
                    <div class="report-date"><?php echo e(date('d/m/Y')); ?></div>
                </td>
            </tr>
        </table>

        <!-- Course Details -->
        <div class="course-details">
            <table class="course-details-table">
                <tr>
                    <td><strong>رقم الدورة:</strong> <?php echo e($courseInfo->id ?? ''); ?></td>
                    <td><strong>المادة:</strong> <?php echo e($courseInfo->subject_name ?? ''); ?></td>
                    <td><strong>المدرس:</strong> <?php echo e($courseInfo->teacher_name ?? ''); ?></td>
                    <td><strong>التوقيت:</strong> <?php echo e($courseInfo->start_time ?? ''); ?></td>
                    <td><strong>تاريخ البدء:</strong> <?php echo e($courseInfo->start_date ?? ''); ?></td>
                    <td><strong>تاريخ الانتهاء:</strong> <?php echo e($courseInfo->end_date ?? ''); ?></td>
                    <td><strong>رسم الدورة:</strong> <?php echo e(number_format($courseInfo->price ?? 0, 2)); ?></td>
                </tr>
            </table>
        </div>
    </div>

    <!-- ===== TOTALS SUMMARY BOX (only if data exists) ===== -->
    <?php if(count($studentSummaries) > 0): ?>
    <div class="summary-box">
        <table class="summary-table">
            <tr>
                <td class="stat expected">
                    <i class="fas fa-coins"></i> إجمالي المستحق:
                    <span><?php echo e(number_format($totalExpected, 2)); ?></span>
                </td>
                <td class="stat paid">
                    <i class="fas fa-check-circle"></i> إجمالي المدفوع:
                    <span><?php echo e(number_format($totalPaidOverall, 2)); ?></span>
                </td>
                <td class="stat remaining">
                    <i class="fas fa-hourglass-half"></i> المتبقي:
                    <span><?php echo e(number_format($totalRemaining, 2)); ?></span>
                </td>
            </tr>
        </table>
    </div>
    <?php endif; ?>

    <!-- ===== MAIN TABLE ===== -->
    <table class="table-report">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th style="width:18%">اسم الطالب</th>
                <th style="width:10%">سعر الدورة</th>
                <th style="width:8%">الحسم</th>
                <th style="width:12%">إجمالي المدفوع</th>
                <th style="width:10%">الباقي</th>
                <th style="width:12%">رقم الدفعة</th>
                <th style="width:12%">التاريخ</th>
                <th style="width:13%">الملاحظة</th>
            </tr>
        </thead>
        <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $studentSummaries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $summary): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $student = $summary->student;
                    $course = $summary->course;
                    $totalPaid = $summary->totalPaid;
                    $remaining = $summary->remaining;
                    $discount = $course->discount ?? 0;
                    $coursePrice = $course->price ?? 0;
                ?>

                <!-- Student Summary Row -->
                <tr class="summary-row">
                    <td><?php echo e($index + 1); ?></td>
                    <td class="student-name"><?php echo e($student->fullname ?? $student->firstname . ' ' . $student->lastname); ?></td>
                    <td><?php echo e(number_format($coursePrice, 2)); ?></td>
                    <td><?php echo e(number_format($discount, 2)); ?></td>
                    <td><?php echo e(number_format($totalPaid, 2)); ?></td>
                    <td class="remaining <?php echo e($remaining <= 0 ? 'paid' : ''); ?>">
                        <?php echo e(number_format($remaining, 2)); ?>

                        <?php if($remaining <= 0): ?> <span class="badge bg-success">مكتمل</span> <?php endif; ?>
                    </td>
                    <td colspan="3"></td>
                </tr>

                <!-- Payment Detail Rows -->
                <?php $__currentLoopData = $summary->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="payment-row">
                        <td></td> <!-- serial -->
                        <td></td> <!-- student name -->
                        <td></td> <!-- course price -->
                        <td></td> <!-- discount -->
                        <td></td> <!-- total paid -->
                        <td></td> <!-- remaining -->
                        <td class="payment-id"><?php echo e($payment->id); ?></td>
                        <td><?php echo e($payment->created_at ? $payment->created_at->format('d/m/Y') : ''); ?></td>
                        <td class="note-cell"><?php echo e($payment->note ?? ''); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-3">لا توجد مدفوعات لهذه الدورة</td>
                </tr>
            <?php endif; ?>

        </tbody>
        <!-- ===== FOOTER ===== -->
        <?php if(count($studentSummaries) > 0): ?>
        <tfoot>
            <tr>
                <td colspan="2" class="total-label">الإجمالي الكلي</td>
                <td>—</td>
                <td>—</td>
                <td><?php echo e(number_format($totalPaidOverall, 2)); ?></td>
                <td><?php echo e(number_format($totalRemaining, 2)); ?></td>
                <td colspan="3"></td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>

    <!-- Footer -->
    <div class="mt-4 text-muted small text-center">
        تم إنشاء التقرير بواسطة نظام إدارة المركز – <?php echo e(now()); ?>

    </div>

</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script>
    // Optional: automatically trigger print dialog
    // window.onload = function() { window.print(); }
</script>
</body>
</html>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/report/financial_report.blade.php ENDPATH**/ ?>