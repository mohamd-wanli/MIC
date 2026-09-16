<?php $__env->startSection('css'); ?>
<!-- Internal Nice-select css  -->
<link href="<?php echo e(URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')); ?>" rel="stylesheet" />
<?php $__env->startSection('title'); ?>
تعديل مستخدم
<?php $__env->stopSection(); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-header'); ?>
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        <?php if(count($errors) > 0): ?>
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="<?php echo e(route('users.index')); ?>">رجوع</a>
                    </div>
                </div><br>

                <form action="<?php echo e(route('users.update', $user->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name">اسم المستخدم: <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email">البريد الإلكتروني: <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password">كلمة المرور الجديدة (اتركها فارغة إذا لم ترغب في تغييرها):</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="confirm-password">تأكيد كلمة المرور:</label>
                            <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>حالة المستخدم:</label>
                            <select name="Status" class="form-control">
                                <option value="مفعل" <?php echo e($user->Status == 'مفعل' ? 'selected' : ''); ?>>مفعل</option>
                                <option value="غير مفعل" <?php echo e($user->Status == 'غير مفعل' ? 'selected' : ''); ?>>غير مفعل</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">القسم</label>
                            <select name="department_id" id="department_id" class="form-control">
                                <!-- الخيار "اختر القسم" سيكون الخيار الأول دائما، وإذا كان هناك قسم مختار، سيتم تحديده -->
                                <option value="" <?php echo e(is_null($user->department_id) ? 'selected' : ''); ?>>اختر القسم</option>

                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->id); ?>"
                                        <?php echo e(old('department_id', $user->department_id) == $department->id ? 'selected' : ''); ?>>
                                        <?php echo e($department->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>



                        <div class="col-lg-6">
                            <label>اختر الأدوار (اختياري):</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($role->id); ?>" <?php echo e(in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : ''); ?>>
                                        <?php echo e($role->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
                <script>
                    document.getElementById('department_id').addEventListener('change', function() {
                        let departmentId = this.value;
                        let rolesSelect = document.getElementById('roles');

                        if (departmentId) {
                            fetch(`/get-department-roles/${departmentId}`)
                                .then(response => response.json())
                                .then(data => {
                                    rolesSelect.innerHTML = ""; // تفريغ الخيارات الحالية
                                    data.roles.forEach(role => {
                                        let option = new Option(role.name, role.id);
                                        rolesSelect.add(option);
                                    });
                                });
                        }
                    });
                    </script>

            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('assets/js/jquery-3.6.0.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/parsleyjs/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/form-validation.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\users\edit.blade.php ENDPATH**/ ?>