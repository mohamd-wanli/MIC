@extends('layouts.master')
@section('title')
    إضافة قسم
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form method="post" class="needs-validation" novalidate action="{{ route('storedepartment') }}"
        style="width: 80%; margin:auto;">
        @csrf
        <label for="name">اسم القسم</label>
        <input type="text" class="form-control" id="name" name="name" required></br>
        <div class="invalid-feedback">
            الرجاء ادخال اسم القسم
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">حفظ</button>
    </form>
    </br>
@endsection
