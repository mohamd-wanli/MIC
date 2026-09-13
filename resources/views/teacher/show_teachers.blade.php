@extends('layouts.master')
@section('title')
    قائمة المدرسون
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <div class="card-header pb-0">
@can('اضافة مدرس')
<a href="{{route('createteacher')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
    class="fas fa-plus"></i>&nbsp; اضافة مدرس</a><br><br>  
@endcan 
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                {{-- <th scope="col">المعرف</th> --}}
                <th scope="col">الاسم الأول</th>
                <th scope="col">الاسم الأخير</th>
                <th scope="col">الموبايل</th>
                <th scope="col">العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teachers as $teacher)
                <tr>
                    {{-- <td>{{ $teacher->id }}</td> --}}
                    <td>{{ $teacher->name }}</td>
                    <td>{{ $teacher->lastname }}</td>
                    <td>{{ $teacher->phone_num }}</td>
                    <td>
                        @can('تعديل مدرس')
                        <a href="{{ route('editteacher', ['id' => $teacher->id]) }}" class="btn btn-primary">تعديل</a>
                        @endcan
                        @can('حذف مدرس')
                        <a href="{{ route('deleteteacher', ['id' => $teacher->id]) }}" class="btn btn-primary">حذف</a> 
                        @endcan
                        @can('تفاصيل مدرس')
                        <a href="{{ route('showteacher', ['id' => $teacher->id]) }}" class="btn btn-primary">تفاصيل</a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </br>
@endsection
