@extends('layouts.master')
@section('title')
    إضافة مادة
@endsection
@section('content')
    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @elseif (session('delete'))
        <p style="color:red">{{ session('delete') }}</p>
    @elseif (session('error'))
        <p style="color:red">{{ session('error') }} </p>
    @endif

    <form method="post" class="needs-validation" novalidate action="{{ route('storesubject') }}"
        style="width: 80%; margin:auto;">
        @csrf
        <label for="name">اسم المادة</label>
        <input type="text" class="form-control" id="name" name="name" required></br>
        <div class="invalid-feedback">
            الرجاء ادخال اسم المادة
        </div>

        <!-- عرض القسم الحالي فقط -->
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
        

        <button type="submit" class="btn btn-primary" style="margin-top: 1%;">حفظ</button>
    </form>
    </br>
@endsection
