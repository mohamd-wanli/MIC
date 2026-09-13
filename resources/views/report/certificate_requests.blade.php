@extends('layouts.master')

@section('content')
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="container">
    <h2 class="text-center mt-4">تقرير طلبات الشهادات</h2>
 

    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>اسم الطالب</th>
                    <th>اسم الدورة</th>
                    <th>مدرب الدورة</th>
                    <th>تاريخ الطلب</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requests as $index => $request)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $request->student->fullname }}</td>
                        <td>{{ $request->course->subject_name }}</td>
                        <td>{{ $request->course->teacher_name }}</td>
                        <td>{{ $request->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="text-center mt-4">
        <button onclick="window.print()" class="btn btn-primary print-btn">طباعة التقرير</button>
    </div>

</div>

@endsection
