@extends('layouts.app') {{-- or whatever your main layout is --}}

@section('content')
<div class="pagetitle">
    <h1>كشف درجات الدورة</h1>
</div>

<section class="section">
    <div class="card">
        <div class="card-body pt-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الدورة</th>
                        <th>اسم الدورة</th>
                        <th>المدرس</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $course->coursenumber }}</td>
                            <td>{{ $course->subject_name }}</td>
                            <td>{{ $course->teacher_name }}</td>
                            <td>
                                <a href="{{ route('courses.gradesReport', $course->id) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">
                                    <i class="bi bi-printer"></i> كشف الدرجات
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $courses->links() }}
        </div>
    </div>
</section>
@endsection
