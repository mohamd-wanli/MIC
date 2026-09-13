    
<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/buttons.dataTables.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/datatable/css/jquery-ui.css')); ?>">
<?php $__env->startSection('title'); ?>
    تقرير الشهادات
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
                    <form action="<?php echo e(route('searchcertifications')); ?>" method="POST" role="search" autocomplete="off">
                        <?php echo csrf_field(); ?>
                        <div class="row">

                        <div class="col-md-4">
                            <label for="page_number">رقم الصفحة</label>
                            <input type="text" name="page_number" class="form-control"
                                   value="<?php echo e(request('page_number')); ?>" placeholder="أدخل رقم الصفحة">
                        </div>
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

<?php if(isset($courseInfo)): ?>
            <div style="margin-bottom:15px; font-weight:bold; text-align:right;">
                <p style="margin:5px 0;">
                    نوع الدورة: <?php echo e($courseInfo->course_name ?? ''); ?>

                </p>
                <p style="margin:5px 0;">
                    من تاريخ <?php echo e($courseInfo->start_date ?? ''); ?> إلى <?php echo e($courseInfo->end_date ?? ''); ?>

                </p>
            </div>
        <?php endif; ?>


        <div class="table-responsive">
            <?php if(isset($students)): ?>
                <table id="studentReport" class="display nowrap" style="width:100%">
                    <thead>
                    <tr>
                        <th scope="col">المعرف</th>
                        <th scope="col">الرقم العام</th>
                        <th scope="col">الاسم الكامل</th>
                        <th scope="col">اسم الأب</th>
                        <th scope="col">اسم الأم</th>
                        <th scope="col">تاريخ الولادة</th>
                        <th scope="col">الجنسية</th>
                        <th scope="col">رقم الصفحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($student->student_id); ?></td>
                            <td><?php echo e($student->general_number); ?></td>
                            <td><?php echo e($student->fullname); ?></td>
                            <td><?php echo e($student->fathername); ?></td>
                            <td><?php echo e($student->mothername); ?></td>
                            <td><?php echo e($student->date_of_birth); ?></td>
                            <td><?php echo e($student->nationality); ?></td>
                            <td><?php echo e($student->page_number); ?></td>

                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>


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
            $('.select2').select2();
        });
    </script>
    <script>

    function formatTo12Hour(time) {
    if (!time) return '';

    let [hours, minutes] = time.split(':');
    hours = parseInt(hours);

    let formattedHours = hours % 12 || 12; // يحول 0 → 12
    return String(formattedHours).padStart(2, '0') + ':' + minutes;
}
// دالة لتحديد اسم الفرع بناءً على اسم الدورة
function getBranchName(courseName) {
    const halabouniKeywords = [
        'حلاقة نسائية', 'تجميل', 'احترافي', 'تخصصي',
        'تكنيك الوان الشعر', 'عناية بالبشرة', 'اكريليك', 'جل',
        'رموش تجميليه', 'خياطه', 'القيادة الاداريه','سبورات','ادارة الأعمال'
    ];

    // تحويل اسم الدورة إلى نص للتأكد (وتوحيد حالة الأحرف اختياري)
    const courseText = courseName || '';

    // هل تحتوي الدورة على أي كلمة من القائمة؟
    const isHalabouni = halabouniKeywords.some(keyword => courseText.includes(keyword));

    return isHalabouni ? 'حلبوني' : 'فيكتوريا';
}

        $('#studentReport').DataTable({
            dom: 'Bfrtip',
            buttons: [
                 {
                   extend: 'print',
    title: '',
    messageTop: '',
    messageBottom: '',
    customize: function (win) {
        $(win.document.body).empty();
        $(win.document.body).css('margin-top', '20px');

        // Data from PHP
        var pageNumber = '<?php echo e($page_number ?? ""); ?>';
        var year = '<?php echo e(date("Y")); ?>';
        var courseName = '<?php echo e($courseInfo->course_name ?? ""); ?>';
        var courseDays = '<?php echo e($courseInfo->days_of_course ?? ""); ?>';
        var startHour = formatTo12Hour('<?php echo e($courseInfo->start_hour ?? ""); ?>');
        var endHour = formatTo12Hour('<?php echo e($courseInfo->end_hour ?? ""); ?>');
        var branchName = getBranchName(courseName);
        var studentsData = <?php echo json_encode($students, 15, 512) ?>; // ✅ pass full students collection

        $(win.document.body).css('direction', 'rtl');
        $(win.document.body).css('font-family', 'Arial');
        $(win.document.body).css('font-size', '12px'); // base font smaller

        // Header
        $(win.document.body).prepend(`
            <div style="text-align:center; margin-bottom:10px;">
                <h2 style="margin:0; font-size:18px;">مركز المأمون الدولي للتدريب على الحرف والمهن</h2>
            </div>
            <div style="text-align:right; margin-bottom:10px;">
                <p style="margin:0;font-weight:bold;">الجمعية الحرفية لمراكز التدريب</p>
                <p style="margin:0;font-weight:bold;">المهني والحرفي بدمشق وريفها</p>
            </div>
            <div style="width:100%; overflow:hidden; margin-bottom:15px;">
                <table style="width:25%; border-collapse:collapse; float:right; font-size:12px;">
                    <tr>
                        <td style="border:1px solid black; padding:4px;">الرقم</td>
                        <td style="border:1px solid black; padding:4px;">${pageNumber}</td>
                    </tr>
                    <tr>
                        <td style="border:1px solid black; padding:4px;">السنة</td>
                        <td style="border:1px solid black; padding:4px;">${year}</td>
                    </tr>
                </table>
                <div style="float:left;">
                    <img src="/images/logo.png" style="width:100px;">
                </div>
            </div>
            <div style="text-align:center; margin:15px 0; clear:both;">
                <p style="margin:3px 0; font-weight:bold; font-size:14px;">إلى رئيس الجمعية الحرفية</p>
                <p style="margin:3px 0; font-weight:bold; font-size:14px;">نعلمكم بافتتاح دورة (${courseName}) في مركزنا (${branchName})</p>
                <p style="margin:3px 0; font-weight:bold; font-size:14px;">أيام الدورة (${courseDays})</p>
                <p style="margin:3px 0; font-weight:bold; font-size:14px;">وقت الدورة من الساعة (${startHour}) إلى الساعة (${endHour})</p>
            </div>
        `);

        // Create print table
        var newTable = $('<table border="1" style="width:100%; border-collapse:collapse; font-size:10px;"></table>');
        newTable.append(`
            <thead>
                <tr>
                    <th style="padding:3px;">المدينة</th>
                    <th style="padding:3px;">اسم المركز</th>
                    <th style="padding:3px;">اسم الدورة</th>
                    <th style="padding:3px;">الاسم والشهرة</th>
                    <th style="padding:3px;">اسم الأب</th>
                    <th style="padding:3px;">اسم الأم</th>
                    <th style="padding:3px;">تاريخ الميلاد</th>
                    <th style="padding:3px; min-width:80px;">الرقم الوطني</th>
                    <th style="padding:3px;">الجنسية</th>
                    <th style="padding:3px;">بداية الدورة</th>
                    <th style="padding:3px;">نهاية الدورة</th>
                    <th style="padding:3px;">هل الشهادة مطلوبة</th>
                    <th style="padding:3px;">اسم المدرب</th>
                    <th style="padding:3px;">الرقم العام</th>
                </tr>
            </thead>
        `);

        var tbody = $('<tbody></tbody>');
        // Loop over studentsData (from PHP)
        studentsData.forEach(function(student) {
            var eligible = student.certificate_eligible ? 'نعم' : 'لا';
            var fullname = (student.firstname || '') + ' ' + (student.lastname || '');
            tbody.append(`
                <tr>
                    <td style="padding:3px;">دمشق</td>
                    <td style="padding:3px;">مركز المأمون</td>
                    <td style="padding:3px;">${courseName}</td>
                    <td style="padding:3px;">${fullname}</td>
                    <td style="padding:3px;">${student.fathername || ''}</td>
                    <td style="padding:3px;">${student.mothername || ''}</td>
                    <td style="padding:3px;">${student.date_of_birth || ''}</td>
                    <td style="padding:3px; white-space:nowrap;">${student.national_number || ''}</td>
                    <td style="padding:3px;">${student.nationality || ''}</td>
                    <td style="padding:3px;">${student.start_date || ''}</td>
                    <td style="padding:3px;">${student.end_date || ''}</td>
                    <td style="padding:3px; font-weight:bold;">${eligible}</td>
                    <td style="padding:3px;">${student.teacher_name || ''}</td>
                    <td style="padding:3px;">${student.year_number || ''}</td>
                </tr>
            `);
        });

        newTable.append(tbody);
        $(win.document.body).find('table.dataTable').remove();
        $(win.document.body).append(newTable);

        // Footer
        newTable.after(`
            <div style="margin-top:20px; width:100%; font-size:16px; display:flex; justify-content:space-between; direction:rtl; color:#000;">
                <div style="text-align:right; font-weight:900; margin-right:40px;">قسم الشهادات</div>
                <div style="text-align:center; font-weight:900;">المهندس مأمون الحلاق<br>المدير العام لمركز المأمون الدولي</div>
            </div>
        `);

        // Print styles to ensure table fits
        $(win.document.head).append(`
            <style>
                @media print {
                    body { margin: 10px; }
                    table { border-collapse: collapse; width: 100%; }
                    th, td { border: 1px solid black; padding: 3px; text-align: center; font-size: 9px; }
                    thead { display: table-header-group; }
                    tfoot { display: table-footer-group; }
                    tr { page-break-inside: avoid; }
                }
            </style>
        `);

                    }


                },
                 {
                    text: 'Excel',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {

                        // نفس القيم المرسلة في البحث
                        let params = new URLSearchParams({
                            page_number: '<?php echo e(request('page_number')); ?>',
                            start_at: '<?php echo e(request('start_at')); ?>',
                            end_at: '<?php echo e(request('end_at')); ?>',
                            teacher_name: '<?php echo e(request('teacher_name')); ?>',
                        });

                        // التحويل إلى Route التصدير
                        window.location.href =
                            "<?php echo e(route('certifications.export.excel')); ?>?" + params.toString();
                    }
                },

                {
                    text: 'Excel (Current Page)',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {

                        let params = new URLSearchParams({
                            page_number: '<?php echo e(request('page_number')); ?>',
                            start_at: '<?php echo e(request('start_at')); ?>',
                            end_at: '<?php echo e(request('end_at')); ?>',
                            teacher_name: '<?php echo e(request('teacher_name')); ?>',
                        });

                        window.location.href =
                            "<?php echo e(route('certifications.export.excel.page')); ?>?" + params.toString();
                    }
                },
                'copy'
            ],
            pageLength: 17,
            searching: false,
            ordering: false,
            scrollX: true,
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/report/certification_report.blade.php ENDPATH**/ ?>