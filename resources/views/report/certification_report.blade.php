@extends('layouts.master')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatable/css/jquery-ui.css') }}">
@section('title')
    تقرير الشهادات
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
            font-size: 22px;
        }

        th {
            background-color: #f2f2f2;
            font-size: 16px;   /* ← bigger header font */
            font-weight: 700;
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
                    <form action="{{ route('searchcertifications') }}" method="POST" role="search" autocomplete="off">
                        @csrf
                        <div class="row">

                        <div class="col-md-4">
                            <label for="page_number">رقم الصفحة</label>
                            <input type="text" name="page_number" class="form-control"
                                   value="{{ request('page_number') }}" placeholder="أدخل رقم الصفحة">
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

@if(isset($courseInfo))
            <div style="margin-bottom:15px; font-weight:bold; text-align:right;">
                <p style="margin:5px 0;">
                    نوع الدورة: {{ $courseInfo->course_name ?? '' }}
                </p>
                <p style="margin:5px 0;">
                    من تاريخ {{ $courseInfo->start_date ?? '' }} إلى {{ $courseInfo->end_date ?? '' }}
                </p>
            </div>
        @endif


        <div class="table-responsive">
            @if (isset($students))
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
                    @foreach ($students as $student)
                        <tr>
                            <td>{{ $student->student_id }}</td>
                            <td>{{ $student->general_number }}</td>
                            <td>{{ $student->fullname }}</td>
                            <td>{{ $student->fathername }}</td>
                            <td>{{ $student->mothername }}</td>
                            <td>{{ $student->date_of_birth }}</td>
                            <td>{{ $student->nationality }}</td>
                            <td>{{ $student->page_number }}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>


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

    function formatTo12Hour(time) {
    if (!time) return '';

    let [hours, minutes] = time.split(':');
    hours = parseInt(hours);

    let formattedHours = hours % 12 || 12; // يحول 0 → 12
    return String(formattedHours).padStart(2, '0') + ':' + minutes;
}
//
function getBranchName(courseName) {
    const halabouniKeywords = [
        'حلاقة نسائية', 'تجميل', 'احترافي', 'تخصصي',    'حلاقة نسائية', 'حلاقه نسائية', 'حلاقة نسائيه', 'حلاقه نسائيه',

        'تكنيك الوان الشعر', 'عناية بالبشرة', 'اكريليك', 'جل','عناية بشرة',
        'رموش تجميليه', 'خياطه', 'القيادة الاداريه','قيادة ادارية','سبورات'
        ,'ادارة الأعمال','قيادة إدارية','قيادة إدارية'
        ,'ادارة الاعمال','ادارة الأعمال','ادارة الاعمال',
        'ادارة الأعمال','ادارة الاعمال','ادارة الأعمال',
      ' احترافي', 'إحترافي', 'أحترافي',
          'تكنيك الوان الشعر', 'تكنيك ألوان الشعر', 'تكنيك الوان شعر',
           'عنايه بالبشره', 'عناية بالبشره',
               'اكريليك', 'أكريليك', 'إكريليك', 'اكريللك', 'أكريللك',
  'رموش تجميليه', 'رموش تجميلية', 'رموش تجميلى', 'رموش تجميلي',
    'رموش تجميله', 'رموش تجميلة', 'الرموش التجميليه', 'الرموش التجميلة',
    'سهرة وعرايسي','TOT'


    ];   // تحويل اسم الدورة إلى نص للتأكد (وتوحيد حالة الأحرف اختياري)
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
//     customize: function (win) {

//         win.document.title = 'تقرير القوائم';

//         $(win.document.body).empty();
//         $(win.document.body).css('margin-top', '20px');

//         // Data from PHP
//         var pageNumber = '{{ $page_number ?? "" }}';
//         var year = '{{ date("Y") }}';
//         var courseName = '{{ $courseInfo->course_name ?? "" }}';
//         var courseDays = '{{ $courseInfo->days_of_course ?? "" }}';
//         var startHour = formatTo12Hour('{{ $courseInfo->start_hour ?? "" }}');
//         var endHour = formatTo12Hour('{{ $courseInfo->end_hour ?? "" }}');
//         var branchName = getBranchName(courseName);
//         var studentsData = @json($students);
//         var departmentName = '{{ $courseInfo->department_name ?? "" }}';

//         $(win.document.body).css('direction', 'rtl');
//         $(win.document.body).css('font-family', 'Arial');
//         $(win.document.body).css('font-size', '12px'); // base font smaller

//         // Header
//         $(win.document.body).prepend(`
//             <div style="text-align:center; margin-bottom:10px;">
//                 <h2 style="margin:0; font-size:18px;">مركز المأمون الدولي للتدريب على الحرف والمهن</h2>
//             </div>
//             <div style="text-align:right; margin-bottom:10px;">
//                 <p style="margin:0;font-weight:bold;">الجمعية الحرفية لمراكز التدريب</p>
//                 <p style="margin:0;font-weight:bold;">المهني والحرفي بدمشق وريفها</p>
//             </div>
//             <div style="width:100%; overflow:hidden; margin-bottom:15px;">
//                 <table style="width:25%; border-collapse:collapse; float:right; font-size:12px;">
//                     <tr>
//                         <td style="border:1px solid black; padding:4px;">الرقم</td>
//                         <td style="border:1px solid black; padding:4px;">${pageNumber}</td>
//                     </tr>
//                     <tr>
//                         <td style="border:1px solid black; padding:4px;">السنة</td>
//                         <td style="border:1px solid black; padding:4px;">${year}</td>
//                     </tr>
//                 </table>
//                 <div style="float:left;">
//                     <img src="{{ asset('images/logo.png') }}" style="width:100px;">
//                 </div>
//             </div>
//             <div style="text-align:center; margin:15px 0; clear:both;">
//                 <p style="margin:3px 0; font-weight:bold; font-size:14px;">إلى رئيس الجمعية الحرفية</p>
// <p style="margin:3px 0; font-weight:bold; font-size:14px;">نعلمكم بافتتاح دورة ${departmentName}(${courseName}) في مركزنا (${branchName})</p>                <p style="margin:3px 0; font-weight:bold; font-size:14px;">أيام الدورة (${courseDays})</p>
//                 <p style="margin:3px 0; font-weight:bold; font-size:14px;">وقت الدورة من الساعة (${startHour}) إلى الساعة (${endHour})</p>
//             </div>
//         `);

//         // Create print table
//         var newTable = $('<table border="1" style="width:100%; border-collapse:collapse; font-size:13px;"></table>');
//         newTable.append(`
//             <thead>
//                 <tr>
//                     <th style="padding:3px;">المدينة</th>
//                     <th style="padding:3px;">اسم المركز</th>
//                     <th style="padding:3px;">اسم الدورة</th>
//                     <th style="padding:3px;">الاسم والشهرة</th>
//                     <th style="padding:3px;">اسم الأب</th>
//                     <th style="padding:3px;">اسم الأم</th>
//                     <th style="padding:3px;">رقم الموبايل</th>

//                     <th style="padding:3px;">تاريخ الميلاد</th>
//                     <th style="padding:3px; min-width:80px;">الرقم الوطني</th>
//                     <th style="padding:3px;">الجنسية</th>
//                     <th style="padding:3px;">بداية الدورة</th>
//                     <th style="padding:3px;">نهاية الدورة</th>
//                     <th style="padding:3px;">هل الشهادة مطلوبة</th>
//                     <th style="padding:3px;">اسم المدرب</th>
//                     <th style="padding:3px;">الرقم العام</th>
//                 </tr>
//             </thead>
//         `);

//         var tbody = $('<tbody></tbody>');
//         // Loop over studentsData (from PHP)
//         studentsData.forEach(function(student) {
//             var eligible = student.certificate_eligible ? 'نعم' : 'لا';
//             var fullname = (student.firstname || '') + ' ' + (student.lastname || '');
//             tbody.append(`
//                 <tr>
//                     <td style="padding:3px;">دمشق</td>
//                     <td style="padding:3px;">مركز المأمون</td>
//                     <td style="padding:3px;">${courseName}</td>
//                     <td style="padding:3px;">${fullname}</td>
//                     <td style="padding:3px;">${student.fathername || ''}</td>
//                     <td style="padding:3px;">${student.mothername || ''}</td>
//                     <td style="padding:3px;">${student.mobile || ''}</td>
//                     <td style="padding:3px;">${student.date_of_birth || ''}</td>
//                     <td style="padding:3px; white-space:nowrap;">${student.national_number || ''}</td>
//                     <td style="padding:3px;">${student.nationality || ''}</td>
//                     <td style="padding:3px;">${student.start_date || ''}</td>
//                     <td style="padding:3px;">${student.end_date || ''}</td>
//                     <td style="padding:3px; font-weight:bold;">${eligible}</td>
//                     <td style="padding:3px;">${student.teacherfull || ''}</td>
//                     <td style="padding:3px;">${student.page_number || ''}</td>
//                 </tr>
//             `);
//         });

//         newTable.append(tbody);
//         $(win.document.body).find('table.dataTable').remove();
//         $(win.document.body).append(newTable);

//         // Footer
//         newTable.after(`
//             <div style="margin-top:20px; width:100%; font-size:16px; display:flex; justify-content:center; gap:500px; direction:rtl; color:#000;">
//                 <div style="text-align:right; font-weight:900;">قسم الشهادات</div>
//                 <div style="text-align:center; font-weight:900;">المهندس مأمون الحلاق<br>المدير العام لمركز المأمون الدولي</div>
//             </div>
//         `);

//         // Print styles to ensure table fits
//         $(win.document.head).append(`
//             <style>
//                 @page {
//                     size: A4 landscape;
//                     margin: 0;
//                 }
//                 @media print {
//                     body { margin: 10px; padding: 10px; }
//                     table { border-collapse: collapse; width: 100%; }
//                     th, td { border: 1px solid black; padding: 3px; text-align: center; font-size: 12px; }
//                     thead { display: table-header-group; }
//                     tfoot { display: table-footer-group; }
//                     tr { page-break-inside: avoid; }
//                 }
//             </style>
//         `);

//                     }
customize: function (win) {

    win.document.title = 'تقرير القوائم';

    $(win.document.body).empty();
    $(win.document.body).css('margin', '0');
    $(win.document.body).css('padding', '0');
    $(win.document.body).css('direction', 'rtl');
    $(win.document.body).css('font-family', 'Tahoma, Arial, sans-serif');
    $(win.document.body).css('font-size', '12px');
    $(win.document.body).css('color', '#111');

    // Data from PHP
    var pageNumber     = '{{ $page_number ?? "" }}';
    var year           = '{{ date("Y") }}';
    var courseName     = '{{ $courseInfo->course_name ?? "" }}';
    var courseDays     = '{{ $courseInfo->days_of_course ?? "" }}';
    var startHour      = formatTo12Hour('{{ $courseInfo->start_hour ?? "" }}');
    var endHour        = formatTo12Hour('{{ $courseInfo->end_hour ?? "" }}');
    var branchName     = getBranchName(courseName);
    var studentsData   = @json($students);
    var departmentName = '{{ $courseInfo->department_name ?? "" }}';

    // Header
    $(win.document.body).prepend(`
        <div style="text-align:center; margin-bottom:2px;">
            <h2 style="margin:0; font-size:18px; font-weight:900; color:#1a1a2e;">مركز المأمون الدولي للتدريب على الحرف والمهن</h2>
            <div style="height:2px; background:#1a1a2e; width:60%; margin:6px auto 0;"></div>
        </div>
        <div style="text-align:right; margin-bottom:2px; line-height:1.4;">
            <p style="margin:0; font-weight:bold; font-size:12px;">الجمعية الحرفية لمراكز التدريب</p>
            <p style="margin:0; font-weight:bold; font-size:12px;">المهني والحرفي بدمشق وريفها</p>
        </div>
        <div style="width:100%; overflow:hidden; margin-bottom:2px;">
            <table style="width:18%; border-collapse:collapse; float:right; font-size:11px; background:#f4f6fa;">
                 <tr>
                <td style="border:1px solid #333; padding:1px 3px; font-weight:bold; background:#e8edf5; font-size:11px; line-height:1.2;">الرقم</td>
                <td style="border:1px solid #333; padding:1px 3px; text-align:center; font-size:11px; line-height:1.2;">${pageNumber}</td>
            </tr>
            <tr>
                <td style="border:1px solid #333; padding:1px 3px; font-weight:bold; background:#e8edf5; font-size:11px; line-height:1.2;">السنة</td>
                <td style="border:1px solid #333; padding:1px 3px; text-align:center; font-size:11px; line-height:1.2;">${year}</td>
            </tr>
            </table>
            <div style="float:left; padding-top:3px;">
                <img src="{{ asset('images/logo.png') }}" style="width:100px;">
            </div>
        </div>
        <div style="text-align:center; margin:0 0 0px 0; clear:both; line-height:1;">
            <p style="margin:3px 0; font-weight:bold; font-size:14px; text-decoration:underline;">إلى رئيس الجمعية الحرفية</p>
            <p style="margin:3px 0; font-weight:bold; font-size:14px;">نعلمكم بافتتاح دورة ${departmentName} (${courseName}) في مركزنا (${branchName})</p>
            <p style="margin:3px 0; font-weight:bold; font-size:14px;">أيام الدورة (${courseDays})</p>
            <p style="margin:3px 0; font-weight:bold; font-size:14px;">وقت الدورة من الساعة (${startHour}) إلى الساعة (${endHour})</p>
        </div>

    `);

    // Create print table (نفس الأعمدة والبيانات بدون تغيير)
    var newTable = $('<table class="print-data-table" border="1" style="width:100%; border-collapse:collapse; font-size:13px;"></table>');
    newTable.append(`
        <thead>
            <tr>
                <th style="padding:3px;">المدينة</th>
                <th style="padding:3px;">اسم المركز</th>
                <th style="padding:3px;">اسم الدورة</th>
                <th style="padding:3px;">الاسم والشهرة</th>
                <th style="padding:3px;">اسم الأب</th>
                <th style="padding:3px;">اسم الأم</th>
                <th style="padding:3px;">رقم الموبايل</th>
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
                <td style="padding:3px;">${student.mobile || ''}</td>
                <td style="padding:3px;">${student.date_of_birth || ''}</td>
                <td style="padding:3px; white-space:nowrap;">${student.national_number || ''}</td>
                <td style="padding:3px;">${student.nationality || ''}</td>
                <td style="padding:3px;">${student.start_date || ''}</td>
                <td style="padding:3px;">${student.end_date || ''}</td>
                <td style="padding:3px; font-weight:bold;">${eligible}</td>
                <td style="padding:3px;">${student.teacherfull || ''}</td>
                <td style="padding:3px;">${student.page_number || ''}</td>
            </tr>
        `);
    });

    newTable.append(tbody);
    $(win.document.body).find('table.dataTable').remove();
    $(win.document.body).append(newTable);

    // Footer
    newTable.after(`
        <div style="margin-top:25px; width:100%; font-size:15px; display:flex; justify-content:space-between; direction:rtl; color:#000; padding:0 40px;">
            <div style="text-align:right; font-weight:900;">قسم الشهادات</div>
            <div style="text-align:center; font-weight:900; line-height:1.5;">
                المهندس مأمون الحلاق<br>
                <span style="font-weight:700; font-size:13px;">المدير العام لمركز المأمون الدولي</span>
            </div>
        </div>
    `);

    // Print styles — فقط تنسيق، نفس البنية
    $(win.document.head).append(`
        <style>
            @page {
                size: A4 landscape;
                margin: 8mm;
            }
            @media print {
                body {
                    margin: 0;
                    padding: 5px;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                .print-data-table thead th {
                     background: #ffffff !important;
    color: #000 !important;
                    border: 1px solid #1a1a2e !important;
                    padding: 6px 3px !important;
                    font-size: 11px !important;
                    font-weight: 700 !important;
                    text-align: center !important;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                .print-data-table tbody td {
                    border: 1px solid #9aa3b3 !important;
                    padding: 5px 3px !important;
                    text-align: center !important;
                    font-size: 11.5px !important;
                    height: 22px;
                }
                .print-data-table tbody tr:nth-child(even) {
                    background: #f8fafd !important;
                    -webkit-print-color-adjust: exact;
                    print-color-adjust: exact;
                }
                .print-data-table thead { display: table-header-group; }
                .print-data-table tr    { page-break-inside: avoid; }
            }
        </style>
    `);

    // focus & print
    setTimeout(function () {
        win.focus();
        win.print();
        win.close();
    }, 50);
}


                },
                 {
                    text: 'Excel',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {

                        // نفس القيم المرسلة في البحث
                        let params = new URLSearchParams({
                            page_number: '{{ request('page_number') }}',
                            start_at: '{{ request('start_at') }}',
                            end_at: '{{ request('end_at') }}',
                            teacher_name: '{{ request('teacher_name') }}',
                        });

                        // التحويل إلى Route التصدير
                        window.location.href =
                            "{{ route('certifications.export.excel') }}?" + params.toString();
                    }
                },

                {
                    text: 'Excel (Current Page)',
                    className: 'buttons-excel',
                    action: function (e, dt, node, config) {

                        let params = new URLSearchParams({
                            page_number: '{{ request('page_number') }}',
                            start_at: '{{ request('start_at') }}',
                            end_at: '{{ request('end_at') }}',
                            teacher_name: '{{ request('teacher_name') }}',
                        });

                        window.location.href =
                            "{{ route('certifications.export.excel.page') }}?" + params.toString();
                    }
                },
                'copy'
            ],
            pageLength: 17,
            searching: false,
            ordering: false,
            scrollX: true,
        });


        setTimeout(function() {
    win.focus();
    win.print();
    win.close();
}, 50);
    </script>

@endsection
