<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery-ui.css')); ?>">
<?php $__env->startSection('title'); ?>
    تقرير العلامات
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
        padding: 8px;
        border: 1px solid #ddd;
    }


    th {
        background-color: #f2f2f2;
    }
</style>

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

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <form action="<?php echo e(route('searchmark')); ?>" method="POST" role="search" autocomplete="off">
                    <?php echo csrf_field(); ?>
                    <div class="row">

                        <div class="col-md-4">
                            <label for="start_at">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input class="form-control" id="start_at" name="start_at" value="<?php echo e($start_at ?? ''); ?>"
                                    placeholder="YYYY-MM-DD" type="date">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="end_at">إلى تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input class="form-control" id="end_at" name="end_at" value="<?php echo e($end_at ?? ''); ?>"
                                    placeholder="YYYY-MM-DD" type="date">
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit">بحث</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive">
        <?php if(isset($students) && $students->isNotEmpty()): ?>
            <table id="markReport" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>الاسم الكامل</th>
                        <th>المادة</th>
                        <th>العلامة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($student['fullname']); ?></td>
                            <td><?php echo e($student['meter']); ?></td>
                            <td><?php echo e($student['mark']); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>لا توجد بيانات متاحة.</p>
        <?php endif; ?>
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
<!-- jQuery -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/jquery-3.6.0.min.js')); ?>"></script>

<script src="<?php echo e(asset('assets/plugins/datatable/js/jquery-ui.min.js')); ?>"></script>

<!-- DataTables JS -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/dataTables.buttons.min.js')); ?>"></script>

<!-- JSZip (Excel export) -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/jszip.min.js')); ?>"></script>

<!-- PDFMake (PDF export) -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/pdfmake.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/vfs_fonts.js')); ?>"></script>

<!-- Buttons for export to PDF and Excel -->
<script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.html5.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/datatable/js/buttons.print.min.js')); ?>"></script>
<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>

<script>
    $(document).ready(function() {
        $("#datepicker").datepicker();
    });
</script>


<script>
    $(document).ready(function() {
        $('#markReport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'print',
                    text: 'طباعة',
                    title: 'تقرير الطلاب',
                    messageTop: 'قائمة بالطلاب الموجودين في الجلسة المختارة',
                    customize: function(win) {

                        $(win.document.body)
                            .css('direction', 'rtl')
                            .prepend(
                                '<h3 style="text-align:center">تقرير جلسات</h3>'
                            );


                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', '12px')
                            .css('border', '1px solid black');


                        $(win.document.body).find('thead th').css('background-color',
                        '#f2f2f2');
                    }
                },
                {
                    extend: 'pdf',
                    title: 'Student Report',
                    messageTop: 'This is a generated PDF of the student report',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                {
                    extend: 'excel',
                    title: 'Student Report',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'copy'
            ],
            "pageLength": 17,
            "searching": true,
            "ordering": true,
            "scrollX": true,
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\report\mark_report.blade.php ENDPATH**/ ?>