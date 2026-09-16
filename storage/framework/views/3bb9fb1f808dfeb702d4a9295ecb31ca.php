
<?php $__env->startSection('title'); ?>
    قائمة الامتحانات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">

                    <a href="/ICDL/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; اضافة امتحان</a><br><br>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">skill_no</th>
                                    <th class="border-bottom-0"> employment</th>
                                    <th class="border-bottom-0">test_language </th>
                                    <th class="border-bottom-0">image</th>
                                    <th class="border-bottom-0">password</th>
                                    <th class="border-bottom-0">version</th>
                                    <th class="border-bottom-0">croups</th>
                                    <th class="border-bottom-0">exam_fee</th>
                                    <th class="border-bottom-0">course_number</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                <?php $__currentLoopData = $exam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icdl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($icdl->skill_no); ?> </td>
                                        <td><?php echo e($icdl->employment); ?></td>
                                        <td><?php echo e($icdl->test_language); ?></td>
                                        <td><?php echo e($icdl->image); ?></td>
                                        
                                        <td><?php echo e($icdl->password); ?></td>
                                        <td><?php echo e($icdl->version); ?></td>
                                        <td><?php echo e($icdl->croups); ?></td>
                                        <td><?php echo e($icdl->exam_fee); ?></td>
                                        <td><?php echo e($icdl->course_number); ?></td>
                                        

                                        <td>
                                            <div class="flex items-center justify-end px-3">
                                                <a href="<?php echo e(route('ICDL.show', $icdl->student->id)); ?>"
                                                    class="ml-1 bg-gray-600 block p-1 border border-gray-600 rounded-sm"
                                                    title="assign subject">
                                                    <svg class="h-3 w-3 fill-current text-gray-100" aria-hidden="true"
                                                        focusable="false" data-prefix="far" data-icon="eye"
                                                        class="svg-inline--fa fa-eye fa-w-18" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                        <path fill="currentColor"
                                                            d="M288 144a110.94 110.94 0 0 0-31.24 5 55.4 55.4 0 0 1 7.24 27 56 56 0 0 1-56 56 55.4 55.4 0 0 1-27-7.24A111.71 111.71 0 1 0 288 144zm284.52 97.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400c-98.65 0-189.09-55-237.93-144C98.91 167 189.34 112 288 112s189.09 55 237.93 144C477.1 345 386.66 400 288 400z">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>

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

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\Student_Icdl\Icdl.blade.php ENDPATH**/ ?>