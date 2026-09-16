<?php $__env->startSection('title'); ?>
    البحث برقم الصفحة
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
    عودة
</button>
    <?php if(session('success')): ?>
        <p style="color:green"><?php echo e(session('success')); ?></p>
    <?php elseif(session('delete')): ?>
        <p style="color:red"><?php echo e(session('delete')); ?></p>
    <?php elseif(session('error')): ?>
        <p style="color:red"><?php echo e(session('error')); ?> </p>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <style>
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }

        table {
            white-space: nowrap;
        }

        thead {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        .small-input {
            width: 90px;
            text-align: center;
        }

        .highlight {
            background-color: #eef5ff;
        }
    </style>



<form method="GET" action="<?php echo e(route('students.search')); ?>">
    <label for="page_number">رقم الصفحة:</label>
    <input type="text" name="page_number" id="page_number" value="<?php echo e(request('page_number')); ?>">

    <label for="year">السنة:</label>
    <select name="year" id="year">
        <option value="">اختر السنة</option>
        <?php $__currentLoopData = $availableYears; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $availableYear): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($availableYear); ?>" <?php echo e(request('year') == $availableYear ? 'selected' : ''); ?>>
                <?php echo e($availableYear); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <button type="submit" class="btn btn-primary">بحث</button>
</form>

<?php if(request()->has('page_number') || request()->has('year')): ?>
    <?php if(isset($students) && $students->isEmpty()): ?>
        <p>لا يوجد طلاب برقم الصفحة <?php echo e(request('page_number')); ?></p>
    <?php elseif(isset($students)): ?>
        <form action="<?php echo e(route('saveCertificateData')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>اسم الأب</th>
                            <th>اسم الأم</th>
                            <th>المواليد</th>
                            <th>الجنسية</th>
                            <th>الدورة</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>الشهادة</th>
                            <th>المجموعة</th>
                            <th>الإدخال</th>
                            <th>حالة طلب الشهادة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="<?php echo e($index % 2 == 0 ? 'highlight' : ''); ?>">
                                <td><?php echo e($student->general_number); ?></td>
                                <td><?php echo e($student->fullname); ?></td>
                                <td><?php echo e($student->fathername); ?></td>
                                <td><?php echo e($student->mothername); ?></td>
                                <td><?php echo e($student->date_of_birth); ?></td>
                                <td><?php echo e($student->nationality); ?></td>
                                <td><?php echo e($student->course_name); ?></td>
                                <td><?php echo e($student->course_start_date); ?></td>
                                <td><?php echo e($student->course_end_date); ?></td>

                                <td>
                                    <input type="text" name="certificate_number[<?php echo e($student->id); ?>]"
                                        class="form-control small-input"
                                        value="<?php echo e(old('certificate_number', $student->certificate_number ?? '')); ?>">
                                </td>

                                <td>
                                    <input type="text" name="group_number[<?php echo e($student->id); ?>]"
                                        class="form-control small-input"
                                        value="<?php echo e(old('group_number', $student->group_number ?? '')); ?>">
                                </td>

                                <td>
                                    <input type="text" name="input_date[<?php echo e($student->id); ?>]"
                                        class="form-control small-input"
                                        value="<?php echo e(old('input_date', $student->input_date ?? '')); ?>">
                                </td>
                                <td class="text-center"><?php echo e($student->request_status); ?></td> <!-- ✅ عرض حالة الطلب -->

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">حفظ جميع البيانات</button>
        </form>
    <?php endif; ?>
<?php endif; ?>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\course\students.blade.php ENDPATH**/ ?>