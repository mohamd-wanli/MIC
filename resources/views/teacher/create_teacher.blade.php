@extends('layouts.master')
@section('title')
    إضافة مدرس
@endsection

@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif
    <form method="post" action="{{ route('storeteacher') }}" class="needs-validation" novalidate
        style="width: 80%; margin:auto;">
        @csrf
        <label for="name">الاسم الأول</label>
        <input type="text" class="form-control" id="name" name="name" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأول
        </div>
        <label for="lastname">الاسم الأخير</label>
        <input type="text" class="form-control" id="lastname" name="lastname" required>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المدرس الأخير
        </div>
        <label for="phone_num">الموبايل</label>
        <input type="text" class="form-control" id="phone_num" name="phone_num" required>
        <div class="invalid-feedback">
            الرجاء ادخال رقم الموبايل
        </div>

        <div class="row row-cols-2">
            <div class="col">
                <label for="salary">الراتب</label>
                <input type="number" id="salary" name="salary" class="form-control" required>
            </div>
            <div class="col">
                <select id="salarytype" name="salarytype" style="  margin-top: 7%;">
                    <option value="مقطوع" selected>مقطوع</option>
                    <option value="%">نسبة(%)</option>
                </select>
            </div>
        </div>
        <label for="subject" class="form-label">المواد</label>
        <select id="subject" class="form-select" name="subject[]" multiple="multiple" required>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->name }}">{{ $subject->name }}</option>
            @endforeach
        </select>

        <label for="department">اختر القسم:</label>
        <select id="department" name="department_id" class="form-select" required>
            @if (auth()->user()->department_id == null)
                <option value="">اختر القسم</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            @else
                <option value="{{ auth()->user()->department_id }}" selected>
                    {{ $departments->firstWhere('id', auth()->user()->department_id)->name ?? 'القسم غير متوفر' }}
                </option>
            @endif
        </select>
        {{-- <div class="invalid-feedback">
                    الرجاء ادخال مواد المدرس
                    </div>  --}}
        </br> </br>
        <button type="submit" class="btn btn-primary">حفظ</button>
    </form>
    </br>

    <script>
        $(document).ready(function() {
            $('.form-select').select2();
        });
    </script>
@endsection
