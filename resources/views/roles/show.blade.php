@extends('layouts.master')

@section('css')
<!-- Internal Font Awesome -->
<link href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}" rel="stylesheet">

<!-- Internal Treeview -->
<link href="{{ asset('assets/plugins/treeview/treeview-rtl.css') }}" rel="stylesheet" type="text/css" />
@section('title')
عرض الصلاحيات
@stop
@endsection

@section('content')

<!-- Page Header -->
<div class="page-header">
    <h3 class="page-title text-center text-primary">عرض الصلاحيات</h3>
</div>

<!-- Row -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg rounded-lg border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-shield-alt"></i> صلاحيات المستخدم</h5>
                <a class="btn btn-light btn-sm" href="{{ route('roles.index') }}"><i class="fas fa-arrow-left"></i> رجوع</a>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <h4 class="text-dark font-weight-bold"><i class="fas fa-user-shield"></i> {{ $role->name }}</h4>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <ul id="treeview1" class="list-group">
                            @if(!empty($rolePermissions))
                                @foreach($rolePermissions as $v)
                                    <li class="list-group-item d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success mr-2"></i> {{ $v->name }}
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item text-center text-danger">
                                    لا توجد صلاحيات متاحة لهذا الدور
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('assets/plugins/treeview/treeview.js') }}"></script>

@endsection
