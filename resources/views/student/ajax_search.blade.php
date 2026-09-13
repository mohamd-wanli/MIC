@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error" role="alert">

        {{ session('error') }}
    </div>
@endif

<div class="container mt-4">
    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center" id="resultsTable">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">الاسم الأول</th>
                    <th scope="col">اسم الأب</th>
                    <th scope="col">الكنية</th>
                    <th scope="col">الاسم الكامل</th>
                    <th scope="col">الرقم الوطني</th>
                    <th scope="col">رقم البطاقة الدولية</th>
                    <th scope="col">رقم البطاقة السورية</th>
                    @can('اضافة الى جلسة')
                    <th scope="col">الجلسات</th>
                    @endcan
                    @can('اضافة الى دورة')
                    <th scope="col">الدورات</th>
                    @endcan
                    <th scope="col">التفاصيل</th>
                </tr>
            </thead>
            <tbody class="align-middle">
                @if (!empty($data))
                    @foreach ($data as $index => $info)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>{{ $info->firstname }}</td>
                            <td>{{ $info->fathername }}</td>
                            <td>{{ $info->lastname }}</td>
                            <td class="text-primary fw-bold">{{ $info->fullname }}</td>
                            <td>{{ $info->national_number }}</td>
                            <td>{{ $info->Nscn }}</td>
                            <td>{{ $info->Lscn }}</td>

                                @can('اضافة الى جلسة')
                                <td>
                                <button class="add-to-session btn btn-success btn-sm"
                                data-student-id="{{ $info->id }}">
                                <i class="fas fa-user-plus"></i> إضافة إلى جلسة
                            </button>
                        </td>
                                @endcan
                                @can('اضافة الى دورة')
                                <td>
                                    <a href="{{ route('showstudent', ['id' => $info->id]) }}" class="btn btn-primary">اضافة
                                        الى دورة</a>
                                </td>
                                @endcan
                                <td>
                                    <a href="{{ route('student.show', $info->id) }}"
                                        class="btn btn-info btn-sm detail-btn">
                                        <i class="fas fa-eye"></i> تفاصيل
                                    </a>
                                </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

</div>
<br>



<div class="modal fade" id="sessionModal" tabindex="-1" aria-labelledby="sessionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sessionModalLabel">إضافة الطالب إلى جلسة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- <form id="addStudentForm">
            <input type="hidden" id="studentId" name="student_id">
            <div class="form-group">
              <label for="sessionSelect">اختر الجلسة:</label>
              <select class="form-select" name="session_id" id="sessionSelect">
                @foreach ($exam as $examDay)
                    <option value="{{ $examDay->id }}">{{ $examDay->id }}</option>
                @endforeach
            </select>
            </div>
          </form>
        </div> --}}
                <form>
                    <div class="mb-3">
                        <label for="examDaySelect" class="form-label">اختر يوم امتحاني</label>
                        <select class="form-select" id="examDaySelect" aria-label="اختر يوم امتحاني">
                            <option selected disabled>اختر يومًا امتحانيًا</option>
                            @foreach ($exam as $examDay)
                                <option value="{{ $examDay->id }}">{{ $examDay->day_of_session }} (
                                    {{ $examDay->session_scheduled_date }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" id="studentId" name="student_id">
                        <label for="sessionSelect" class="form-label">اختر جلسة</label>
                        <select class="form-select" id="sessionSelect" aria-label="اختر جلسة">
                            <option selected disabled>يرجى اختيار يوم لعرض الجلسات</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="meter" class="form-label">اختر المادة الامتحانية</label>
                        <select class="form-select" id="meter" name="meter" required>
                            <option value="" selected disabled>اختر المادة</option>
                            @foreach ($meters as $meter)
                                <option value="{{ $meter->name }}">{{ $meter->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary" id="saveSession">إضافة الطالب</button>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12" id="ajax_search_pagination">
    {{ $data->links() }}
</div>



<script>
    $('#saveSession').on('click', function() {
        let studentId = $('#studentId').val();
        let sessionId = $('#sessionSelect').val();
        let meter = $('#meter').val();

        $.ajax({
            url: '/add_student_to_session/',
            type: 'POST',
            data: {
                student_id: studentId,
                session_id: sessionId,
                meter: meter,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    $('#sessionModal').modal('hide');
                    alert(response.message);
                    setTimeout(function() {
                        window.location.href = "/Search_student";
                    }, 1500);
                    // $('#studentList').append('<tr><td>' + response.studentName + '</td></tr>'); // عرض رسالة النجاح
                } else {
                    alert(response.message);
                }
            },
            error: function(error) {
                alert('حدث خطأ أثناء إضافة الطالب!');
                console.log(error);
            }
        });
    });
</script>

<script>
    $('.add-to-session').on('click', function() {
        let studentId = $(this).data('student-id');
        $('#studentId').val(studentId);
        $('#sessionModal').modal('show');
    });
</script>

<script>
    $(document).ready(function() {
        $('#examDaySelect').on('change', function() {
            let examDayId = $(this).val();
            let studentId = $('#studentId').val();

            if (examDayId) {
                $.ajax({
                    url: '/get-sessions/' + examDayId,
                    type: 'GET',
                    data: {
                        student_id: studentId,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        $('#sessionSelect').empty();
                        $('#sessionSelect').append(
                            '<option selected disabled>اختر جلسة</option>');
                        $.each(data, function(key, session) {
                            console.log(session);
                            $('#sessionSelect').append('<option value="' + session
                                .id + '">' + session.id + ' ' + (session
                                    .start_of_test) + '</option>');
                        });
                    },
                    error: function(error) {
                        alert('حدث خطأ أثناء إضافة الطالب!');
                        console.log(error);
                    }
                });
            } else {
                $('#sessionSelect').empty();
            }
        });
    });
</script>
