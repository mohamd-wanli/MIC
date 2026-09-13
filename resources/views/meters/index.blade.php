@extends('layouts.master')

@section('title', 'إدارة المواد')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">قائمة المواد</h2>

    <!-- رسالة نجاح -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- زر إضافة مادة جديدة -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMeterModal">إضافة مادة جديدة</button>

    <!-- جدول عرض المواد -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>اسم المادة</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($meters as $index => $meter)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $meter->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- نموذج إضافة مادة جديدة -->
<div class="modal fade" id="addMeterModal" tabindex="-1" aria-labelledby="addMeterModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMeterModalLabel">إضافة مادة جديدة</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('meters.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">اسم المادة</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">حفظ</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
