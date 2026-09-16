
<?php $__env->startSection('title'); ?>
    قائمة الجلسات
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <a href=<?php echo e(url('/' . ($page = 'Search_student'))); ?> style=" color: white ;background-color:royalblue"
        class="btn btn-primary">عودة</a>
    <table cellspacing="5" cellpadding="5" style="margin:0px auto; width:500px">
        <tbody>
            <tr>
                <td>&nbsp&nbspمن التاريخ&nbsp&nbsp</td>
                <td><input type="text" id="min" name="min"></td>
                &nbsp&nbsp&nbsp&nbsp
                <td>&nbsp&nbspإلى التاريخ&nbsp&nbsp</td>
                <td><input type="text" id="max" name="max"></td>
            </tr>
        </tbody>
    </table>
    <table id="example" class="table datatable" style="width:100%">
        <thead>
            <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الاسم الأول</th>
                <th scope="col">اسم الأب</th>
                <th scope="col">الكنية</th>
                <th scope="col">الاسم الكامل</th>
                <th scope="col">الرقم الوطني</th>

            </tr>
        </thead>
        <tbody>
            <?php if(!@empty($data)): ?>
                <?php $i=1; ?>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($info->id); ?></td>
                        <td><?php echo e($info->firstname); ?></td>
                        <td><?php echo e($info->fathername); ?></td>
                        <td><?php echo e($info->lastname); ?></td>
                        <td><?php echo e($info->fullname); ?></td>
                        <td><?php echo e($info->national_number); ?></td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <?php endif; ?>
        </tbody>
        <tfoot>
            <tr>
                <th scope="col">مسلسل</th>
                <th scope="col">الاسم الأول</th>
                <th scope="col">اسم الأب</th>
                <th scope="col">الكنية</th>
                <th scope="col">الاسم الكامل</th>
                <th scope="col">الرقم الوطني</th>
            </tr>
        </tfoot>
    </table>

    <script>
        $(document).ready(function() {
            let minDate, maxDate;

            DataTable.ext.search.push(function(settings, data, dataIndex) {
                let min = minDate.val();
                let max = maxDate.val();
                let date = new Date(data[3]);

                if (
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            });

            minDate = new DateTime('#min', {
                format: 'MMMM Do YYYY'
            });
            maxDate = new DateTime('#max', {
                format: 'MMMM Do YYYY'
            });



            $('#example thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('#example thead');

            var table = $('#example').DataTable({
                language: {
                    // url: 'https://cdn.datatables.net/plug-ins/2.0.5/i18n/ar.json',
                    url: '/json/ar.json',
                },
                orderCellsTop: true,
                fixedHeader: true,
                initComplete: function() {
                    var api = this.api();

                    api
                        .columns()
                        .eq(0)
                        .each(function(colIdx) {
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" placeholder="' + title + '" />');
                            if ($(api.column(colIdx).header()).index() >= 0) {
                                $(cell).html('<input type="text" placeholder="' + title + '"/>');
                            }
                            $(
                                    'input',
                                    $('.filters th').eq($(api.column(colIdx).header()).index())
                                )
                                .off('keyup change')
                                .on('change', function(e) {
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})';

                                    var cursorPosition = this.selectionStart;
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != '' ?
                                            regexr.replace('{search}', '(((' + this.value +
                                                ')))') :
                                            '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();
                                })
                                .on('keyup', function(e) {
                                    e.stopPropagation();

                                    $(this).trigger('change');
                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                // layout: {
                //         topStart: {
                //             buttons: ['copy', 'excel', 'pdf', 'colvis']
                //         }
                //     }

            });
            document.querySelectorAll('#min, #max').forEach((el) => {
                el.addEventListener('change', () => table.draw());
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\student\advanceSearch.blade.php ENDPATH**/ ?>