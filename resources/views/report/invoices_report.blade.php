@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery-ui.css') }}">
@section('title')
    تقرير الفواتير
@stop
@endsection
@section('content')



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

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>خطا</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <form action="{{ route('searchinvoices') }}" method="POST" role="search" autocomplete="off">
                    @csrf
<div class="row">
                    <div class="col-md-4">
                        <label for="department_id">تحديد القسم</label>
                        <select class="form-control select2" name="department_id">
                            <option value="" selected>كل الأقسام</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="course_id">تحديد الدورة</label>
                        <select class="form-control select2" name="course_id">
                            <option value="" selected>كل الدورات</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->subject_name}} - {{$course->teacher_name }}- {{$course->start_date }}</option>
                            @endforeach
                        </select>
                    </div>

                        <div class="col-md-4">
                            <label for="start_at">من تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input class="form-control" id="start_at" name="start_at" value="{{ $start_at ?? '' }}"
                                    placeholder="YYYY-MM-DD" type="date">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="end_at">إلى تاريخ</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input class="form-control" id="end_at" name="end_at" value="{{ $end_at ?? '' }}"
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
        @if (isset($invoices))
            <table id="studentReport" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">المعرف</th>
                        <th scope="col">اسم الطالب</th>
                        <th scope="col">رقم الدفعة</th>
                        <th scope="col">مقدار الدفعة</th>
                        <th scope="col">تاريخ الدفع</th>
                        <th scope="col">رقم الوصل</th>
                        <th scope="col">نوع الدفعة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($invoices as $invoice)
                        <?php $i++; ?>
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $students->fullname ?? ($invoice->student->fullname ?? 'غير متوفر') }}</td>
                            <!-- إضافة اسم الطالب -->
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->payment_amount }}</td>
                            <td>{{ $invoice->payment_date }}</td>
                            <td>{{ $invoice->invoice_num }}</td>
                            <td>{{ $invoice->payment_type }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        @if (isset($invoices) && count($invoices) > 0)
    <div class="text-center mt-4">
        <a href="{{ route('print.invoices', request()->all()) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-print"></i> طباعة التقرير
        </a>
    </div>
@endif

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
@endsection
@section('js')
<!-- jQuery -->
<script src="{{ asset('assets/plugins/datatable/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ asset('assets/plugins/datatable/js/jquery-ui.min.js') }}"></script>

<!-- DataTables JS -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>

<!-- JSZip (Excel export) -->
<script src="{{ asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>

<!-- PDFMake (PDF export) -->
<script src="{{ asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>

<!-- Buttons for export to PDF and Excel -->
<script src="{{ asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
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
    $(document).ready(function() {
        $('#studentReport').DataTable({
            dom: 'Bfrtip',
            buttons: [{
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
@endsection
