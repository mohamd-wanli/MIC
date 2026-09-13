<!-- ghinwa -->
@extends('layouts.master')
@section('title')
    تعديل الحسم
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form method="post" action="{{ route('updatesale', ['stuid' => $stuid, 'coid' => $coid]) }}" style="width: 80%; margin:auto;"
        id="form" class="needs-validation" novalidate>
        @csrf
        <label for="sale">الحسم</label>
        <input type="number" id="sale" name="sale" step="1000" class="form-control" value="{{ $sale }}"
            required>
        <button type="submit" class="btn btn-primary" style="margin-top: 4%">تعديل</button>
    </form>
@endsection
