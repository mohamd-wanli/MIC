@extends('layouts.master')
@section('title')
    البحث برقم الصفحة
@endsection
@section('content')
<button onclick="window.history.back();" class="btn btn-primary" style="color: white; background-color: royalblue;">
    عودة
</button>
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <style>
        .table-container {
            max-height: 500px;
            overflow-y: auto;
        }

        table {
            white-space: nowrap;
        }

        thead {
            position: sticky;
            top: 0;
            background: #f8f9fa;
            z-index: 2;
        }

        th,
        td {
            text-align: center;
            vertical-align: middle;
        }

        .small-input {
            width: 90px;
            text-align: center;
        }

        .highlight {
            background-color: #eef5ff;
        }
    </style>



<form method="GET" action="{{ route('students.search') }}">
    <label for="page_number">رقم الصفحة:</label>
    <input type="text" name="page_number" id="page_number" value="{{ request('page_number') }}">

    <label for="year">السنة:</label>
    <select name="year" id="year">
        <option value="">اختر السنة</option>
        @foreach ($availableYears as $availableYear)
            <option value="{{ $availableYear }}" {{ request('year') == $availableYear ? 'selected' : '' }}>
                {{ $availableYear }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary">بحث</button>
</form>

@if (request()->has('page_number') || request()->has('year'))
    @if (isset($students) && $students->isEmpty())
        <p>لا يوجد طلاب برقم الصفحة {{ request('page_number') }}</p>
    @elseif(isset($students))
        <form action="{{ route('saveCertificateData') }}" method="POST">
            @csrf
            <div class="table-container">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>اسم الأب</th>
                            <th>اسم الأم</th>
                            <th>المواليد</th>
                            <th>الجنسية</th>
                            <th>الدورة</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>الشهادة</th>
                            <th>المجموعة</th>
                            <th>الإدخال</th>
                            <th>حالة طلب الشهادة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $index => $student)
                            <tr class="{{ $index % 2 == 0 ? 'highlight' : '' }}">
                                <td>{{ $student->general_number }}</td>
                                <td>{{ $student->fullname }}</td>
                                <td>{{ $student->fathername }}</td>
                                <td>{{ $student->mothername }}</td>
                                <td>{{ $student->date_of_birth }}</td>
                                <td>{{ $student->nationality }}</td>
                                <td>{{ $student->course_name }}</td>
                                <td>{{ $student->course_start_date }}</td>
                                <td>{{ $student->course_end_date }}</td>

                                <td>
                                    <input type="text" name="certificate_number[{{ $student->id }}]"
                                        class="form-control small-input"
                                        value="{{ old('certificate_number', $student->certificate_number ?? '') }}">
                                </td>

                                <td>
                                    <input type="text" name="group_number[{{ $student->id }}]"
                                        class="form-control small-input"
                                        value="{{ old('group_number', $student->group_number ?? '') }}">
                                </td>

                                <td>
                                    <input type="text" name="input_date[{{ $student->id }}]"
                                        class="form-control small-input"
                                        value="{{ old('input_date', $student->input_date ?? '') }}">
                                </td>
                                <td class="text-center">{{ $student->request_status }}</td> <!-- ✅ عرض حالة الطلب -->

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-primary">حفظ جميع البيانات</button>
        </form>
    @endif
@endif




@endsection
