
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
                    <form action="<?php echo e(route('Examday.store')); ?>" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col">
                                <label for="day_of_session" class="control-label">اليوم</label>
                                <input type="text" class="form-control" id="day_of_session" name="day_of_session">
                            </div>

                            <div class="col">
                                <label for="inputDate" class="control-label">تاريخ الجلسة</label>
                                <input type="date" class="form-control" id="session_scheduled_date"
                                    name="session_scheduled_date">
                            </div>

                            <div class="col">
                                <label for="inputDate" class="control-label">تاريخ طلب الجلسة</label>
                                <input type="date" class="form-control" id="session_request_date"
                                    name="session_request_date">
                            </div>


                        </div>

                        
                        <div class="row">


                            <div class="col">
                                <label for="mater" class="control-label">المادة</label>
                                <input type="text" class="form-control" id="mater" name="mater">
                            </div>

                            <div class="col">
                                <label for="number_of_sessions" class="control-label">عدد الجلسات</label>
                                <input type="text" class="form-control" id="number_of_sessions"
                                    name="number_of_sessions">
                            </div>

                            <div class="col">
                                <label for="inputTime" class="control-label">وقت الجلسة</label>
                                <input type="text" class="form-control" id="session_time" name="session_time">
                            </div>

                            <div class="col">
                                <label for="teacher_name" class="control-label"> اسم الأستاذ</label>
                                <input type="text" class="form-control" id="teacher_name" name="teacher_name">
                            </div>
                        </div>


                        

                        <div class="row">

                            <div class="col">
                                <label for="assigned_qa" class="control-label">اسم المراقب </label>
                                <input type="text" class="form-control" id="assigned_qa" name="assigned_qa">
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

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\Examday\add_examday.blade.php ENDPATH**/ ?>