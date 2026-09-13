@extends('layouts.master')

<!-- Internal Nice-select css  -->
@section('title')
اضافة مستخدم
@stop

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
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                action="{{ route('users.store', 'test') }}" method="post">
                @csrf

                <div class="">
                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6" id="fnWrapper">
                            <label>اسم المستخدم: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="name" required type="text" value="{{ old('name') }}">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>البريد الالكتروني: <span class="tx-danger">*</span></label>
                            <input class="form-control form-control-sm mg-b-20"
                                data-parsley-class-handler="#lnWrapper" name="email" required="" type="text">
                        </div>
                    </div>
                </div>

                <div class="row mg-b-20">
                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>كلمة المرور: <span class="tx-danger">*</span></label>
                        <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                            name="password" required type="password">
                    </div>

                    <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                        <label>تأكيد كلمة المرور: <span class="tx-danger">*</span></label>
                        <input class="form-control form-control-sm mg-b-20" data-parsley-class-handler="#lnWrapper"
                            name="password_confirmation" required type="password">
                    </div>
                </div>

                <div class="row row-sm mg-b-20">
                    <div class="col-lg-6">
                        <label class="form-label">حالة المستخدم</label>
                        <select name="Status" id="select-beast" class="form-control  nice-select  custom-select">
                            <option value="مفعل">مفعل</option>
                            <option value="غير مفعل">غير مفعل</option>
                        </select>
                    </div>
                </div>

                    <div class="col-lg-6">
                        <label class="form-label">القسم</label>
                        <select name="department_id" id="department_id" class="form-control">

                            <option value="" disabled selected>اختر القسم</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input type="hidden" name="department_id_hidden" id="department_id_hidden">


                <label>اختر الأدوار (اختياري):</label>
    <select name="roles[]" id="roles" class="form-control" multiple>
        @foreach ($roles as $role)
            <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
    </select>

                {{-- <div class="row mb-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">دور المستخدم</label>
                            <select name="roles_name[]" class="form-control" multiple>
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, old('roles_name', [])) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div> --}}

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">تأكيد</button>
                </div>
            </form>
            <script>
              document.getElementById('department_id').addEventListener('change', function() {
    let departmentId = this.value;
    let rolesSelect = document.getElementById('roles');

    // تحديث الحقل المخفي بالقسم المحدد
    document.getElementById('department_id_hidden').value = departmentId;

    // إذا تم اختيار قسم، اجلب الأدوار المرتبطة به تلقائيًا
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
