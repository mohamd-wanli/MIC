
<?php $__env->startSection('title'); ?>
    قائمة الامتحانات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href=<?php echo e(url('/' . ($page = 'Examday'))); ?> style=" color: white ;background-color:royalblue"
                        class="btn btn-primary">عودة</a>
                    

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">المعرف</th>
                                    <th class="border-bottom-0"> يوم الامتحان</th>
                                    <th class="border-bottom-0">ساعة بداية الامتحان</th>
                                    <th class="border-bottom-0"> ساعة نهاية الامتحان </th>
                                    <th class="border-bottom-0">عدد الطلاب الحاليين</th>
                                    <th class="border-bottom-0">عدد الطلاب المتبقيين للوصول إلى 14</th>
                                    <th class="border-bottom-0">الطلاب</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                <?php $__currentLoopData = $session; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $se): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $i++;
                                        $currentStudentCount = $se->students->count();
                                        $remainingStudents = max(14 - $currentStudentCount, 0);
                                    ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($se->examday->session_scheduled_date); ?></td>
                                        <td><?php echo e($se->start_of_test); ?></td>
                                        <td><?php echo e($se->end_of_test); ?></td>
                                        <td><?php echo e($currentStudentCount); ?></td>
                                        <td><?php echo e($remainingStudents); ?></td>
                                        <td>
                                            <a type="button" class="btn btn-link"
                                                href="<?php echo e(route('sessions.show', $se->id)); ?>">الطلاب في الجلسة</a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\sessionnumber\sessionnumber.blade.php ENDPATH**/ ?>