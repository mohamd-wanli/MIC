@extends('layouts.master')
@section('title')
    قائمة الدورات
@endsection
@section('content')

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger mt-3">
            {{ session('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('students.assignGroup') }}">
        @csrf

        <div class="mb-3">
            <label for="groupNumber" class="form-label">أدخل رقم المجموعة</label>
            <input type="text" id="groupNumber" name="group_number" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">تعيين رقم المجموعة لأول 25 طالب</button>
    </form>
    @if (isset($assignedStudents) && $assignedStudents->isNotEmpty())
        <h3>الطلاب الذين تم تعيين رقم المجموعة لهم:</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>الاسم الكامل</th>
                    <th>اسم الأب</th>
                    <th>رقم المجموعة</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assignedStudents as $student)
                    <tr>
                        <td>{{ $student->fullname }}</td>
                        <td>{{ $student->fathername }}</td>
                        <td>{{ $student->group_number }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <h3>الطلاب المسجلين في الدورة:</h3>
    <table class="table">
        <thead>
            <tr>
                <th>الرقم العام</th>
                <th>الاسم الكامل</th>
                <th>اسم الأب</th>
                <th>اسم الأم</th>
                <th>الجنسية</th>
                <th>رقم المجموعة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->general_number }}</td>
                    <td>{{ $student->fullname }}</td>
                    <td>{{ $student->fathername }}</td>
                    <td>{{ $student->mothername }}</td>
                    <td>{{ $student->nationality }}</td>
                    <td>{{ $student->group_number ?? 'غير معيّن' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
