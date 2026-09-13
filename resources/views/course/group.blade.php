{{-- @extends('layouts.master')

@section('content')
<h3>تعيين رقم مجموعة</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<h4>الطلاب المتاحون:</h4>
<form method="POST" action="{{ route('assign.group') }}">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>اختيار</th>
                <th>رقم الشهادة</th>
                <th>الاسم الكامل</th>
                <th>اسم الأب</th>
                <th>اسم الأم</th>
                <th>تاريخ الميلاد</th>
                <th>الجنسية</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>
                        <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="student-checkbox">
                    </td>
                    <td>
                        <input type="text" name="certificate_numbers[{{ $student->id }}]" 
                               id="certificate-{{ $student->id }}" 
                               class="certificate-input" 
                               placeholder="أدخل رقم الشهادة">
                    </td>
                    <td>{{ $student->fullname }}</td>
                    <td>{{ $student->fathername }}</td>
                    <td>{{ $student->mothername }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>{{ $student->nationality }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <input type="hidden" name="group_number" id="groupNumberInput" value="{{ $currentGroupNumber }}">
    <button type="submit" class="btn btn-success" disabled id="submitButton">تعيين المجموعة</button>
</form>


<script>
    const currentGroupNumber = {{ $currentGroupNumber }};
</script>

<script>
    let selectedStudents = [];
    const groupNumberInput = document.getElementById('groupNumberInput');
    const submitButton = document.getElementById('submitButton');
    const checkboxes = document.querySelectorAll('.student-checkbox');

    // تابع التحقق من إدخال رقم الشهادة
    function validateCertificateNumbers() {
        let allCertificatesEntered = true;
        selectedStudents.forEach(studentId => {
            const certificateInput = document.getElementById(`certificate-${studentId}`);
            if (!certificateInput || certificateInput.value.trim() === '') {
                allCertificatesEntered = false; // لم يتم إدخال جميع الأرقام
            }
        });
        return allCertificatesEntered;
    }

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            selectedStudents = Array.from(checkboxes)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            if (selectedStudents.length === 1) {
                if (validateCertificateNumbers()) {
                    submitButton.disabled = false; // تمكين الزر
                    alert('تم تحديد طالب واحد، رقم المجموعة: ' + groupNumberInput.value);
                } else {
                    submitButton.disabled = true; // تعطيل الزر
                    alert('يرجى إدخال رقم الشهادة للطالب المحدد.');
                }
            } else {
                submitButton.disabled = true; // تعطيل الزر إذا كان أكثر من طالب محدد
            }
        });
    });

    // تحديث التحقق عند تغيير أرقام الشهادات
    document.querySelectorAll('.certificate-input').forEach(input => {
        input.addEventListener('input', () => {
            if (selectedStudents.length === 1 && validateCertificateNumbers()) {
                submitButton.disabled = false; // تمكين الزر
            } else {
                submitButton.disabled = true; // تعطيل الزر
            }
        });
    });
</script>


@endsection --}}
