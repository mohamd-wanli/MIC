<!-- ghinwa -->
@extends('layouts.master')
@section('title')
    دورات الطالب
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <style>
        .hidden {
            display: none
        }
    </style>
    <div class="card-header pb-0">
        <button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
            عودة
        </button>

        <a href="{{ route('addtocourse', ['id' => $students->id]) }}" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#addModal" id="added" style="color:white"><i class="fas fa-plus"></i>&nbsp; اضافة طالب
            لدورة</a><br><br>

    </div>

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">إضافة لدورة</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" action="{{ route('addtocourse', ['id' => request()->id]) }}"
                    style="width: 80%; margin:auto;" id="form" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" value="{{ request()->id }}" id="sid">
                        <select id="course" class="form-select" name="course" required>
                            <option value="">اختر الدورة</option>
                        </select>
                        <label for="sale">الحسم</label>
                        <input type="number" id="sale" name="sale" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                        <button type="submit" class="btn btn-primary" id="save">حفظ</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- edit sale Modal -->
    {{-- <div class="modal fade" id="editsaleModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">إضافة لدورة</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="coid" id="coid">
                <form method="post" action="{{route('updatesale',['stuid'=>request()->id,'coid'=>])}}"  style="width: 80%; margin:auto;" id="form" class="needs-validation" novalidate>
                    @csrf
                    <label for="sale">الحسم</label>
                    <input type="number" id="sale" name="sale" step="1000" class="form-control" value="{{ $sale }}" required >
                </form>
        </div>
        
        <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
              <button type="submit" class="btn btn-primary" id="save">حفظ</button>
        </div>
        
      </div>
    </div>
  </div> --}}
    <!-- Table -->
    <table class="table-striped hidden" id="table">
        <thead>
            <tr>
                {{-- <th scope="col">المعرف</th> --}}
                <th scope="col">المادة</th>
                <th scope="col">الأستاذ</th>
                <th scope="col">تاريخ البداية</th>
                <th scope="col">تاريخ النهاية</th>
                <th scope="col">ساعة البدء</th>
                <th scope="col">ساعة النهاية</th>
                <th scope="col">السعر</th>
                <th scope="col">عدد الجلسات</th>
                <th scope="col">ايام الدورة</th>
                <th scope="col"> عمليات الفواتير</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#added').on('click', function() {
                var url = '{{ route('apiaddtocourse') }}';
                $.get(url, function(d) {
                    for (let i = 0; i < d.length; i++) {
                        $('#course').append(new Option(
                            `${d[i].subject_name} - ${d[i].teacher_name} - ${d[i].start_date}`,
                            d[i].subject_name));
                    }
                });
            });

            var student_id = $('#sid').val();
            var url1 = '{{ route('apistucourse', ['id' => ':id']) }}';
            url = url1.replace(':id', student_id);

            $.get(url, function(d) {
                if (d.courses.length > 0) {
                    $("#table").removeClass("hidden").addClass("table");

                    for (let i = 0; i < d.courses.length; i++) {
                        var coid = d.courses[i].id;

                        var urlm = '{{ route('createinv', ['stuid' => ':stuid', 'coid' => ':coid']) }}'
                            .replace(':stuid', student_id)
                            .replace(':coid', coid);

                        var urlk = '{{ route('editsale', ['stuid' => ':stuid', 'coid' => ':coid']) }}'
                            .replace(':stuid', student_id)
                            .replace(':coid', coid);

                        var urls = '{{ route('showinv', ['stuid' => ':stuid', 'coid' => ':coid']) }}'
                            .replace(':stuid', student_id)
                            .replace(':coid', coid);

                        var deleteUrl = "/delete-student-course/" + student_id + "/" + coid;

                        var newRow = "<tr>" +
    "<td>" + d.courses[i].subject_name + "</td>" +
    "<td>" + d.courses[i].teacher_name + "</td>" +
    "<td>" + d.courses[i].start_date + "</td>" +
    "<td>" + d.courses[i].end_date + "</td>" +
    "<td>" + d.courses[i].start_hour + "</td>" +
    "<td>" + d.courses[i].end_hour + "</td>" +
    "<td>" + d.courses[i].price + "</td>" +
    "<td>" + d.courses[i].num_of_session + "</td>" +
    "<td>" + d.courses[i].days_of_course + "</td>" +
    "<td><div>" 
        @can('عرض الفواتير')
        + "<a href=" + urls +
    " class='btn btn-primary' style='display:inline-block'>عرض الفواتير</a>&nbsp;" 
        @endcan
     
     @can('اضافة فاتورة')
     + "<a href=" + urlm +
    " class='btn btn-primary' style='display:inline-block'>إضافة فاتورة</a>&nbsp;"  
     @endcan
     
     @can('تعديل الحسم')
     +"<a href=" + urlk +
     " class='btn btn-primary' style='display:inline-block'>تعديل الحسم</a>&nbsp;"   
     @endcan
    
    // زر حذف الطالب من الدورة
    +"<button class='btn btn-danger delete-course' data-student='" + student_id +
    "' data-course='" + coid + "'>حذف طالب من الدورة</button>&nbsp;"  

    // زر حذف الفاتورة
    @can('حذف فاتورة')
    +"<button class='btn btn-warning delete-invoice' data-student='" + student_id +
    "' data-course='" + coid + "'>حذف الفاتورة</button>"  
    @endcan
    +
    "</div></td>" +
    "</tr>";

                        $("#table tbody").append(newRow);
                    }
                }
            });

            $(document).on("click", ".delete-course", function() {
                var student_id = $(this).data("student");
                var course_id = $(this).data("course");

                if (confirm("هل أنت متأكد من حذف الطالب من هذه الدورة؟")) {
                    $.ajax({
                        url: "/delete-student-course/" + student_id + "/" + course_id,
                        type: "DELETE",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert(response.message);
                            location.reload();
                        },
                        error: function(xhr) {
                            alert("حدث خطأ أثناء الحذف");
                        }
                    });
                }
            });

            $(document).on("click", ".delete-invoice", function() {
    var student_id = $(this).data("student");
    var course_id = $(this).data("course");

    var deleteInvoiceUrl = "{{ route('deleteinv', ['stuid' => ':stuid', 'coid' => ':coid']) }}"
        .replace(':stuid', student_id)
        .replace(':coid', course_id);

    if (confirm("هل أنت متأكد من حذف هذه الفاتورة؟ لا يمكن التراجع عن هذا الإجراء!")) {
        $.ajax({
            url: deleteInvoiceUrl,
            type: "DELETE",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === "success") {
                    alert(response.message);
                    location.reload(); // تحديث الصفحة بعد الحذف
                } else {
                    alert("فشل الحذف: " + response.message);
                }
            },
            error: function(xhr) {
                alert("حدث خطأ أثناء حذف الفاتورة، الرجاء المحاولة مرة أخرى");
            }
        });
    }
});
        });


        // $('#editsale').on('show.bs.modal', function (event) {
        //     console.log("event is trigger"); //<==== here
        //     var button = $(event.relatedTarget)
        //     var coid = button.data('id')
        //     var modal = $(this)

        //     modal.find('#coid').val(coid);
        //     })
    </script>
@endsection
