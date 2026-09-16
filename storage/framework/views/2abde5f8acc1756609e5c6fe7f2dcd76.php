<?php $__env->startSection('title', 'المستخدمون'); ?>

<?php $__env->startSection('content'); ?>

<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="col-sm-1 col-md-2">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة مستخدم')): ?>
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('users.create')); ?>">اضافة مستخدم</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style="text-align: center;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>حالة المستخدم</th>
                                <th>نوع المستخدم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i + 1); ?></td>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td>
                                        <span class="label text-<?php echo e($user->Status == 'مفعل' ? 'success' : 'danger'); ?> d-flex">
                                            <div class="dot-label bg-<?php echo e($user->Status == 'مفعل' ? 'success' : 'danger'); ?> ml-1"></div>
                                            <?php echo e($user->Status); ?>

                                        </span>
                                    </td>
                                 <td>
    <?php if($user->roles->isNotEmpty()): ?>
        <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <span class="badge badge-success" style="color: black"><?php echo e($role->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</td>

                                    <td>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل مستخدم')): ?>
                                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-sm btn-info"
                                               title="تعديل"><i class="las la-pen"></i>تعديل</a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('حذف مستخدم')): ?>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modaldemo8"
                                                    data-user_id="<?php echo e($user->id); ?>"
                                                    data-username="<?php echo e($user->name); ?>"
                                                    title="حذف">
                                                <i class="las la-trash">حذف</i>
                                            </button>
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

    <!-- Modal effects -->
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المستخدم</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteUserForm" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body">
                        <p>هل أنت متأكد من عملية الحذف؟</p><br>
                        <input type="hidden" name="user_id" id="user_id">
                        <input class="form-control" name="username" id="username" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('modaldemo8');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-user_id');
            var username = button.getAttribute('data-username');

            document.getElementById('user_id').value = userId;
            document.getElementById('username').value = username;

            // تحديث رابط الفورم للحذف
            var form = document.getElementById('deleteUserForm');
            form.action = "<?php echo e(url('users')); ?>/" + userId;
        });
    });
</script>

<!-- DataTables & Other Scripts -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/table-data.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/notify/js/notifIt.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/notify/js/notifit-custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/modal.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\users\show_users.blade.php ENDPATH**/ ?>