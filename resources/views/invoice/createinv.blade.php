@extends('layouts.master')
@section('title')
    إضافة فاتورة
@endsection
@section('content')

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
        عودة
    </button>
    <form method="POST" action="{{ route('storeinv') }}" style="width: 80%; margin:auto;" class="needs-validation" novalidate>
        @csrf
        <br>
        <input type="hidden" name="student_id" value="{{ $student->id }}">
        <input type="hidden" name="course_id" value="{{ $course->id }}">
        <!-- تحديد القسم بناءً على المستخدم -->
        @if (auth()->user()->department_id == null)
            <label for="department">القسم</label>
            <select class="form-control" id="department" name="department_id" required>
                <option value="">اختر القسم</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
        @else
            <input type="hidden" name="department_id" id="department_id" value="{{ auth()->user()->department_id }}">
        @endif
        <br>

        <label>اسم الدورة</label>
        <input type="text" value="{{ $course->subject_name }}" class="form-control" readonly>
        <br>
        <label>اسم الطالب</label>
        <input type="text" value="{{ $student->firstname }}" class="form-control" readonly>
        <br>
        <label for="sale">الحسم</label>
        <input type="text" value="{{ $sale }}" name="sale" class="form-control" readonly>
        <br>

        <label for="paymenttype" class="form-label">نوع الدفعة</label>
        <select id="paymenttype" class="form-select form-select-lg mb-3" name="paymenttype" required>
            <option value="">اختر النوع</option>
            @if(auth()->user()->department_id == null || auth()->user()->department_id == 9)
            <option value="رسم بطاقة امتحانية">رسم بطاقة امتحانية</option>
            <option value="رسم امتحان ">رسم امتحان </option>
            <option value="كتاب الكتروني">كتاب الكتروني</option>
                @endif
            <option value="قسط">قسط</option>
            <option value="قسط+رسم">قسط+رسم</option>
            <option value="قسط نهائي">قسط نهائي</option>
            <option value="رسم شهادة أمريكية">رسم شهادة أمريكية</option>
            <option value="رسم شهادة حرفية">رسم شهادة حرفية</option>
            <option value="ثمن نوطة">ثمن نوطة</option>
            <option value="وثيقة دوام">وثيقة دوام</option>
        </select>
        <br>

        <label for="paymentamount">قيمة الدفعة</label>
        <input type="number" id="paymentamount" name="paymentamount" class="form-control" required>
        <br>

        <label for="paymentdate">تاريخ الدفعة</label>
        <input type="date" id="paymentdate" name="paymentdate" class="form-control" required>
        <br>

        <label for="invoicenum">رقم الوصل</label>
        <input type="number" id="invoicenum" name="invoicenum" class="form-control" required>
        <br>

        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
@endsection
