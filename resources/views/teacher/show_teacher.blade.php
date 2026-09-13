@extends('layouts.master')
@section('title')
    تفاصيل
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                {{-- <th scope="col">المعرف</th> --}}
                <th scope="col">الاسم الأول</th>
                <th scope="col">الاسم الأخير</th>
                <th scope="col">الموبايل</th>
                <th scope="col">الراتب</th>
                <th scope="col">المواد</th>
                <th scope="col">الدورات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher as $teacher)
                <tr>
                    {{-- <td>{{ $teacher->id }}</td> --}}
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->lastname }}</td>
                    <td>{{ $teacher->phone_num }}</td>
                    @if ($teacher->salarytype == '%')
                        <td>{{ $teacher->salary }} {{ $teacher->salarytype }}</td>
                    @else
                        <td>{{ $teacher->salary }}</td>
                    @endif
                    <td>
                        @foreach ($subject as $item)
                            {{ $item }}|
                        @endforeach
                    </td>
                    <td>
                        @foreach ($courses as $course)
                            {{ $course }}|
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </br>
@endsection
