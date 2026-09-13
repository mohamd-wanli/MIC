@extends('layouts.master')
@section('title')
    قائمة الامتحانات
@endsection
@section('content')
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <a href={{ url('/' . ($page = 'Examday')) }} style=" color: white ;background-color:royalblue"
                        class="btn btn-primary">عودة</a>
                    {{-- <a href="/exam_day/create" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                            class="fas fa-plus"></i>&nbsp; اضافة جلسة </a><br><br> --}}

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'
                            style="text-align: center">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">المعرف</th>
                                    <th class="border-bottom-0"> يوم الامتحان</th>
                                    <th class="border-bottom-0">ساعة بداية الامتحان</th>
                                    <th class="border-bottom-0"> ساعة نهاية الامتحان </th>
                                    <th class="border-bottom-0">عدد الطلاب الحاليين</th>
                                    <th class="border-bottom-0">عدد الطلاب المتبقيين للوصول إلى 14</th>
                                    <th class="border-bottom-0">الطلاب</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($session as $se)
                                    @php
                                        $i++;
                                        $currentStudentCount = $se->students->count();
                                        $remainingStudents = max(14 - $currentStudentCount, 0);
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $se->examday->session_scheduled_date }}</td>
                                        <td>{{ $se->start_of_test }}</td>
                                        <td>{{ $se->end_of_test }}</td>
                                        <td>{{ $currentStudentCount }}</td>
                                        <td>{{ $remainingStudents }}</td>
                                        <td>
                                            <a type="button" class="btn btn-link"
                                                href="{{ route('sessions.show', $se->id) }}">الطلاب في الجلسة</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
@endsection
