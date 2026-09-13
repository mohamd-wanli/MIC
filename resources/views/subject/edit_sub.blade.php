@extends('layouts.master')
@section('title')
    تعديل مادة
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form method="post" action="{{ route('updatesubject', $subject->id) }}" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        @csrf
        <label for="name">اسم المادة</label>
        <input type="text" class="form-control" id="name" name="name" value={{ $subject->name }} required></br>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المادة
        </div>
        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">تعديل</button>
    </form>
    </br>
@endsection
