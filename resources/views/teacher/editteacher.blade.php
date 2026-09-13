@extends('layouts.master')
@section('title')
    تعديل مدرس
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form action="{{ route('updateteacher', $teacher->id) }}" method="POST" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        @csrf
        <label for="name">الاسم الأول</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $teacher->name }}" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأول
        </div>
        <label for="lastname">الاسم الأخير </label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="{{ $teacher->lastname }}" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأخير
        </div>
        <label for="phone_num">الموبايل</label>
        <input type="text" class="form-control" id="phone_num" name="phone_num" value="{{ $teacher->phone_num }}"
            required>
        <div class="invalid-feedback">
            الرجاء ادخال رقم الموبايل
        </div>
        <div class="row row-cols-2">
            <div class="col">
                <label for="salary">الراتب</label>
                <input type="number" id="salary" name="salary" class="form-control" value="{{ $teacher->salary }}"
                    required>
                @error('salary')
                    <p class="error" style="color: red">{{ $message }}</p>
                @enderror
            </div>
            <div class="col">
                <select id="salarytype" name="salarytype" style="  margin-top: 7%;" required>
                    @if ($teacher->salarytype == '%')
                        <option value="%" selected>{{ $teacher->salarytype }}</option>
                        <option value="مقطوع">مقطوع</option>
                    @else
                        <option value="مقطوع" selected>مقطوع</option>
                        <option value="%">نسبة(%)</option>
                    @endif
                </select>
            </div>
        </div>
        <label for="subject" class="form-label">المواد</label>
        <select id="subject" class="form-select" name="subject[]" multiple="multiple">
            @foreach ($subjects as $subject)
                @if (in_array($subject->id, $subject_id))
                    <option value="{{ $subject->name }}" selected> {{ $subject->name }}</option>
                @else
                    <option value="{{ $subject->name }}">{{ $subject->name }}</option>
                @endif
            @endforeach
        </select>
        </br> </br>
        <button type="submit" class="btn btn-primary">تعديل</button>
    </form>
@endsection
