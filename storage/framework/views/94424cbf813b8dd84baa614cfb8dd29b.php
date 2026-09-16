
<?php $__env->startSection('title'); ?>
    اضافة طالب
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(session()->has('Add')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo e(session()->get('Add')); ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?php echo e(route('ICDL.store')); ?>" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        <?php echo e(csrf_field()); ?>

                        

                        <div class="row">
                            <div class="col">
                                <label for="skill_no" class="control-label">رقم بطاقة المهارات</label>
                                <input type="text" class="form-control" id="skill_no" name="skill_no">
                            </div>

                            <div class="col">
                                <label for="employment" class="control-label">توظيف</label>
                                <input type="text" class="form-control" id="employment" name="employment">
                            </div>

                            <div class="col">
                                <label for="test_language" class="control-label">اللغة</label>
                                <input type="text" class="form-control" id="test_language" name="test_language">
                            </div>

                            <div class="col">
                                <label for="image" class="col-sm-2 col-form-label"
                                    style="font-weight: bold; ">صورة</label>
                                <input type="file" class="form-control" name="image" id="image"
                                    style="border-color: black;">
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                        </div>

                        
                        <div class="row">


                            <div class="col">
                                <label for="password" class="control-label"> كلمة السر</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>

                            <div class="col">
                                <label for="version" class="control-label">اصدار</label>
                                <input type="text" class="form-control" id="version" name="version">
                            </div>

                            <div class="col">
                                <label for="croups" class="control-label">اسم المركز </label>
                                <input type="text" class="form-control" id="croups" name="croups">
                            </div>

                            <div class="col">
                                <label for="exam_fee" class="control-label">رسم الامتحان</label>
                                <input type="text" class="form-control" id="exam_fee" name="exam_fee">
                            </div>
                        </div>


                        

                        <div class="row">

                            <div class="col">
                                <label for="course_number" class="control-label">رقم الكورس</label>
                                <input type="text" class="form-control" id="course_number" name="course_number">
                            </div>


                        </div><br><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">حفظ البيانات</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\Student_Icdl\add_icdl.blade.php ENDPATH**/ ?>