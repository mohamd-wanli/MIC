@extends('layouts.master')

@section('title', 'إضافة طالب جديد')

@section('css')
<style>
    /* FORCE OVERRIDE - USING !IMPORTANT */

    /* Main Card */
    .card {
        border: none !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08) !important;
        overflow: hidden !important;
        background: #ffffff !important;
    }

    .card .card-body {
        padding: 0 !important;
        background: #f8faff !important;
    }

    /* Custom Header */
    .form-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        padding: 25px 30px !important;
        border-bottom: none !important;
        position: relative !important;
        overflow: hidden !important;
    }

    .form-header-modern h4 {
        color: #ffffff !important;
        font-weight: 700 !important;
        font-size: 1.4rem !important;
        margin: 0 !important;
    }

    .form-header-modern p {
        color: rgba(255, 255, 255, 0.85) !important;
        margin: 5px 0 0 0 !important;
        font-size: 0.9rem !important;
    }

    .form-header-modern .header-badge {
        background: rgba(255, 255, 255, 0.2) !important;
        padding: 6px 18px !important;
        border-radius: 50px !important;
        color: #ffffff !important;
        font-size: 0.85rem !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        display: inline-block !important;
    }

    /* Form Body */
    .form-body-modern {
        padding: 30px !important;
    }

    /* Section Titles */
    .section-title-modern {
        font-size: 1rem !important;
        font-weight: 700 !important;
        color: #2d3436 !important;
        margin-bottom: 20px !important;
        padding-bottom: 10px !important;
        border-bottom: 2px solid #eef2f7 !important;
        display: flex !important;
        align-items: center !important;
        gap: 10px !important;
    }

    .section-title-modern .section-number {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 28px !important;
        height: 28px !important;
        border-radius: 50% !important;
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
        color: #ffffff !important;
        font-size: 0.75rem !important;
        font-weight: 700 !important;
        flex-shrink: 0 !important;
    }

    .section-title-modern i {
        color: #667eea !important;
    }

    /* Form Groups */
    .form-group-modern {
        margin-bottom: 18px !important;
    }

    .form-group-modern label {
        font-weight: 600 !important;
        color: #2d3436 !important;
        font-size: 0.85rem !important;
        margin-bottom: 6px !important;
        display: block !important;
    }

    .form-group-modern label .required {
        color: #dc3545 !important;
        margin-right: 3px !important;
    }

    .form-group-modern .form-control {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 10px 15px !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
        height: 45px !important;
        box-shadow: none !important;
    }

    .form-group-modern .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        outline: none !important;
    }

    .form-group-modern .form-control::placeholder {
        color: #adb5bd !important;
        font-size: 0.85rem !important;
    }

    .form-group-modern .text-danger {
        font-size: 0.8rem !important;
        margin-top: 4px !important;
        display: block !important;
    }

    /* Select dropdown */
    .form-group-modern select.form-control {
        appearance: auto !important;
        -webkit-appearance: auto !important;
    }

    /* Submit Button */
    .btn-submit-modern {
        background: linear-gradient(135deg, #667eea, #764ba2) !important;
        color: #ffffff !important;
        border: none !important;
        padding: 12px 50px !important;
        border-radius: 50px !important;
        font-weight: 700 !important;
        font-size: 1rem !important;
        transition: all 0.3s ease !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 10px !important;
        cursor: pointer !important;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35) !important;
    }

    .btn-submit-modern:hover {
        transform: translateY(-3px) !important;
        box-shadow: 0 8px 30px rgba(102, 126, 234, 0.45) !important;
        color: #ffffff !important;
    }

    .btn-submit-modern:active {
        transform: translateY(0) !important;
    }

    /* Back Button */
    .btn-back-modern {
        border-radius: 50px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border: 2px solid #e8edf5 !important;
        background: #ffffff !important;
        color: #2d3436 !important;
        transition: all 0.3s ease !important;
    }

    .btn-back-modern:hover {
        background: #f8faff !important;
        border-color: #667eea !important;
        color: #667eea !important;
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

    .alert-modern .close {
        background: none !important;
        border: none !important;
        font-size: 1.5rem !important;
        line-height: 1 !important;
        color: inherit !important;
        opacity: 0.5 !important;
        padding: 0 5px !important;
        cursor: pointer !important;
        transition: opacity 0.3s ease !important;
        position: absolute !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        left: 10px !important;
    }

    .alert-modern .close:hover {
        opacity: 1 !important;
    }

    /* Row spacing */
    .row-modern {
        margin-bottom: 10px !important;
    }

    /* Responsive */
    @media (max-width: 767px) {
        .form-body-modern {
            padding: 15px !important;
        }
        .form-header-modern {
            padding: 18px 20px !important;
        }
        .form-header-modern h4 {
            font-size: 1.1rem !important;
        }
        .form-group-modern .form-control {
            height: 40px !important;
            padding: 8px 12px !important;
            font-size: 0.85rem !important;
        }
        .btn-submit-modern {
            padding: 10px 30px !important;
            font-size: 0.9rem !important;
            width: 100% !important;
            justify-content: center !important;
        }
        .btn-back-modern {
            width: 100% !important;
            justify-content: center !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    @if (session()->has('Add'))
        <div class="alert-modern alert-success alert-dismissible fade show position-relative" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>{{ session()->get('Add') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert-modern alert-danger alert-dismissible fade show position-relative" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul class="mb-0 mt-1" style="list-style: none; padding-right: 0;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size: 0.85rem;">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Main Form Card -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <!-- Custom Header -->
                <div class="form-header-modern">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4>
                                <i class="fas fa-user-plus"></i>
                                إضافة طالب جديد
                            </h4>
                            <p><i class="fas fa-info-circle"></i> يرجى ملء جميع البيانات المطلوبة لإضافة طالب جديد</p>
                        </div>
                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                            <span class="header-badge">
                                <i class="fas fa-asterisk text-warning"></i> حقول مطلوبة
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Form Body -->
                <div class="card-body form-body-modern">
                    <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <!-- Section 1: Personal Information -->
                        <div class="section-title-modern">
                            <span class="section-number">1</span>
                            <i class="fas fa-user"></i>
                            المعلومات الشخصية
                        </div>

                        <div class="row row-modern">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="firstname">
                                        الاسم الأول
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                           placeholder="أدخل الاسم الأول" value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="fathername">
                                        اسم الأب
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="fathername" name="fathername"
                                           placeholder="أدخل اسم الأب" value="{{ old('fathername') }}">
                                    @error('fathername')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="lastname">
                                        الكنية
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                           placeholder="أدخل الكنية" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="fullname">
                                        الاسم الكامل
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="fullname" name="fullname"
                                           placeholder="أدخل الاسم الكامل" value="{{ old('fullname') }}">
                                    @error('fullname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Additional Information -->
                        <div class="section-title-modern mt-4">
                            <span class="section-number">2</span>
                            <i class="fas fa-id-card"></i>
                            معلومات إضافية
                        </div>

                        <div class="row row-modern">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="national_number">
                                        الرقم الوطني
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="national_number" name="national_number"
                                           placeholder="أدخل الرقم الوطني" value="{{ old('national_number') }}">
                                    @error('national_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="engish_firstname">
                                        الاسم الأول (إنجليزي)
                                    </label>
                                    <input type="text" class="form-control" id="engish_firstname" name="engish_firstname"
                                           placeholder="First Name" value="{{ old('engish_firstname') }}">
                                    @error('engish_firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="english_lastname">
                                        الكنية (إنجليزي)
                                    </label>
                                    <input type="text" class="form-control" id="english_lastname" name="english_lastname"
                                           placeholder="Last Name" value="{{ old('english_lastname') }}">
                                    @error('english_lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="grandfathername">
                                        اسم الجد
                                    </label>
                                    <input type="text" class="form-control" id="grandfathername" name="grandfathername"
                                           placeholder="أدخل اسم الجد" value="{{ old('grandfathername') }}">
                                    @error('grandfathername')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 3: Contact & Personal Details -->
                        <div class="section-title-modern mt-4">
                            <span class="section-number">3</span>
                            <i class="fas fa-phone"></i>
                            بيانات التواصل
                        </div>

                        <div class="row row-modern">
                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="gender">
                                        الجنس
                                        <span class="required">*</span>
                                    </label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">اختر الجنس</option>
                                        <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                        <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="date_of_birth">
                                        تاريخ الولادة
                                        <span class="required">*</span>
                                    </label>
                                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                           value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="email">
                                        البريد الإلكتروني
                                    </label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="example@email.com" value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="telephone">
                                        رقم الهاتف
                                    </label>
                                    <input type="text" class="form-control" id="telephone" name="telephone"
                                           placeholder="أدخل رقم الهاتف" value="{{ old('telephone') }}">
                                    @error('telephone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section 4: Address & Nationality -->
                        <div class="section-title-modern mt-4">
                            <span class="section-number">4</span>
                            <i class="fas fa-map-marker-alt"></i>
                            العنوان والجنسية
                        </div>

                        <div class="row row-modern">
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="mobile">
                                        رقم الجوال
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                           placeholder="أدخل رقم الجوال" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="address">
                                        العنوان
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           placeholder="أدخل العنوان" value="{{ old('address') }}">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="form-group-modern">
                                    <label for="nationality">
                                        الجنسية
                                        <span class="required">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="nationality" name="nationality"
                                           placeholder="أدخل الجنسية" value="{{ old('nationality') }}">
                                    @error('nationality')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="d-flex justify-content-center gap-3 flex-wrap">
                                    <button type="submit" class="btn-submit-modern">
                                        <i class="fas fa-save"></i>
                                        حفظ البيانات
                                    </button>
                                    <a href="{{ route('student.index') }}" class="btn-back-modern">
                                        <i class="fas fa-arrow-right"></i>
                                        العودة للقائمة
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // Auto-generate full name from first, father, and last names
        $('#firstname, #fathername, #lastname').on('keyup', function() {
            var firstname = $('#firstname').val().trim();
            var fathername = $('#fathername').val().trim();
            var lastname = $('#lastname').val().trim();

            if (firstname || fathername || lastname) {
                var fullName = firstname + ' ' + fathername + ' ' + lastname;
                $('#fullname').val(fullName.trim());
            }
        });

        // Auto-close alerts after 5 seconds
        setTimeout(function() {
            $('.alert-modern').fadeOut('slow');
        }, 5000);
    });
</script>
@endsection
