
<?php $__env->startSection('title'); ?>
    قائمة الامتحانات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <!--اضافة يوم امتحاني-->
    <div class="card-header pb-0">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['Admin','اضافة يوم امتحاني'])): ?>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExamdayModal">
            إضافة يوم امتحاني
        </button><br><br>   
        <?php endif; ?>    
    </div>

    <!--تعديل-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">تعديل يوم امتحاني</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" id="sessionId" name="id">
                        
                        <div class="mb-3">
                            <label for="session_scheduled_date" class="form-label">تاريخ الجلسة </label>
                            <input type="date" class="form-control" id="session_scheduled_date"
                                name="session_scheduled_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="number_of_sessions" class="form-label">عدد الجلسات</label>
                            <input type="text" class="form-control" id="number_of_sessions" name="number_of_sessions"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="session_time" class="form-label">وقت الجلسة</label>
                            <input type="text" class="form-control" id="session_time" name="session_time" required>
                        </div><br><br>
                        <button type="submit" class="btn btn-primary">تعديل</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--إضافة-->
    <div class="modal fade" id="addExamdayModal" tabindex="-1" aria-labelledby="addExamdayModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExamdayModalLabel">إضافة يوم امتحاني جديد </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addExamdayForm">
                        <?php echo csrf_field(); ?>

                        

                        <div class="mb-3">
                            <label for="session_scheduled_date" class="control-label">تاريخ الجلسة</label>
                            <input type="date" class="form-control" id="session_scheduled_date"
                                name="session_scheduled_date">

                        </div>



                        <div class="mb-3">
                            <label for="number_of_sessions" class="control-label">عدد الجلسات</label>
                            <input type="text" class="form-control" id="number_of_sessions" name="number_of_sessions">

                        </div>
                        <div class="mb-3">
                            <label for="session_time" class="control-label">وقت الجلسة</label>
                            <input type="time" class="form-control" id="session_time" name="session_time">


                        </div><br><br>

                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--حذف-->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذا اليوم الامتحاني؟
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">حذف</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card mg-b-20">

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap"
                            data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">المعرف</th>
                                    <th class="border-bottom-0">اليوم</th>
                                    <th class="border-bottom-0"> تاريخ الجلسة</th>
                                    <th class="border-bottom-0">عدد الجلسات</th>
                                    <th class="border-bottom-0">وقت الجلسة</th>
                                    <th class="border-bottom-0">الحالة</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                    $i = 0;
                                ?>
                                <?php $__currentLoopData = $exam; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $i++;
                                    ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($ex->day_of_session); ?> </td>
                                        <td><?php echo e($ex->session_scheduled_date); ?></td>
                                        <td><?php echo e($ex->number_of_sessions); ?></td>
                                        <td><?php echo e($ex->session_time); ?></td>
                                        <td>
                                            <?php if($ex->Value_Status == 2): ?>
                                                <span class="text-success"><?php echo e($ex->Status); ?></span>
                                            <?php elseif($ex->Value_Status == 1): ?>
                                                <span class="text-danger"><?php echo e($ex->Status); ?></span>
                                            <?php else: ?>
                                                <span class="text-warning"><?php echo e($ex->Status); ?></span>
                                            <?php endif; ?>

                                        </td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الجلسات')): ?>
                                            <a href="<?php echo e(route('session_number.show', $ex->id)); ?>"
                                                class="btn btn-primary">الجلسات</a>   
                                            <?php endif; ?>
                                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل يوم امتحاني')): ?>
                                           <button class="btn btn-primary btn-edit" data-id="<?php echo e($ex->id); ?>"
                                            data-day_of_session="<?php echo e($ex->day_of_session); ?>"
                                            data-session_scheduled_date="<?php echo e($ex->session_scheduled_date); ?>"
                                            data-number_of_sessions="<?php echo e($ex->number_of_sessions); ?>"
                                            data-session_time="<?php echo e($ex->session_time); ?>">
                                            تعديل
                                        </button> 
                                           <?php endif; ?>
                                          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('حذف يوم امتحاني')): ?>
                                          <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                          data-bs-target="#deleteModal" data-id="<?php echo e($ex->id); ?>">
                                          حذف
                                      </button>  
                                          <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تغيير حالة يوم امتحاني')): ?>
                                            <a href="<?php echo e(URL::route('Status_show', [$ex->id])); ?>"
                                                class="btn btn-primary">تغيير حالة اليوم الامتحاني</a>
                                            <?php endif; ?>                                          
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!--إضافة-->
    <script>
        $(document).ready(function() {
            $('#addExamdayForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    url: '<?php echo e(route('Examday.store')); ?>',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#addExamdayModal').modal('hide');
                        alert('تم إضافة اليوم الامتحاني بنجاح!');
                        setTimeout(function() {
                            window.location.href = "/Examday";
                        }, 1500);
                    },
                    error: function(error) {
                        alert('حدث خطأ أثناء إضافة اليوم الامتحاني!');
                        console.log(error);
                    }
                });
            });
        });
    </script>

    <!--حذف-->
    <script>
        var deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var examDayId = button.getAttribute('data-id');
            var form = deleteModal.querySelector('#deleteForm');

            form.action = "<?php echo e(route('Examday.destroy', ':id')); ?>".replace(':id', examDayId);
        });
    </script>

    <!--تعديل-->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = new bootstrap.Modal(document.getElementById('editModal'));

            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {

                    const sessionId = this.getAttribute('data-id');
                    // const day_of_session = this.getAttribute('data-day_of_session');
                    const session_scheduled_date = this.getAttribute('data-session_scheduled_date');
                    const number_of_sessions = this.getAttribute('data-number_of_sessions');
                    const session_time = this.getAttribute('data-session_time');

                    document.getElementById('sessionId').value = sessionId;
                    // document.getElementById('day_of_session').value = day_of_session;
                    document.getElementById('session_scheduled_date').value =
                    session_scheduled_date;
                    document.getElementById('number_of_sessions').value = number_of_sessions;
                    document.getElementById('session_time').value = session_time;

                    editModal.show();
                });
            });

            $(document).ready(function() {
                $('#editForm').on('submit', function(e) {
                    e.preventDefault();

                    const formData = {
                        id: $('#sessionId').val(),
                        day_of_session: $('#day_of_session').val(),
                        session_scheduled_date: $('#session_scheduled_date').val(),
                        number_of_sessions: $('#number_of_sessions').val(),
                        session_time: $('#session_time').val(),
                        _token: $('meta[name="csrf-token"]').attr('content')
                    };

                    $.ajax({
                        url: "<?php echo e(route('update_Examday')); ?>",
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            $('#addExamdayModal').modal('hide');
                            alert('تم تعديل اليوم الامتحاني بنجاح!');
                            setTimeout(function() {
                                window.location.href = "/Examday";
                            }, 1500);
                        },
                        error: function(error) {
                            alert('حدث خطأ أثناء تعديل اليوم الامتحاني!');
                            console.log(error);
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                            alert('An error occurred');
                        }
                    });
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\Examday\Examday.blade.php ENDPATH**/ ?>