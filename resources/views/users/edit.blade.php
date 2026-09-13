@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
تعديل مستخدم
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل
                مستخدم</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">رجوع</a>
                    </div>
                </div><br>

                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name">اسم المستخدم: <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="email">البريد الإلكتروني: <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password">كلمة المرور الجديدة (اتركها فارغة إذا لم ترغب في تغييرها):</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="confirm-password">تأكيد كلمة المرور:</label>
                            <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>حالة المستخدم:</label>
                            <select name="Status" class="form-control">
                                <option value="مفعل" {{ $user->Status == 'مفعل' ? 'selected' : '' }}>مفعل</option>
                                <option value="غير مفعل" {{ $user->Status == 'غير مفعل' ? 'selected' : '' }}>غير مفعل</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">القسم</label>
                            <select name="department_id" id="department_id" class="form-control">
                                <!-- الخيار "اختر القسم" سيكون الخيار الأول دائما، وإذا كان هناك قسم مختار، سيتم تحديده -->
                                <option value="" {{ is_null($user->department_id) ? 'selected' : '' }}>اختر القسم</option>

                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}"
                                        {{ old('department_id', $user->department_id) == $department->id ? 'selected' : '' }}>
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>



                        <div class="col-lg-6">
                            <label>اختر الأدوار (اختياري):</label>
                            <select name="roles[]" id="roles" class="form-control" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" {{ in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>
                <script>
                    document.getElementById('department_id').addEventListener('change', function() {
                        let departmentId = this.value;
                        let rolesSelect = document.getElementById('roles');

                        if (departmentId) {
                            fetch(`/get-department-roles/${departmentId}`)
                                .then(response => response.json())
                                .then(data => {
                                    rolesSelect.innerHTML = ""; // تفريغ الخيارات الحالية
                                    data.roles.forEach(role => {
                                        let option = new Option(role.name, role.id);
                                        rolesSelect.add(option);
                                    });
                                });
                        }
                    });
                    </script>

            </div>
        </div>
    </div>
</div>




</div>
<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
@endsection
