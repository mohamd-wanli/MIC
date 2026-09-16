@extends('layouts.master')

@section('title', 'المستخدمون')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- row opened -->
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="col-sm-1 col-md-2">
                    @can('اضافة مستخدم')
                        <a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">اضافة مستخدم</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive hoverable-table">
                    <table class="table table-hover" id="example1" data-page-length='50' style="text-align: center;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المستخدم</th>
                                <th>البريد الالكتروني</th>
                                <th>حالة المستخدم</th>
                                <th>نوع المستخدم</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $i => $user)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="label text-{{ $user->Status == 'مفعل' ? 'success' : 'danger' }} d-flex">
                                            <div class="dot-label bg-{{ $user->Status == 'مفعل' ? 'success' : 'danger' }} ml-1"></div>
                                            {{ $user->Status }}
                                        </span>
                                    </td>
                                 <td>
    @if ($user->roles->isNotEmpty())
        @foreach ($user->roles as $role)
            <span class="badge badge-success" style="color: black">{{ $role->name }}</span>
        @endforeach
    @endif
</td>

                                    <td>
                                        @can('تعديل مستخدم')
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-info"
                                               title="تعديل"><i class="las la-pen"></i>تعديل</a>
                                        @endcan

                                        @can('حذف مستخدم')
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modaldemo8"
                                                    data-user_id="{{ $user->id }}"
                                                    data-username="{{ $user->name }}"
                                                    title="حذف">
                                                <i class="las la-trash">حذف</i>
                                            </button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal effects -->
    <div class="modal fade" id="modaldemo8" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">حذف المستخدم</h6>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deleteUserForm" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <p>هل أنت متأكد من عملية الحذف؟</p><br>
                        <input type="hidden" name="user_id" id="user_id">
                        <input class="form-control" name="username" id="username" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-danger">تأكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteModal = document.getElementById('modaldemo8');

        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var userId = button.getAttribute('data-user_id');
            var username = button.getAttribute('data-username');

            document.getElementById('user_id').value = userId;
            document.getElementById('username').value = username;

            // تحديث رابط الفورم للحذف
            var form = document.getElementById('deleteUserForm');
            form.action = "{{ url('users') }}/" + userId;
        });
    });
</script>

<!-- DataTables & Other Scripts -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/js/table-data.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script src="{{ asset('assets/js/modal.js') }}"></script>

@endsection
