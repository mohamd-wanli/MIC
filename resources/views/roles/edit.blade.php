@extends('layouts.master')

@section('css')
<!-- Internal Font Awesome -->
<link href="{{URL::asset('assets/plugins/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
<!-- Internal Treeview -->
<link href="{{URL::asset('assets/plugins/treeview/treeview-rtl.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
تعديل الصلاحيات
@stop

@section('page-header')
<!-- Breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto text-primary"><i class="fas fa-user-shield"></i> إدارة الصلاحيات</h4>
            <span class="text-muted mt-1 tx-13 mr-2 mb-0"> / تعديل الصلاحيات</span>
        </div>
    </div>
</div>
<!-- Breadcrumb -->
@endsection

@section('content')

<!-- عرض الأخطاء إن وجدت -->
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>⚠ خطأ!</strong> يرجى التحقق من الأخطاء التالية:
    <ul>
        @foreach ($errors->all() as $error)
            <li>❌ {{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Form -->
<form method="POST" action="{{ route('roles.update', $role->id) }}">
    @csrf
    @method('PATCH')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg rounded-lg border-0">
                <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> تعديل الصلاحية</h5>
                    <a class="btn btn-light btn-sm" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i> رجوع</a>
                </div>
                <div class="card-body">
                    <!-- إدخال اسم الصلاحية -->
                    <div class="form-group">
                        <label class="font-weight-bold"><i class="fas fa-key"></i> اسم الصلاحية:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="أدخل اسم الصلاحية"
                               value="{{ old('name', $role->name ?? '') }}">
                    </div>

                    <!-- عرض الصلاحيات -->
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <div class="border rounded p-3">
                                <h6 class="text-center font-weight-bold"><i class="fas fa-lock"></i> قائمة الصلاحيات</h6>
                                <ul id="treeview1" class="list-group">
    @foreach($permission as $value)
        <li class="list-group-item d-flex align-items-center">
            <input type="checkbox" name="permission[]" value="{{ $value->name }}" class="mr-2"
            {{ in_array($value->id, $rolePermissions) ? 'checked' : '' }}>
            <i></i> {{ $value->name }}
        </li>
    @endforeach
</ul>

                            </div>
                        </div>
                    </div>

                    <!-- زر التحديث -->
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-warning btn-lg"><i class="fas fa-save"></i> تحديث</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection

@section('js')
<!-- Internal Treeview js -->
<script src="{{URL::asset('assets/plugins/treeview/treeview.js')}}"></script>
@endsection
