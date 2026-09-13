@extends('layouts.master')
@section('title')
    قائمة الجلسات
@endsection
@section('content')
    <a href={{ url('/' . ($page = 'Search_student')) }} style=" color: white ;background-color:royalblue"
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
            @if (!@empty($data))
                @php $i=1; @endphp
                @foreach ($data as $info)
                    <tr>
                        <td>{{ $info->id }}</td>
                        <td>{{ $info->firstname }}</td>
                        <td>{{ $info->fathername }}</td>
                        <td>{{ $info->lastname }}</td>
                        <td>{{ $info->fullname }}</td>
                        <td>{{ $info->national_number }}</td>
                    </tr>
                    @php $i++; @endphp
                @endforeach
            @else
            @endif
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

@endsection
