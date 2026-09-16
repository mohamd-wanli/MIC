@extends('layouts.master')

@section('title', isset($isCreating) ? 'إضافة طالب جديد' : 'تحديث بيانات الطالب')

@section('css')
<style>
    /* ============================================
       MODERN STUDENT PROFILE STYLES
       ============================================ */

    /* Page Header */
    .page-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        border-radius: 16px 16px 0 0;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
    }

    .page-header-modern::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .page-header-modern::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -5%;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.03);
        border-radius: 50%;
        pointer-events: none;
    }

    .page-header-modern h3 {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.6rem;
        margin: 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header-modern p {
        color: rgba(255, 255, 255, 0.85);
        margin: 5px 0 0 0;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    .page-header-modern .header-stats {
        display: flex;
        gap: 20px;
        position: relative;
        z-index: 1;
        flex-wrap: wrap;
    }

    .page-header-modern .header-stats .stat-item {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 8px 18px;
        border-radius: 50px;
        color: #ffffff;
        font-size: 0.85rem;
        border: 1px solid rgba(255, 255, 255, 0.1);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .page-header-modern .header-stats .stat-item strong {
        font-size: 1.1rem;
    }

    /* Main Card */
    .main-card-modern {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        border: 1px solid #eef2f7;
    }

    /* Action Bar */
    .action-bar-modern {
        background: #f8faff;
        padding: 15px 25px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .action-bar-modern .btn-modern {
        padding: 8px 22px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .action-bar-modern .btn-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .action-bar-modern .btn-back {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
    }

    .action-bar-modern .btn-danger-modern {
        background: linear-gradient(135deg, #eb3349, #f45c43);
        color: #ffffff;
    }

    .action-bar-modern .btn-info-modern {
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        color: #ffffff;
    }

    /* Form Container */
    .form-container-modern {
        padding: 25px;
    }

    /* Section Title */
    .section-title-modern {
        font-size: 1rem;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 2px solid #eef2f7;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title-modern .section-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        font-size: 0.75rem;
        font-weight: 700;
        flex-shrink: 0;
    }

    .section-title-modern i {
        color: #667eea;
    }

    /* Form Groups - FIXED */
    .form-group-modern {
        margin-bottom: 15px;
    }

    .form-group-modern label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.85rem;
        margin-bottom: 4px;
        display: block;
    }

    .form-group-modern .form-control,
    .form-group-modern .form-select {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 8px 15px !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
        height: 40px !important;
        box-shadow: none !important;
        width: 100% !important;
        display: block !important;
        color: #2d3436 !important;
    }

    .form-group-modern .form-control:focus,
    .form-group-modern .form-select:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .form-group-modern .form-control::placeholder {
        color: #adb5bd;
        font-size: 0.85rem;
    }

    .form-group-modern textarea.form-control {
        height: auto !important;
        min-height: 80px;
        resize: vertical;
    }

    /* Table Styles - FIXED */
    .table-modern {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 0;
    }

    .table-modern thead th {
        font-weight: 600;
        padding: 12px 15px;
        text-align: center;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        border-bottom: 2px solid #eef2f7;
        background: #f8faff;
        color: #2d3436;
    }

    .table-modern thead th.primary-header {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border: none;
    }

    .table-modern thead th.info-header {
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        color: #ffffff;
        border: none;
    }

    .table-modern thead th.warning-header {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #2d3436;
        border: none;
    }

    .table-modern tbody td {
        padding: 10px 15px;
        text-align: center;
        vertical-align: middle;
        color: #2d3436;
        border-bottom: 1px solid #f1f3f8;
    }

    .table-modern tbody tr:hover {
        background: #f8faff;
    }

    .table-modern tbody tr:last-child td {
        border-bottom: none;
    }

    /* Fix for input inside table */
    .table-modern .form-control,
    .table-modern .form-select {
        border-radius: 8px !important;
        border: 2px solid #e8edf5 !important;
        padding: 6px 12px !important;
        font-size: 0.85rem !important;
        background: #ffffff !important;
        height: 38px !important;
        width: 100% !important;
        min-width: 100px !important;
        color: #2d3436 !important;
    }

    .table-modern .form-control:focus,
    .table-modern .form-select:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
        outline: none !important;
    }

    /* Status Badges */
    .status-badge {
        padding: 3px 14px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-block;
    }

    .status-badge.success {
        background: #d4edda;
        color: #155724;
    }

    .status-badge.warning {
        background: #fff3cd;
        color: #856404;
    }

    .status-badge.danger {
        background: #f8d7da;
        color: #721c24;
    }

    .status-badge.info {
        background: #d1ecf1;
        color: #0c5460;
    }

    /* Table Action Buttons */
    .table-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        border: none;
        cursor: pointer;
        margin: 2px;
    }

    .table-action-btn:hover {
        transform: translateY(-2px);
        text-decoration: none;
    }

    .table-action-btn.btn-primary-sm {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
    }

    .table-action-btn.btn-primary-sm:hover {
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        color: #ffffff;
    }

    .table-action-btn.btn-danger-sm {
        background: linear-gradient(135deg, #eb3349, #f45c43);
        color: #ffffff;
    }

    .table-action-btn.btn-danger-sm:hover {
        box-shadow: 0 4px 15px rgba(235, 51, 73, 0.4);
        color: #ffffff;
    }

    .table-action-btn.btn-success-sm {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
    }

    .table-action-btn.btn-success-sm:hover {
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);
        color: #ffffff;
    }

    .table-action-btn.btn-warning-sm {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        color: #2d3436;
    }

    .table-action-btn.btn-warning-sm:hover {
        box-shadow: 0 4px 15px rgba(247, 151, 30, 0.4);
        color: #2d3436;
    }

    /* Submit Button */
    .btn-submit-modern {
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: #ffffff;
        border: none;
        padding: 12px 50px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
    }

    .btn-submit-modern:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.45);
        color: #ffffff;
    }

    .btn-submit-modern:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    /* Alert Styles */
    .alert-modern {
        border-radius: 12px !important;
        padding: 16px 20px !important;
        border: none !important;
        font-weight: 500 !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06) !important;
        margin-bottom: 25px !important;
    }

    .alert-modern i {
        font-size: 1.3rem !important;
    }

    .alert-modern.alert-success {
        background: linear-gradient(135deg, #d4edda, #c3e6cb) !important;
        color: #155724 !important;
        border-right: 4px solid #28a745 !important;
    }

    .alert-modern.alert-danger {
        background: linear-gradient(135deg, #f8d7da, #f5c6cb) !important;
        color: #721c24 !important;
        border-right: 4px solid #dc3545 !important;
    }

    .alert-modern.alert-warning {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7) !important;
        color: #856404 !important;
        border-right: 4px solid #ffc107 !important;
    }

    .alert-modern.alert-info {
        background: linear-gradient(135deg, #d1ecf1, #bee5eb) !important;
        color: #0c5460 !important;
        border-right: 4px solid #17a2b8 !important;
    }

    /* Course Add Section */
    .add-course-section {
        background: #f8faff;
        padding: 20px;
        border-radius: 12px;
        border: 2px dashed #e8edf5;
        margin: 20px 0;
    }

    .add-course-section .btn-add {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        color: #ffffff;
        border: none;
        padding: 10px 30px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .add-course-section .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(17, 153, 142, 0.4);
    }

    /* Notes Section */
    .notes-section {
        background: #f8faff;
        padding: 15px 20px;
        border-radius: 10px;
        border: 1px solid #eef2f7;
        margin-top: 10px;
    }

    .notes-section .note-item {
        background: #ffffff;
        padding: 10px 15px;
        border-radius: 8px;
        border-right: 3px solid #667eea;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .notes-section .note-item:last-child {
        margin-bottom: 0;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .page-header-modern {
            padding: 20px;
        }
        .page-header-modern h3 {
            font-size: 1.3rem;
        }
        .action-bar-modern {
            padding: 12px 20px;
            flex-direction: column;
            align-items: stretch;
        }
        .action-bar-modern .btn-modern {
            justify-content: center;
        }
        .form-container-modern {
            padding: 15px;
        }
        .table-modern {
            font-size: 0.8rem;
            min-width: 800px;
        }
        .table-modern thead th {
            font-size: 0.7rem;
            padding: 10px 10px;
        }
        .table-modern tbody td {
            padding: 10px 10px;
            font-size: 0.8rem;
        }
        .table-modern .form-control,
        .table-modern .form-select {
            min-width: 80px !important;
            font-size: 0.8rem !important;
            height: 34px !important;
        }
    }

    @media (max-width: 767px) {
        .page-header-modern .header-stats {
            gap: 10px;
            margin-top: 10px;
        }
        .page-header-modern .header-stats .stat-item {
            font-size: 0.7rem;
            padding: 4px 12px;
        }
        .table-modern {
            min-width: 700px;
            font-size: 0.75rem;
        }
        .table-modern thead th {
            font-size: 0.65rem;
            padding: 8px 8px;
        }
        .table-modern tbody td {
            padding: 8px 8px;
            font-size: 0.75rem;
        }
        .table-modern .form-control,
        .table-modern .form-select {
            min-width: 70px !important;
            font-size: 0.75rem !important;
            height: 32px !important;
            padding: 4px 8px !important;
        }
        .table-action-btn {
            padding: 4px 10px;
            font-size: 0.65rem;
        }
        .btn-submit-modern {
            padding: 10px 30px;
            font-size: 0.9rem;
            width: 100%;
            justify-content: center;
        }
        .add-course-section {
            padding: 15px;
        }
        .section-title-modern {
            font-size: 0.9rem;
        }
        .section-title-modern .section-number {
            width: 24px;
            height: 24px;
            font-size: 0.65rem;
        }
    }

    @media (max-width: 480px) {
        .page-header-modern h3 {
            font-size: 1.1rem;
        }
        .page-header-modern p {
            font-size: 0.8rem;
        }
        .table-modern {
            min-width: 600px;
            font-size: 0.7rem;
        }
        .table-modern thead th {
            font-size: 0.55rem;
            padding: 6px 6px;
        }
        .table-modern tbody td {
            padding: 6px 6px;
            font-size: 0.7rem;
        }
        .table-modern .form-control,
        .table-modern .form-select {
            min-width: 60px !important;
            font-size: 0.7rem !important;
            height: 28px !important;
            padding: 3px 6px !important;
        }
        .notes-section .note-item {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    @if (session('success'))
        <div class="alert-modern alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Main Card -->
    <div class="main-card-modern">

        <!-- Page Header - UPDATED -->
        <div class="page-header-modern">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <h3>
                        <i class="fas {{ isset($isCreating) ? 'fa-user-plus' : 'fa-user-edit' }}"></i>
                        {{ isset($isCreating) ? 'إضافة طالب جديد' : 'تحديث بيانات الطالب' }}
                    </h3>
                    <p><i class="fas fa-info-circle"></i>
                        {{ isset($isCreating) ? 'إدخال جميع بيانات الطالب الجديد' : 'عرض وتحديث جميع بيانات الطالب بما في ذلك الدورات والمدفوعات' }}
                    </p>
                </div>
                @if(!isset($isCreating))
                <div class="col-md-5 mt-2 mt-md-0">
                    <div class="header-stats justify-content-md-end">
                        <span class="stat-item">
                            <i class="fas fa-user"></i>
                            الطالب: <strong>{{ $students->fullname }}</strong>
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-book"></i>
                            الدورات: <strong>{{ $students->courses->count() }}</strong>
                        </span>
                        <span class="stat-item">
                            <i class="fas fa-coins"></i>
                            المدفوعات: <strong>{{ $students->payments->count() }}</strong>
                        </span>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Action Bar - UPDATED -->
        <div class="action-bar-modern">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ url('/student') }}" class="btn-modern btn-back">
                    <i class="fas fa-arrow-right"></i>
                    عودة
                </a>
                @if(!isset($isCreating))
                <button type="button" class="btn-modern btn-danger-modern" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $students->id }}">
                    <i class="fas fa-trash-alt"></i>
                    حذف الطالب
                </button>
                @endif
            </div>
            <span style="color: #6c757d; font-size: 0.85rem;">
                <i class="fas fa-asterisk text-danger"></i> الحقول المطلوبة
            </span>
        </div>

        <!-- Form Body -->
        <div class="form-container-modern">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ isset($isCreating) ? route('student.store') : route('update_status', $students->id) }}">
                @csrf

                <!-- Section 1: Personal Information -->
                <div class="section-title-modern">
                    <span class="section-number">1</span>
                    <i class="fas fa-user"></i>
                    المعلومات الشخصية
                </div>

                <div class="table-responsive">
                    <table class="table-modern">
                        <thead>
                            <tr>
                                <th class="primary-header" colspan="10">المعلومات الشخصية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>الاسم الأول:</strong></td>
                                <td><input type="text" name="firstname" class="form-control" value="{{ old('firstname', $students->firstname) }}"></td>
                                <td><strong>الكنية:</strong></td>
                                <td><input type="text" name="lastname" class="form-control" value="{{ old('lastname', $students->lastname) }}"></td>
                                <td><strong>اسم الأب:</strong></td>
                                <td><input type="text" name="fathername" class="form-control" value="{{ old('fathername', $students->fathername) }}"></td>
                                <td><strong>الاسم الكامل:</strong></td>
                                <td><input type="text" name="fullname" class="form-control" value="{{ old('fullname', $students->fullname) }}"></td>
                            </tr>

                            @foreach ($data as $y)
                            <tr>
                                <td><strong>اسم الأم:</strong></td>
                                <td><input type="text" name="mothername" class="form-control" value="{{ old('mothername', $y->mothername) }}"></td>
                                <td><strong>الرقم الوطني:</strong></td>
                                <td><input type="text" name="national_number" class="form-control" value="{{ old('national_number', $students->national_number) }}"></td>
                                 <td><strong>مكان الولادة:</strong></td>
    <td>
        <input type="text" name="date_of_birth" class="form-control"
               value="{{ old('date)of)birth', $y->date_of_birth) }}"
               placeholder="أدخل مكان الولادة">
    </td>
                                <td><strong>الجنسية:</strong></td>
                                <td><input type="text" name="nationality" class="form-control" value="{{ old('nationality', $y->nationality) }}"></td>
                            </tr>

                            <tr>
                                <td><strong>رقم الهاتف:</strong></td>
                                <td><input type="text" name="telephone" class="form-control" value="{{ old('telephone', $y->telephone) }}"></td>
                                <td><strong>رقم الموبايل:</strong></td>
                                <td><input type="text" name="mobile" class="form-control" value="{{ old('mobile', $y->mobile) }}"></td>
                                <td><strong>المستوى الثقافي:</strong></td>
                                <td><input type="text" name="cultural_level" class="form-control" value="{{ old('cultural_level', $y->cultural_level) }}"></td>
                                <td><strong>الجنس:</strong></td>
                                <td>
                                    <select name="gender" class="form-select">
                                        <option value="ذكر" {{ old('gender', $y->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                        <option value="أنثى" {{ old('gender', $y->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <td><strong>الاسم الأول انكليزي:</strong></td>
                                <td><input type="text" name="engish_firstname" class="form-control" value="{{ old('engish_firstname', $y->engish_firstname) }}"></td>
                                <td><strong>الكنية انكليزي:</strong></td>
                                <td><input type="text" name="english_lastname" class="form-control" value="{{ old('english_lastname', $y->english_lastname) }}"></td>
                                <td><strong>اسم الأب انكليزي:</strong></td>
                                <td><input type="text" name="engish_fathername" class="form-control" value="{{ old('engish_fathername', $y->engish_fathername) }}"></td>
                                <td><strong>العنوان:</strong></td>
                                <td><input type="text" name="address" class="form-control" value="{{ old('address', $y->address) }}"></td>
                            </tr>

                            <tr>
                                <td><strong>تاريخ وصول الشهادة:</strong></td>
                                <td><input type="date" name="print_date" class="form-control" value="{{ old('print_date', $y->print_date) }}"></td>


     <td><strong>تاريخ الميلاد (للحساب):</strong></td>
    <td>
        <input type="date" name="birth_date" class="form-control"
               value="{{ old('birth_date', $y->birth_date) }}">
        @php
            $age = $students->getAge();
        @endphp
        @if($age !== null)
            <small class="text-muted d-block mt-1">
                العمر: <strong>{{ $age }} سنة</strong>
                @if($students->isCertificateEligible())
                    <span class="badge bg-success">✅ مؤهل للشهادة</span>
                @else
                    <span class="badge bg-danger">❌ غير مؤهل (أقل من 15)</span>
                @endif
            </small>
        @else
            <small class="text-muted d-block mt-1">⚠️ لم يتم إدخال تاريخ الميلاد الصحيح</small>
        @endif
    </td>
                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="8">
                                    <div class="form-group-modern">
                                        <label><strong>ملاحظات</strong></label>
                                        <textarea name="notes" class="form-control" rows="3">{{ old('notes', optional($students->Extrastudent)->notes ?? '') }}</textarea>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn-submit-modern">
                        <i class="fas fa-save"></i>
                        {{ isset($isCreating) ? 'إضافة الطالب' : 'تحديث البيانات' }}
                    </button>
                </div>
            </form>

            <!-- ==========================================
            ADD STUDENT TO COURSE (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">2</span>
                <i class="fas fa-plus-circle"></i>
                إضافة الطالب إلى دورة
            </div>

            <div class="add-course-section">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <div class="form-group-modern">
                            <label for="course_number">رقم الدورة</label>
                            <input type="number" id="course_number" class="form-control" placeholder="أدخل رقم الدورة">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group-modern">
                            <label for="subject_selector">اختر المادة</label>
                            <select id="subject_selector" class="form-select">
                                <option value="">أدخل رقم الدورة أولاً</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button id="add_student_to_course" class="btn-add">
                            <i class="fas fa-user-plus"></i>
                            إضافة الطالب إلى الدورة
                        </button>
                        <p id="status_message" style="margin-top: 8px; font-weight: 600;"></p>
                    </div>
                </div>
            </div>
            @endif

            <!-- ==========================================
            ENROLLED COURSES (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">3</span>
                <i class="fas fa-book"></i>
                الدورات المسجل فيها
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th class="primary-header" colspan="14">الدورات المسجل فيها الطالب</th>
                        </tr>
                        <tr>
                            <th>رقم الدورة</th>
                            <th>اسم الدورة</th>
                            <th>تاريخ البداية</th>
                            <th>تاريخ النهاية</th>
                            <th>ساعة البداية</th>
                            <th>ساعة النهاية</th>
                            <th>سعر الدورة</th>
                            <th>رقم الصفحة</th>
                            <th>رقم العام</th>
                            <th>رقم تسلسل</th>
                            <th>المتبقي</th>
                            <th>حالة الطباعة</th>
                              <th>التقدير</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody id="enrolled_courses">
                        @foreach ($students->courses as $course)
                            @php
                              $totalPaid     = $students->payments->where('course_id', $course->id)->sum('payment_value');
$totalDiscount = $students->payments->where('course_id', $course->id)->sum('discount');
$remaining     = $course->price - $totalPaid - $totalDiscount;
                            @endphp
                            <tr>
                                <td><span style="font-weight: 700; color: #667eea;">{{ $course->coursenumber }}</span></td>
                                <td>{{ $course->subject_name }}</td>
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->end_date }}</td>
                                <td>{{ $course->start_hour }}</td>
                                <td>{{ $course->end_hour }}</td>
                                <td><strong>{{ number_format($course->price) }} ل.س</strong></td>
                                <td>{{ $course->pivot->page_number ?? '—' }}</td>
                                <td>
                                    <form action="{{ route('update.course.year.serial', [$students->id, $course->id]) }}" method="POST" style="display: inline-flex; gap: 5px; align-items: center;">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="year_number" class="form-control"
                                               placeholder="رقم العام"
                                               value="{{ $course->pivot->year_number ?? '' }}"
                                               style="width: 80px; height: 32px; font-size: 0.8rem; text-align: center;">
                                        <button type="submit" class="table-action-btn btn-primary-sm" style="padding: 2px 10px;">حفظ</button>
                                    </form>
                                </td>
                                <td>
                                    <span style="font-weight: 600; color: #667eea;">
                                        {{ $course->pivot->serial_number ?? '—' }}
                                    </span>
                                </td>
                                <td>
                                    @if($totalPaid == 0)
                                        <span class="status-badge danger">{{ number_format($course->price) }} ل.س</span>
                                    @elseif($remaining > 0)
                                        <span class="status-badge warning">{{ number_format($remaining) }} ل.س</span>
                                    @else
                                        <span class="status-badge success"><i class="fas fa-check"></i> مسدد بالكامل</span>
                                    @endif
                                </td>
                                <td>
                                    @if($course->pivot->printed_at)
                                        <span class="badge bg-success">✅ تم</span>
                                    @else
                                        <span class="badge bg-secondary">❌ لم تطبع</span>
                                    @endif
                                </td>
                                <td>
    <form action="{{ route('update.course.grade', [$students->id, $course->id]) }}" method="POST" style="display: inline-flex; gap: 5px; align-items: center;">
        @csrf
        @method('PUT')
        <input type="text" name="coursegrade" class="form-control"
               placeholder="التقدير"
               value="{{ $course->pivot->coursegrade ?? '' }}"
               style="width: 80px; height: 32px; font-size: 0.8rem; text-align: center;">
        <button type="submit" class="table-action-btn btn-success-sm" style="padding: 2px 10px;">
            <i class="fas fa-save"></i>
        </button>
    </form>
</td>
                                <td>
                                    <button class="table-action-btn btn-danger-sm" onclick="confirmDelete({{ $students->id }}, {{ $course->id }})">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                    <button class="table-action-btn btn-primary-sm" onclick="showTransferModal({{ $students->id }}, {{ $course->id }}, '{{ $course->coursenumber }}', '{{ $course->subject_name }}')">
                                        <i class="fas fa-exchange-alt"></i> نقل
                                    </button>
                                    <a href="{{ route('students.profile.pdf', [$students->id, $course->id]) }}" class="table-action-btn btn-success-sm" target="_blank">
                                        <i class="fas fa-print"></i> طباعة
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <!-- ==========================================
            PAYMENTS (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">4</span>
                <i class="fas fa-money-bill-wave"></i>
                المدفوعات
            </div>

            <!-- Payment Stats -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 15px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-coins" style="font-size: 1.5rem; color: #667eea;"></i>
                        <h5 style="margin: 5px 0 0 0; font-weight: 700; color: #667eea;">
                            {{ number_format($students->payments->sum('payment_value')) }} ل.س
                        </h5>
                        <span style="color: #6c757d; font-size: 0.8rem;">إجمالي المدفوعات</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 15px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-receipt" style="font-size: 1.5rem; color: #11998e;"></i>
                        <h5 style="margin: 5px 0 0 0; font-weight: 700; color: #11998e;">
                            {{ $students->payments->count() }}
                        </h5>
                        <span style="color: #6c757d; font-size: 0.8rem;">عدد المدفوعات</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 15px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-credit-card" style="font-size: 1.5rem; color: #f7971e;"></i>
                        <h5 style="margin: 5px 0 0 0; font-weight: 700; color: #f7971e;">
                            {{ $students->payments->groupBy('payment_type')->count() }}
                        </h5>
                        <span style="color: #6c757d; font-size: 0.8rem;">أنواع الدفع</span>
                    </div>
                </div>
            </div>

            <!-- Add Payment Button -->
            <div class="mt-3 mb-3">
                <button id="addPaymentButton" class="table-action-btn btn-success-sm" style="padding: 8px 25px; font-size: 0.85rem;">
                    <i class="fas fa-plus-circle"></i> إضافة دفعة جديدة
                </button>
            </div>

            <!-- Add Payment Form -->
            <div id="addPaymentForm" style="display: none; background: #f8faff; padding: 20px; border-radius: 12px; margin-top: 15px; border: 2px dashed #e8edf5;">
                <form id="paymentForm">
                    @csrf
                {{-- <div class="row"> --}}
                    <div class="row">
    <div class="col-md-3">
        <div class="form-group-modern">
            <label for="receipt_number">رقم الوصل <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="receipt_number" required
                   placeholder="مثال: 00105">
        </div>
    </div>
                      <div class="col-md-3">
        <div class="form-group-modern">
            <label for="collected_at">تاريخ التحصيل <span class="text-danger">*</span></label>
            <input type="date" class="form-control" id="collected_at" required
                   value="{{ date('Y-m-d') }}">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group-modern">
            <label for="paymentCategory">نوع الدفعة <span class="text-danger">*</span></label>
            <select class="form-control" id="paymentCategory" required>
                <option value="course">دفعة دورة</option>
                <option value="certificate">دفعة شهادة</option>
                <option value="other">دفعة أخرى (رسوم، ...)</option>
            </select>
        </div>
    </div>
    <div class="col-md-3" id="courseSelectWrapper">
        <div class="form-group-modern">
            <label for="paymentCourse">اختر الدورة <span class="text-danger" id="courseRequired">*</span></label>
            <select class="form-control" id="paymentCourse" required>
                <option value="">-- اختر دورة --</option>
                @foreach ($students->courses as $course)
                    <option value="{{ $course->id }}" data-price="{{ $course->price }}" data-coursename="{{ $course->subject_name }}">
                        {{ $course->coursenumber }} - {{ $course->subject_name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group-modern">
            <label for="paymentValue">قيمة الدفعة (ل.س) <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="paymentValue" required
                   placeholder="المبلغ" min="1" step="0.01">
        </div>
    </div>
         <div class="col-md-2">
                <div class="form-group-modern">
                    <label for="discount" style="color:#eb3349;">
                        <i class="fas fa-percent"></i> الحسم (ل.س)
                    </label>
                    <input type="number" class="form-control" id="discount"
                           placeholder="0" min="0" step="0.01" value="0"
                           style="border-color:#f8d7da;">
                </div>
            </div>
    <div class="col-md-2">
        <div class="form-group-modern">
            <label for="paymentType">نوع الدفع <span class="text-danger">*</span></label>
            <select class="form-control" id="paymentType" required>
                <option value="cash">💰 نقدي</option>
                <option value="visa">💳 وثيقة حضور</option>
                <option value="bank">🏦 شهادة</option>
            </select>
        </div>
    </div>
    <div class="col-md-2 d-flex align-items-end gap-2">
        <button type="submit" class="table-action-btn btn-success-sm" style="padding: 8px 25px; font-size: 0.85rem;">
            <i class="fas fa-save"></i> إضافة
        </button>
        <button type="button" class="table-action-btn btn-danger-sm" id="cancelAddPayment" style="padding: 8px 25px; font-size: 0.85rem;">
            <i class="fas fa-times"></i> إلغاء
        </button>
    </div>
</div>

<!-- Remaining balance info (only visible when "دفعة دورة" is selected) -->
<div id="paymentCourseInfo" class="mt-3" style="display: none;">
    <div class="alert alert-info" style="border-radius: 8px; padding: 10px 15px;">
        <i class="fas fa-info-circle"></i>
        <span id="courseInfoText">سعر الدورة: <strong>0</strong> ل.س | المتبقي: <strong>0</strong> ل.س</span>
    </div>
</div>
                    <!-- Show remaining balance info -->
                    <div id="paymentCourseInfo" class="mt-3" style="display: none;">
                        <div class="alert alert-info" style="border-radius: 8px; padding: 10px 15px;">
                            <i class="fas fa-info-circle"></i>
                            <span id="courseInfoText">سعر الدورة: <strong>0</strong> ل.س | المتبقي: <strong>0</strong> ل.س</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Payments Table -->
            <div class="table-responsive mt-3">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th class="info-header" colspan="6">سجل المدفوعات</th>
                        </tr>
                        <tr>
                             <th>#</th>
        <th>رقم الوصل</th>
        <th>الدورة</th>
        <th>المبلغ</th>
             <th>الحسم</th>
        <th>نوع الدفع</th>
        <th>تاريخ التحصيل</th>
        <th>الحالة</th>
        <th>الإجراءات</th>
                        </tr>
                    </thead>
                    {{-- <tbody id="paymentsBody">
                        @php $paymentCount = 1; @endphp
                        @forelse ($students->payments->sortByDesc('created_at') as $payment)
                            <tr id="payment-row-{{ $payment->id }}">
                                <td>{{ $paymentCount++ }}</td>
                                <td>{{ $payment->course->subject_name ?? '—' }}</td>
                                <td><strong>{{ number_format($payment->payment_value) }} ج.م</strong></td>
                                <td>
                                    <span class="status-badge info">
                                        @switch($payment->payment_type)
                                            @case('cash') 💰 نقدي @break
                                            @case('visa') 💳 وثيقة حضور@break
                                            @case('bank') 🏦 شهادة@break
                                            {{-- @case('cheque') 📝 شيك @break --}}
                                            {{-- @default {{ $payment->payment_type }}
                                        @endswitch
                                    </span>
                                </td>
                                <td>{{ $payment->created_at ? $payment->created_at->format('Y-m-d h:i A') : '—' }}</td>
                                <td>
                                    <button class="table-action-btn btn-danger-sm" onclick="deletePayment({{ $payment->id }}, {{ $students->id }})">
                                        <i class="fas fa-trash-alt"></i> حذف
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 30px; color: #adb5bd;">
                                    <i class="fas fa-info-circle"></i> لا توجد مدفوعات مسجلة
                                </td>
                            </tr>
                        @endforelse
                    </tbody> --}}
                    <tbody id="paymentsBody">
    @php $paymentCount = 1; @endphp
    @forelse ($students->payments->sortByDesc('collected_at') as $payment)
        <tr id="payment-row-{{ $payment->id }}">
            <td>{{ $paymentCount++ }}</td>

            {{-- Receipt number --}}
            <td>
                @if($payment->receipt_number)
                    <span style="font-family: monospace; font-weight: 600; color: #667eea;">
                        {{ $payment->receipt_number }}
                    </span>
                @else
                    <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
                @endif
            </td>

            {{-- Course --}}
            <td>{{ $payment->course->subject_name ?? '—' }}</td>

            {{-- Amount --}}
            <td><strong>{{ number_format($payment->payment_value) }} ل.س</strong></td>
            {{-- discount --}}
             <td>
                @if($payment->discount && $payment->discount > 0)
                    <span class="status-badge" style="background:#f8d7da; color:#721c24;">
                        <i class="fas fa-percent"></i>
                        {{ number_format($payment->discount) }} ل.س
                    </span>
                @else
                    <span style="color:#adb5bd;">—</span>
                @endif
            </td>

            {{-- Payment type --}}
            <td>
                <span class="status-badge info">
                    @switch($payment->payment_type)
                        @case('cash') 💰 نقدي @break
                        @case('visa') 💳 وثيقة حضور @break
                        @case('bank') 🏦 شهادة @break
                        @default {{ $payment->payment_type }}
                    @endswitch
                </span>
            </td>

            {{-- Collected date (real payment date) --}}
            <td>
                @if($payment->collected_at)
                    <i class="fas fa-calendar-check" style="color: #11998e; font-size: 0.8rem;"></i>
                    {{ $payment->collected_at->format('Y-m-d') }}
                @else
                    <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
                @endif
            </td>

            {{-- Status: pending or surrendered --}}
            <td>
                @if($payment->surrendered_at)
                    <span class="status-badge success" title="تم التسليم بتاريخ {{ $payment->surrendered_at->format('Y-m-d H:i') }}">
                        <i class="fas fa-check-circle"></i> تم التسليم
                        @if($payment->surrenderedTo)
                            <br>
                            <small style="font-size: 0.65rem;">
                                بواسطة: {{ $payment->surrenderedTo->name }}
                            </small>
                        @endif
                    </span>
                @else
                    <span class="status-badge warning" title="لم يتم تسليمه للصندوق بعد">
                        <i class="fas fa-hourglass-half"></i> في العهدة
                    </span>
                @endif
            </td>

            {{-- Actions --}}
            <td>
                <button class="table-action-btn btn-danger-sm"
                        onclick="deletePayment({{ $payment->id }}, {{ $students->id }})">
                    <i class="fas fa-trash-alt"></i> حذف
                </button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="8" style="text-align: center; padding: 30px; color: #adb5bd;">
                <i class="fas fa-info-circle"></i> لا توجد مدفوعات مسجلة
            </td>
        </tr>
    @endforelse
</tbody>

                </table>
            </div>
            @endif

            <!-- ==========================================
            NOTES (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">5</span>
                <i class="fas fa-sticky-note"></i>
                الملاحظات
            </div>

            <div class="notes-section">
                @forelse ($students->payments as $payment)
                    <div class="note-item">
                        <div>
                            <strong>الدفعة #{{ $loop->iteration }}</strong>
                            @if($payment->note)
                                <span style="color: #2d3436;">{{ $payment->note }}</span>
                            @else
                                <span style="color: #adb5bd;">لا توجد ملاحظات</span>
                            @endif
                        </div>
                        <form action="{{ route('payments.addNote', $payment->id) }}" method="POST" style="display: flex; gap: 8px; flex-wrap: wrap;">
                            @csrf
                            <input type="text" name="note" class="form-control" placeholder="أضف ملاحظة" style="width: 200px; border-radius: 50px; border: 2px solid #e8edf5; padding: 5px 15px; font-size: 0.85rem;">
                            <button type="submit" class="table-action-btn btn-primary-sm" style="padding: 5px 18px;">
                                <i class="fas fa-plus"></i> إضافة
                            </button>
                        </form>
                    </div>
                @empty
                    <div style="text-align: center; padding: 20px; color: #adb5bd;">
                        <i class="fas fa-info-circle"></i> لا توجد ملاحظات
                    </div>
                @endforelse
            </div>
            @endif

            <!-- ==========================================
            MARKS (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">6</span>
                <i class="fas fa-star"></i>
                العلامات والمواد المقدمة
            </div>

            <div class="table-responsive">
                <table class="table-modern">
                    <thead>
                        <tr>
                            <th class="warning-header" colspan="3">علامات الطالب</th>
                        </tr>
                        <tr>
                            <th>المادة</th>
                            <th>العلامة</th>
                            <th>تاريخ التقديم</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students->sessions as $session)
                            <tr>
                                <td>{{ $session->pivot->meter ?? '—' }}</td>
                                <td>
                                    <span class="status-badge {{ ($session->pivot->mark ?? 0) >= 50 ? 'success' : 'danger' }}">
                                        {{ $session->pivot->mark ?? '—' }}
                                    </span>
                                </td>
                                <td>{{ $session->pivot->created_at ? $session->pivot->created_at->format('Y-m-d') : '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; padding: 30px; color: #adb5bd;">
                                    <i class="fas fa-info-circle"></i> لا توجد علامات مسجلة
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif

            <!-- ==========================================
            STATISTICS (only in edit mode)
            ========================================== -->
            @if(!isset($isCreating))
            <div class="section-title-modern mt-4">
                <span class="section-number">7</span>
                <i class="fas fa-chart-bar"></i>
                احصائيات الطالب
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 20px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-coins" style="font-size: 2rem; color: #667eea;"></i>
                        <h4 style="margin: 5px 0 0 0; font-weight: 700; color: #667eea;">{{ $students->payments->count() }}</h4>
                        <span style="color: #6c757d; font-size: 0.85rem;">عدد المدفوعات</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 20px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-money-bill" style="font-size: 2rem; color: #11998e;"></i>
                        <h4 style="margin: 5px 0 0 0; font-weight: 700; color: #11998e;">{{ number_format($students->payments->sum('payment_value')) }} ل.س</h4>
                        <span style="color: #6c757d; font-size: 0.85rem;">إجمالي المدفوعات</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div style="background: #f8faff; padding: 20px; border-radius: 12px; border: 1px solid #eef2f7; text-align: center;">
                        <i class="fas fa-star" style="font-size: 2rem; color: #f7971e;"></i>
                        <h4 style="margin: 5px 0 0 0; font-weight: 700; color: #f7971e;">{{ $students->sessions->count() }}</h4>
                        <span style="color: #6c757d; font-size: 0.85rem;">عدد المواد المقدمة</span>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>

<!-- ==========================================
DELETE MODAL (only in edit mode)
========================================== -->
@if(!isset($isCreating))
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
            <div class="modal-header" style="background: linear-gradient(135deg, #eb3349, #f45c43); padding: 20px 30px; border: none;">
                <h5 class="modal-title" id="deleteModalLabel" style="color: #ffffff; font-weight: 700;">
                    <i class="fas fa-exclamation-triangle"></i> تأكيد الحذف
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1);"></button>
            </div>
            <div class="modal-body" style="padding: 30px; text-align: center;">
                <i class="fas fa-user-slash" style="font-size: 3rem; color: #dc3545; margin-bottom: 15px; display: block;"></i>
                <h5 style="font-weight: 600; color: #2d3436;">هل أنت متأكد أنك تريد حذف هذا الطالب؟</h5>
                <p style="color: #6c757d;">لا يمكن التراجع عن هذا الإجراء. سيتم حذف جميع بيانات الطالب.</p>
            </div>
            <div class="modal-footer" style="padding: 20px 30px; border-top: 1px solid #eef2f7; gap: 10px;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 50px; padding: 8px 30px; font-weight: 600;">إلغاء</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background: linear-gradient(135deg, #eb3349, #f45c43); color: #ffffff; border: none; border-radius: 50px; padding: 8px 30px; font-weight: 600;">
                        <i class="fas fa-trash-alt"></i> حذف
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // ==========================================
    // DELETE MODAL (only if element exists)
    // ==========================================
    var deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var studentId = button.getAttribute('data-id');
            var form = deleteModal.querySelector('#deleteForm');
            form.action = "{{ route('student.destroy', ':id') }}".replace(':id', studentId);
        });
    }

    // ==========================================
    // CONFIRM DELETE FROM COURSE
    // ==========================================
    function confirmDelete(studentId, courseId) {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حذف الطالب من هذه الدورة!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                let form = document.getElementById('deleteCourseForm');
                if (!form) {
                    form = document.createElement('form');
                    form.id = 'deleteCourseForm';
                    form.method = 'POST';
                    form.style.display = 'none';
                    document.body.appendChild(form);
                }
                form.action = `{{ url('/delete-student-course') }}/${studentId}/${courseId}`;
                form.submit();
            }
        });
    }

    // ==========================================
    // LOAD COURSES BY NUMBER
    // ==========================================
    var courseNumberInput = document.getElementById("course_number");
    if (courseNumberInput) {
        courseNumberInput.addEventListener("input", function() {
            let courseNumber = this.value;
            if (courseNumber) {
                fetch(`/get-courses/${courseNumber}`)
                    .then(response => response.json())
                    .then(data => {
                        let select = document.getElementById("subject_selector");
                        select.innerHTML = "";
                        if (data.courses && data.courses.length > 0) {
                            data.courses.forEach(course => {
                                let option = document.createElement("option");
                                option.value = course.id;
                                option.textContent = course.subject_name;
                                select.appendChild(option);
                            });
                        } else {
                            let option = document.createElement("option");
                            option.value = "";
                            option.textContent = "لا توجد مواد لهذه الدورة";
                            select.appendChild(option);
                        }
                    })
                    .catch(error => console.error("Error fetching courses:", error));
            }
        });
    }

    // ==========================================
    // ADD STUDENT TO COURSE
    // ==========================================
    var addToCourseBtn = document.getElementById("add_student_to_course");
    if (addToCourseBtn) {
        addToCourseBtn.addEventListener("click", function() {
            let selectedCourseId = document.getElementById("subject_selector").value;
            let studentId = "{{ $students->id }}";

            if (selectedCourseId) {
                fetch(`/addtocourse/${studentId}`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    },
                    body: JSON.stringify({
                        course_id: selectedCourseId,
                        id: studentId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        document.getElementById("status_message").innerText = data.error;
                        document.getElementById("status_message").style.color = "#dc3545";
                        return;
                    }

                    document.getElementById("status_message").innerText = "✅ تم تسجيل الطالب بنجاح!";
                    document.getElementById("status_message").style.color = "#28a745";

                    let newRow = `<tr>
                        <td><span style="font-weight: 700; color: #667eea;">${data.course.coursenumber}</span></td>
                        <td>${data.course.subject_name}</td>
                        <td>${data.course.start_date}</td>
                        <td>${data.course.end_date}</td>
                        <td>${data.course.start_hour}</td>
                        <td>${data.course.end_hour}</td>
                        <td><strong>${data.course.price} ل.س</strong></td>
                        <td>—</td>
                        <td>
                            <form action="/update-course-year-serial/${studentId}/${data.course.id}" method="POST" style="display: inline-flex; gap: 5px; align-items: center;">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" name="year_number" class="form-control" placeholder="رقم العام" style="width: 80px; height: 32px; font-size: 0.8rem; text-align: center;">
                                <button type="submit" class="table-action-btn btn-primary-sm" style="padding: 2px 10px;">حفظ</button>
                            </form>
                        </td>
                        <td><span class="status-badge warning">${data.course.price} ل.س</span></td>
                        <td>
                            <button class="table-action-btn btn-danger-sm" onclick="confirmDelete(${studentId}, ${data.course.id})">
                                <i class="fas fa-trash-alt"></i> حذف
                            </button>
                            <button class="table-action-btn btn-primary-sm" onclick="showTransferModal(${studentId}, ${data.course.id}, '${data.course.coursenumber}', '${data.course.subject_name}')">
                                <i class="fas fa-exchange-alt"></i> نقل
                            </button>
                        </td>
                    </tr>`;

                    document.getElementById("enrolled_courses").innerHTML += newRow;
                    location.reload();
                })
                .catch(error => console.error("Error:", error));
            }
        });
    }

    // ==========================================
    // TRANSFER MODAL
    // ==========================================
    function showTransferModal(studentId, currentCourseId, currentCourseNumber, currentCourseName) {
        let existingModal = document.getElementById("transferModal");
        if (existingModal) {
            existingModal.remove();
        }

        let modalHTML = `
            <div class="modal fade" id="transferModal" tabindex="-1" role="dialog" aria-labelledby="transferModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content" style="border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 60px rgba(0,0,0,0.15);">
                        <div class="modal-header" style="background: linear-gradient(135deg, #667eea, #764ba2); padding: 20px 30px; border: none;">
                            <h5 class="modal-title" style="color: #ffffff; font-weight: 700;">
                                <i class="fas fa-exchange-alt"></i> نقل الطالب إلى دورة جديدة
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق" style="filter: brightness(0) invert(1);"></button>
                        </div>
                        <div class="modal-body" style="padding: 30px;">
                            <div class="form-group-modern">
                                <label for="new_course_number">رقم الدورة الجديدة</label>
                                <input type="text" id="new_course_number" class="form-control" placeholder="أدخل رقم الدورة الجديدة">
                            </div>
                            <div class="form-group-modern">
                                <label for="new_course_name">اسم المادة الجديدة</label>
                                <input type="text" id="new_course_name" class="form-control" placeholder="أدخل اسم المادة الجديدة">
                            </div>
                        </div>
                        <div class="modal-footer" style="padding: 20px 30px; border-top: 1px solid #eef2f7; gap: 10px;">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 50px; padding: 8px 30px; font-weight: 600;">إلغاء</button>
                            <button type="button" class="btn" onclick="transferStudent(${studentId}, ${currentCourseId})" style="background: linear-gradient(135deg, #667eea, #764ba2); color: #ffffff; border: none; border-radius: 50px; padding: 8px 30px; font-weight: 600;">
                                <i class="fas fa-exchange-alt"></i> نقل
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHTML);
        let modalElement = new bootstrap.Modal(document.getElementById('transferModal'));
        modalElement.show();
    }

    function transferStudent(studentId, currentCourseId) {
        let newCourseNumber = document.getElementById("new_course_number").value;
        let newCourseName = document.getElementById("new_course_name").value;

        fetch(`/transfer-student/${studentId}`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
            },
            body: JSON.stringify({
                current_course_id: currentCourseId,
                new_course_number: newCourseNumber,
                new_course_name: newCourseName
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert("✅ تم نقل الطالب بنجاح!");
                location.reload();
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // ==========================================
    // PAYMENT HANDLING (safe with null checks)
    // ==========================================
    var addPaymentBtn = document.getElementById('addPaymentButton');
    if (addPaymentBtn) {
        addPaymentBtn.addEventListener('click', function() {
            let form = document.getElementById('addPaymentForm');
            if (form) {
                if (form.style.display === 'none' || form.style.display === '') {
                    form.style.display = 'block';
                    this.innerHTML = '<i class="fas fa-times"></i> إلغاء الإضافة';
                    this.className = 'table-action-btn btn-danger-sm';
                } else {
                    form.style.display = 'none';
                    this.innerHTML = '<i class="fas fa-plus-circle"></i> إضافة دفعة جديدة';
                    this.className = 'table-action-btn btn-success-sm';
                }
            }
        });
        // ==========================================
// TOGGLE COURSE SELECTOR BASED ON CATEGORY
// ==========================================
var categorySelect = document.getElementById('paymentCategory');
var courseWrapper = document.getElementById('courseSelectWrapper');
var courseSelect = document.getElementById('paymentCourse');
var courseRequired = document.getElementById('courseRequired');

if (categorySelect) {
    categorySelect.addEventListener('change', function() {
        if (this.value === 'course') {
            courseWrapper.style.display = 'block';
            courseSelect.setAttribute('required', 'required');
            courseRequired.style.display = 'inline';
            // Show remaining info (if already filled)
            var infoDiv = document.getElementById('paymentCourseInfo');
            if (courseSelect.value) {
                infoDiv.style.display = 'block';
                // Optionally trigger change to refresh balance
                courseSelect.dispatchEvent(new Event('change'));
            }
        } else {
            courseWrapper.style.display = 'none';
            courseSelect.removeAttribute('required');
            courseRequired.style.display = 'none';
            courseSelect.value = ''; // clear selection
            document.getElementById('paymentCourseInfo').style.display = 'none';
        }
    });
}

        // Cancel payment
        var cancelBtn = document.getElementById('cancelAddPayment');
        if (cancelBtn) {
            cancelBtn.addEventListener('click', function() {
                var form = document.getElementById('addPaymentForm');
                if (form) form.style.display = 'none';
                var btn = document.getElementById('addPaymentButton');
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-plus-circle"></i> إضافة دفعة جديدة';
                    btn.className = 'table-action-btn btn-success-sm';
                }
            });
        }

        // Show course info when course selected
        var paymentCourse = document.getElementById('paymentCourse');
       if (paymentCourse) {
    paymentCourse.addEventListener('change', function() {
        var category = document.getElementById('paymentCategory').value;
        if (category !== 'course') {
            document.getElementById('paymentCourseInfo').style.display = 'none';
            return;
        }

                infoDiv.style.display = 'block';
                infoText.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري تحميل البيانات...';

                fetch(`/get-remaining-balance/${studentId}/${courseId}`, {
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        let remaining = data.remaining;
                        let totalPaid = data.total_paid;
                        let isFullyPaid = data.is_fully_paid;

                        let html = `
                            <strong>${courseName}</strong> |
                            سعر الدورة: <strong>${Number(coursePrice).toLocaleString()}</strong> ل.س |
                            المدفوع: <strong>${Number(totalPaid).toLocaleString()}</strong> ل.س |
                            المتبقي: <strong style="color: ${remaining > 0 ? '#f7971e' : '#28a745'};">${Number(remaining).toLocaleString()}</strong> ل.س
                        `;
                        if (isFullyPaid) {
                            html += ' ✅ <span style="color: #28a745; font-weight: bold;">(مسدد بالكامل)</span>';
                        } else if (remaining > 0) {
                            html += ' ⚠️ <span style="color: #f7971e; font-weight: bold;">(متبقي)</span>';
                        }
                        infoText.innerHTML = html;
                    } else {
                        infoText.innerHTML = '<span style="color: #dc3545;">❌ ' + (data.message || 'حدث خطأ') + '</span>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching remaining balance:', error);
                    infoText.innerHTML = '<span style="color: #dc3545;">❌ حدث خطأ في تحميل البيانات</span>';
                });
            });
        }

        // Submit payment
        var paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();

                var studentId = {{ $students->id ?? 0 }};
                var courseId = document.getElementById('paymentCourse')?.value;
                var paymentValue = document.getElementById('paymentValue')?.value;
                var paymentType = document.getElementById('paymentType')?.value;

                // if (!courseId) {
                //     Swal.fire({ icon: 'warning', title: 'تنبيه', text: 'يرجى اختيار دورة', confirmButtonColor: '#667eea' });
                //     return;
                // }
                var category = document.getElementById('paymentCategory').value;

if (category === 'course') {
    if (!courseId) {
        Swal.fire({ icon: 'warning', title: 'تنبيه', text: 'يرجى اختيار دورة', confirmButtonColor: '#667eea' });
        return;
    }
} else {
    // For non-course payments, set course_id to null
    courseId = null;
}

               var paymentValueNum = parseFloat(paymentValue) || 0;
var discountNum     = parseFloat(document.getElementById('discount').value) || 0;

if (paymentValueNum <= 0 && discountNum <= 0) {
    Swal.fire({
        icon: 'warning',
        title: 'تنبيه',
        text: 'يجب إدخال قيمة دفعة أو حسم واحد على الأقل',
        confirmButtonColor: '#667eea'
    });
    return;
}

if (discountNum < 0) {
    Swal.fire({
        icon: 'warning',
        title: 'تنبيه',
        text: 'الحسم لا يمكن أن يكون سالباً',
        confirmButtonColor: '#667eea'
    });
    return;
}
var departmentId = @json(auth()->user()->department_id ?? null);
                var submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإضافة...';
var category = document.getElementById('paymentCategory').value;
var courseId = (category === 'course') ? document.getElementById('paymentCourse').value : null;
var receiptNumber = document.getElementById('receipt_number').value.trim();
var collectedAt   = document.getElementById('collected_at').value;

if (!receiptNumber) {
    Swal.fire({ icon:'warning', title:'تنبيه', text:'يرجى إدخال رقم الوصل' });
    return;
}
if (!collectedAt) {
    Swal.fire({ icon:'warning', title:'تنبيه', text:'يرجى إدخال تاريخ التحصيل' });
    return;
}
                fetch('{{ route("payment.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                           student_id:      studentId,
    course_id:       (document.getElementById('paymentCategory').value === 'course')
                        ? document.getElementById('paymentCourse').value
                        : null,
    receipt_number:  document.getElementById('receipt_number').value.trim(),
    collected_at:    document.getElementById('collected_at').value,
    payment_value:   parseFloat(paymentValue),
    payment_type:    paymentType,
    payment_category: document.getElementById('paymentCategory').value,
    department_id:   departmentId,
        discount:         discountNum,
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تمت الإضافة بنجاح! ✅',
                            timer: 1500,
                            showConfirmButton: false
                        });
                        var formDiv = document.getElementById('addPaymentForm');
                        if (formDiv) formDiv.style.display = 'none';
                        var btn = document.getElementById('addPaymentButton');
                        if (btn) {
                            btn.innerHTML = '<i class="fas fa-plus-circle"></i> إضافة دفعة جديدة';
                            btn.className = 'table-action-btn btn-success-sm';
                        }
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        throw new Error(data.message || 'فشل إضافة الدفعة');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({ icon: 'error', title: 'حدث خطأ ❌', text: error.message || 'حدث خطأ في الاتصال بالخادم', confirmButtonColor: '#eb3349' });
                })
                .finally(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-save"></i> إضافة';
                });
            });
        }
    }

    // ==========================================
    // DELETE PAYMENT
    // ==========================================
    function deletePayment(paymentId, studentId) {
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "سيتم حذف هذه الدفعة نهائياً!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                let token = document.querySelector('meta[name="csrf-token"]').content;

                fetch(`/payment/delete/${paymentId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'تم الحذف بنجاح',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        let row = document.getElementById(`payment-row-${paymentId}`);
                        if (row) {
                            row.remove();
                        }

                        setTimeout(() => location.reload(), 1500);
                    } else {
                        throw new Error(data.message || 'فشل حذف الدفعة');
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'حدث خطأ',
                        text: error.message
                    });
                });
            }
        });
    }

    // ==========================================
    // AUTO-CLOSE ALERTS
    // ==========================================
    setTimeout(function() {
        document.querySelectorAll('.alert-modern').forEach(function(alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        });
    }, 5000);
</script>
@endsection
@endsection
