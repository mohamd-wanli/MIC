<!-- Internal Nice-select css  -->
<?php $__env->startSection('title'); ?>
اضافة مستخدم
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
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                action="<?php echo e(route('users.store', 'test')); ?>" method="post">
                <?php echo csrf_field(); ?>

                <div class="">
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="name" required type="text" value="<?php echo e(old('name')); ?>">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="email" required="" type="text">
                        </div>
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                        <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                            name="password" required type="password">
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                            name="password_confirmation" required type="password">
                    </div>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">حالة المستخدم</label>
                        <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                            <option value="مفعل">مفعل</option>
                            <option value="غير مفعل">غير مفعل</option>
                        </select>
                    </div>
                </div>

                    <div class="col-lg-6">
                        <label class="form-label">القسم</label>
                        <select name="department_id" id="department_id" class="form-control">

                            <option value="" disabled selected>اختر القسم</option>
                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($department->id); ?>" <?php echo e(old('department_id') == $department->id ? 'selected' : ''); ?>>
                                    <?php echo e($department->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="department_id_hidden" id="department_id_hidden">


                <label>اختر الأدوار (اختياري):</label>
    <select name="roles[]" id="roles" class="form-control" multiple>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

                

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">تأكيد</button>
                </div>
            </form>
            <script>
              document.getElementById('department_id').addEventListener('change', function() {
    let departmentId = this.value;
    let rolesSelect = document.getElementById('roles');

    // تحديث الحقل المخفي بالقسم المحدد
    document.getElementById('department_id_hidden').value = departmentId;

    // إذا تم اختيار قسم، اجلب الأدوار المرتبطة به تلقائيًا
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

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/users/Add_user.blade.php ENDPATH**/ ?>