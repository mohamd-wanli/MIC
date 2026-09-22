<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <title>الذاتية</title>

    <style>
        body {
            font-family: "DejaVu Sans", sans-serif;
            direction: rtl;
            unicode-bidi: embed;
            text-align: right;
        }

        .page-border {
            border: 2px solid #000;
            padding: 20px;
        }

        .top-section {
            width: 100%;
            margin-bottom: 20px;
        }

        .top-section table {
            width: 100%;
        }

        .top-section td {
            vertical-align: top;
        }

        .right-top {
            text-align: right;
            font-size: 14px;
        }

        .center-top {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .left-top {
            text-align: left;
        }

        .main-table {
            width: 100%;
            border: 2px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .main-table td {
            padding: 8px;
            vertical-align: middle;
        }

        .inner-table {
            width: 100%;
            border: 2px solid #000;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .inner-table th, .inner-table td {
            padding: 6px;
            text-align: center;
            border: 1px solid #000;
        }

        .no-border-table {
            width: 100%;
            margin-top: 15px;
        }

        .no-border-table td {
            padding: 6px;
        }

        .section {
            margin-top: 20px;
        }

        .signatures {
            width: 100%;
            margin-top: 40px;
        }

        .signatures td {
            text-align: center;
            padding-top: 40px;
        }
    </style>
</head>
<body>

<div class="page-border">

    <!-- Top Section -->
    <div class="top-section">
        <table>
            <tr>
                <td class="right-top">
                    <strong>قسم الدورة:</strong> <?php echo e($course->subject_name ?? '-'); ?><br>
                    <strong>الرقم الوطني:</strong> <?php echo e($student->national_number ?? '-'); ?>

                </td>

                <td class="center-top">
                    شركة مامون الدولية<br>
                    Mamoun International Corporation<br>
                    استمارة طلب شهادة خبرة
                </td>

                <td class="left-top">
                    <img src="<?php echo e(public_path('images/logo.png')); ?>" width="100">
                </td>
            </tr>
        </table>
    </div>

    <div style="border: 2px solid #000; padding: 10px;">

        <!-- Main Info Table -->
        <table class="main-table">
           <tr>
    <td colspan="6" style="text-align:center; padding: 10px;">
        <?php if(isset($student->extraStudent) && $student->extraStudent->gender == 'ذكر'): ?>
            السيد :
        <?php elseif(isset($student->extraStudent) && $student->extraStudent->gender == 'أنثى'): ?>
            السيدة :
        <?php else: ?>
            السيد/ة :
        <?php endif; ?>
        <strong><?php echo e($student->fullname ?? '-'); ?></strong>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <?php if(isset($student->extraStudent) && $student->extraStudent->gender == 'ذكر'): ?>
            Mr.
        <?php elseif(isset($student->extraStudent) && $student->extraStudent->gender == 'أنثى'): ?>
            Miss
        <?php else: ?>
            Mr./Ms.
        <?php endif; ?>
        <?php echo e(trim(($student->extraStudent->engish_firstname ?? '') . ' ' .
               ($student->extraStudent->engish_fathername ?? '') . ' ' .
               ($student->extraStudent->english_lastname ?? '')) ?: '-'); ?>

    </td>
</tr>
            <tr>
                <td colspan="2">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:25%; text-align:right;">
                                اسم الأب: <?php echo e($student->fathername ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                اسم الأم: <?php echo e($student->extraStudent?->mothername ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                الجنسية: <?php echo e($student->extraStudent?->nationality ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                المستوى الثقافي: <?php echo e($student->extraStudent?->cultural_level ?? '-'); ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table style="width:100%; border-collapse:collapse;">
                        <tr>
                            <td style="width:25%; text-align:right;">
                                مكان وتاريخ الولادة: <?php echo e($student->extraStudent?->date_of_birth ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                رقم الهاتف: <?php echo e($student->extraStudent?->telephone ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                الموبايل: <?php echo e($student->extraStudent?->mobile ?? '-'); ?>

                            </td>
                            <td style="width:25%; text-align:right;">
                                العنوان: <?php echo e($student->extraStudent?->address ?? '-'); ?>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- Course Detailed Table - DISPLAY ONLY, NO INPUTS -->
        <table class="inner-table">
            <tr>
                <th>اسم الدورة</th>
                <th>رقم الدورة</th>
                <th>رقم الصفحة</th>
                <th>رقم العام</th>
                <th>رقم تسلسل</th>
                <th>تاريخ البدء</th>
                <th>تاريخ النهاية</th>
                <th>التقدير</th>
            </tr>
            <tr>
                <td><?php echo e($course->subject_name ?? '-'); ?></td>
                <td><?php echo e($course->coursenumber ?? '-'); ?></td>
                <td><?php echo e($course->pivot->page_number ?? '-'); ?></td>
                <td><?php echo e($course->pivot->year_number ?? '-'); ?></td>
                <td><?php echo e($course->pivot->serial_number ?? '-'); ?></td>
                <td><?php echo e($course->start_date ?? '-'); ?></td>
                <td><?php echo e($course->end_date ?? '-'); ?></td>
                <td><?php echo e($course->pivot->coursegrade ?? '-'); ?></td>
            </tr>
        </table>

        <!-- Overall Dates -->
       

        <!-- Student Signature -->
        <div class="section">
            اسم وتوقيع الطالب : <?php echo e($student->fullname ?? '-'); ?>

        </div>

        <!-- Signatures -->
        <table class="signatures">
            <tr>
                <td>منظم الشهادة</td>
                <td>مديرة الفرع</td>
                <td>محاسب الفرع</td>
                <td>مدقق الحسابات</td>
            </tr>
        </table>

    </div>

</div>

</body>
</html>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\student\profile-pdf.blade.php ENDPATH**/ ?>