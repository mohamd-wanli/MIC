<?php $__env->startSection('title', 'تعديل الدورة'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ============================================
       MODERN COURSE FORM STYLES
       ============================================ */

    .form-card-modern {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        background: #ffffff;
        margin: 0 auto;
        max-width: 900px;
    }

    .form-card-modern .card-header-modern {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 25px 30px;
        border-bottom: none;
        position: relative;
        overflow: hidden;
    }

    .form-card-modern .card-header-modern::before {
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

    .form-card-modern .card-header-modern::after {
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

    .form-card-modern .card-header-modern h4 {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.4rem;
        margin: 0;
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-card-modern .card-header-modern p {
        color: rgba(255, 255, 255, 0.85);
        margin: 5px 0 0 0;
        font-size: 0.9rem;
        position: relative;
        z-index: 1;
    }

    .form-card-modern .card-header-modern .header-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 6px 18px;
        border-radius: 50px;
        color: #ffffff;
        font-size: 0.85rem;
        border: 1px solid rgba(255, 255, 255, 0.15);
        display: inline-block;
        position: relative;
        z-index: 1;
    }

    .form-card-modern .card-body-modern {
        padding: 30px;
        background: #f8faff;
    }

    /* Form Sections */
    .form-section-title {
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

    .form-section-title .section-number {
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

    .form-section-title i {
        color: #667eea;
    }

    /* Form Groups */
    .form-group-modern {
        margin-bottom: 20px;
    }

    .form-group-modern label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.85rem;
        margin-bottom: 6px;
        display: block;
    }

    .form-group-modern label .required {
        color: #dc3545;
        margin-right: 3px;
    }

    .form-group-modern .form-control,
    .form-group-modern .form-select {
        border-radius: 10px !important;
        border: 2px solid #e8edf5 !important;
        padding: 10px 15px !important;
        font-size: 0.9rem !important;
        transition: all 0.3s ease !important;
        background: #ffffff !important;
        height: 45px !important;
        box-shadow: none !important;
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

    .form-group-modern .form-control[readonly] {
        background: #f8faff !important;
        color: #6c757d;
    }

    .form-group-modern .invalid-feedback {
        font-size: 0.8rem;
        margin-top: 4px;
    }

    /* Two Column Layout */
    .form-row-modern {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Checkbox Group */
    .checkbox-group-modern {
        background: #ffffff;
        padding: 15px 20px;
        border-radius: 10px;
        border: 2px solid #e8edf5;
        transition: all 0.3s ease;
    }

    .checkbox-group-modern:hover {
        border-color: #667eea;
    }

    .checkbox-group-modern .form-check {
        display: inline-block;
        margin: 5px 10px;
    }

    .checkbox-group-modern .form-check-input {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
        border-radius: 4px;
        transition: all 0.2s ease;
        margin-left: 8px;
        margin-top: 2px;
    }

    .checkbox-group-modern .form-check-input:hover {
        transform: scale(1.1);
    }

    .checkbox-group-modern .form-check-label {
        font-size: 0.9rem;
        color: #2d3436;
        cursor: pointer;
        font-weight: 500;
    }

    .checkbox-group-modern .form-check-input:checked+.form-check-label {
        color: #667eea;
    }

    /* Current Days Display */
    .current-days-modern {
        background: #f8faff;
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #eef2f7;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .current-days-modern .label {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.85rem;
    }

    .current-days-modern .days-list {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .current-days-modern .day-tag {
        background: linear-gradient(135deg, rgba(102, 126, 234, 0.15), rgba(118, 75, 162, 0.15));
        color: #667eea;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* Readonly Info */
    .info-readonly-modern {
        padding: 10px 15px;
        background: #f8faff;
        border-radius: 10px;
        border: 2px solid #eef2f7;
        font-weight: 600;
        color: #2d3436;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-readonly-modern i {
        color: #667eea;
    }

    /* Submit Buttons */
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

    .btn-submit-modern:active {
        transform: translateY(0);
    }

    .btn-submit-modern:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    .btn-back-modern {
        border-radius: 50px !important;
        padding: 12px 30px !important;
        font-weight: 600 !important;
        border: 2px solid #e8edf5 !important;
        background: #ffffff !important;
        color: #2d3436 !important;
        transition: all 0.3s ease !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 8px !important;
    }

    .btn-back-modern:hover {
        background: #f8faff !important;
        border-color: #667eea !important;
        color: #667eea !important;
        text-decoration: none !important;
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
        max-width: 900px;
        margin-left: auto;
        margin-right: auto;
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

    /* Day Short (Mobile) */
    .day-short {
        display: none;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .form-card-modern .card-body-modern {
            padding: 20px;
        }
        .form-row-modern {
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
    }

    @media (max-width: 767px) {
        .form-card-modern {
            margin: 0 10px;
        }
        .form-card-modern .card-header-modern {
            padding: 18px 20px;
        }
        .form-card-modern .card-header-modern h4 {
            font-size: 1.1rem;
        }
        .form-card-modern .card-body-modern {
            padding: 15px;
        }
        .form-row-modern {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .form-group-modern .form-control,
        .form-group-modern .form-select {
            height: 40px !important;
            padding: 8px 12px !important;
            font-size: 0.85rem !important;
        }
        .checkbox-group-modern {
            padding: 12px 15px;
        }
        .checkbox-group-modern .form-check {
            margin: 3px 6px;
        }
        .day-full {
            display: none;
        }
        .day-short {
            display: inline;
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
        }
        .form-section-title {
            font-size: 0.9rem;
        }
        .form-section-title .section-number {
            width: 24px;
            height: 24px;
            font-size: 0.65rem;
        }
        .alert-modern {
            margin: 0 10px 20px 10px;
        }
        .current-days-modern {
            flex-direction: column;
            align-items: flex-start;
        }
    }

    @media (max-width: 480px) {
        .form-card-modern .card-header-modern h4 {
            font-size: 1rem;
        }
        .form-card-modern .card-header-modern p {
            font-size: 0.8rem;
        }
        .checkbox-group-modern .form-check {
            margin: 2px 4px;
        }
        .checkbox-group-modern .form-check-input {
            width: 16px;
            height: 16px;
        }
        .checkbox-group-modern .form-check-label {
            font-size: 0.8rem;
        }
        .form-group-modern label {
            font-size: 0.8rem;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <!-- Alert Messages -->
    <?php if(session('success')): ?>
        <div class="alert-modern alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong><?php echo e(session('success')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('delete')): ?>
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-trash-alt"></i>
            <strong><?php echo e(session('delete')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong><?php echo e(session('error')); ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert-modern alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <strong>يرجى تصحيح الأخطاء التالية:</strong>
                <ul class="mb-0 mt-1" style="list-style: none; padding-right: 0;">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li style="font-size: 0.85rem;">• <?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Main Form Card -->
    <div class="form-card-modern">

        <!-- Card Header -->
        <div class="card-header-modern">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h4>
                        <i class="fas fa-edit"></i>
                        تعديل الدورة
                    </h4>
                    <p><i class="fas fa-info-circle"></i> قم بتعديل بيانات الدورة ثم اضغط على زر التحديث</p>
                </div>
                <div class="col-md-4 text-md-end mt-2 mt-md-0">
                    <span class="header-badge">
                        <i class="fas fa-asterisk text-warning"></i> حقول مطلوبة
                    </span>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="card-body-modern">
            <form method="post" action="<?php echo e(route('updatecourse', $course->id)); ?>" id="editCourseForm" class="needs-validation" novalidate>
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <input type="hidden" id="existingDays" value="<?php echo e($course->days_of_course); ?>">

                <!-- Section 1: Course Dates & Times -->
                <div class="form-section-title">
                    <span class="section-number">1</span>
                    <i class="fas fa-calendar-alt"></i>
                    التواريخ والأوقات
                </div>

                <div class="form-row-modern">
                    <div class="form-group-modern">
                        <label for="startdate">
                            تاريخ البداية
                            <span class="required">*</span>
                        </label>
                        <input type="date" id="startdate" name="startdate" class="form-control" value="<?php echo e($course->start_date); ?>" required>
                        <div class="invalid-feedback">
                            الرجاء إدخال تاريخ البداية
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label for="enddate">
                            تاريخ النهاية
                            <span class="required">*</span>
                        </label>
                        <input type="date" id="enddate" name="enddate" class="form-control" value="<?php echo e($course->end_date); ?>" required>
                        <div id="dateMessage" style="font-size: 0.8rem; margin-top: 4px;"></div>
                        <div class="invalid-feedback">
                            الرجاء إدخال تاريخ النهاية
                        </div>
                    </div>
                </div>

                <div class="form-row-modern">
                    <div class="form-group-modern">
                        <label for="starthour">
                            ساعة البداية
                            <span class="required">*</span>
                        </label>
                        <input type="time" id="starthour" name="starthour" class="form-control" value="<?php echo e($course->start_hour); ?>" required>
                        <div class="invalid-feedback">
                            الرجاء إدخال وقت البداية
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label for="endhour">
                            ساعة النهاية
                            <span class="required">*</span>
                        </label>
                        <input type="time" id="endhour" name="endhour" class="form-control" value="<?php echo e($course->end_hour); ?>" required>
                        <div class="invalid-feedback">
                            الرجاء إدخال وقت النهاية
                        </div>
                    </div>
                </div>

                <!-- Section 2: Course Details -->
                <div class="form-section-title mt-4">
                    <span class="section-number">2</span>
                    <i class="fas fa-info-circle"></i>
                    تفاصيل الدورة
                </div>

                <div class="form-row-modern">
                    <div class="form-group-modern">
                        <label for="price">
                            سعر الدورة
                            <span class="required">*</span>
                        </label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="أدخل سعر الدورة" value="<?php echo e($course->price); ?>" required>
                        <div class="invalid-feedback">
                            الرجاء إدخال السعر
                        </div>
                    </div>

                    <div class="form-group-modern">
                        <label for="numsession">
                            عدد الجلسات
                            <span class="required">*</span>
                        </label>
                        <input type="number" id="numsession" name="numsession" class="form-control" placeholder="أدخل عدد الجلسات" value="<?php echo e($course->num_of_session); ?>" required>
                        <div class="invalid-feedback">
                            الرجاء إدخال عدد الجلسات
                        </div>
                    </div>
                </div>

                <div class="form-row-modern">
                    <div class="form-group-modern">
                        <label for="coursenumber">
                            رقم الدورة
                        </label>
                        <input type="number" id="coursenumber" name="coursenumber" class="form-control" placeholder="أدخل رقم الدورة (اختياري)" value="<?php echo e($course->coursenumber); ?>">
                        <div class="invalid-feedback">
                            الرجاء إدخال رقم الدورة
                        </div>
                    </div>
                </div>

                <!-- Section 3: Course Days -->
                <div class="form-section-title mt-4">
                    <span class="section-number">3</span>
                    <i class="fas fa-calendar-week"></i>
                    أيام الدورة
                </div>

                <div class="form-group-modern">
                    <!-- Current Days Display -->
                    <div class="current-days-modern">
                        <span class="label">
                            <i class="fas fa-calendar-check" style="color: #667eea;"></i>
                            الأيام الحالية:
                        </span>
                        <span class="days-list">
                            <?php
                                $days = explode(',', $course->days_of_course);
                            ?>
                            <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="day-tag"><?php echo e(trim($day)); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                    </div>

                    <div class="checkbox-group-modern">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="السبت" id="day_sat" required>
                            <label class="form-check-label" for="day_sat">
                                <span class="day-full">السبت</span>
                                <span class="day-short">سبت</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="الأحد" id="day_sun" required>
                            <label class="form-check-label" for="day_sun">
                                <span class="day-full">الأحد</span>
                                <span class="day-short">أحد</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="الإثنين" id="day_mon" required>
                            <label class="form-check-label" for="day_mon">
                                <span class="day-full">الإثنين</span>
                                <span class="day-short">إثن</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="الثلاثاء" id="day_tue" required>
                            <label class="form-check-label" for="day_tue">
                                <span class="day-full">الثلاثاء</span>
                                <span class="day-short">ثلاث</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="الأربعاء" id="day_wed" required>
                            <label class="form-check-label" for="day_wed">
                                <span class="day-full">الأربعاء</span>
                                <span class="day-short">أربع</span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="coursedays[]" value="الخميس" id="day_thu" required>
                            <label class="form-check-label" for="day_thu">
                                <span class="day-full">الخميس</span>
                                <span class="day-short">خميس</span>
                            </label>
                        </div>
                        <div id="daysMessage" style="font-size: 0.8rem; color: #dc3545; margin-top: 8px; display: none;">
                            <i class="fas fa-exclamation-circle"></i> الرجاء اختيار يوم واحد على الأقل
                        </div>
                    </div>
                </div>

                <!-- Section 4: Department & Subject -->
                <div class="form-section-title mt-4">
                    <span class="section-number">4</span>
                    <i class="fas fa-building"></i>
                    القسم والمادة
                </div>

                <div class="form-row-modern">
                    <!-- Department -->
                    <div class="form-group-modern">
                        <?php if(auth()->user()->department_id == null): ?>
                            <label for="department">
                                القسم
                                <span class="required">*</span>
                            </label>
                            <select class="form-control" id="department" name="department_id" required>
                                <option value="">اختر القسم</option>
                                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($department->id); ?>" <?php echo e($department->id == $course->department_id ? 'selected' : ''); ?>>
                                        <?php echo e($department->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        <?php else: ?>
                            <input type="hidden" name="department_id" id="department_id" value="<?php echo e($course->department_id ?? auth()->user()->department_id); ?>">
                            <label>القسم</label>
                            <div class="info-readonly-modern">
                                <i class="fas fa-building"></i>
                                <?php echo e(auth()->user()->department->name ?? 'غير محدد'); ?>

                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Subject -->
                    <div class="form-group-modern">
                        <label for="subjectcourse">
                            المادة
                            <span class="required">*</span>
                        </label>
                        <div class="info-readonly-modern">
                            <i class="fas fa-book"></i>
                            <?php echo e($course->subject_name); ?>

                        </div>
                        <input type="hidden" name="subjectcourse" id="subjectcourse" value="<?php echo e($course->subject_id); ?>">
                    </div>
                </div>

                <!-- Section 5: Teacher -->
                <div class="form-section-title mt-4">
                    <span class="section-number">5</span>
                    <i class="fas fa-chalkboard-teacher"></i>
                    المدرس
                </div>

               <div class="form-group-modern">
    <label for="teacher_id">
        اسم المدرس
    </label>
    <select id="teacher_id" name="teacher_id" class="form-select">
        <option value="">— بدون مدرس —</option>
        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($teacher->id); ?>"
                    <?php echo e((int) old('teacher_id', $course->teacher_id) === $teacher->id ? 'selected' : ''); ?>>
                <?php echo e($teacher->name); ?> <?php echo e($teacher->lastname); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

                <!-- Submit Buttons -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <button type="submit" class="btn-submit-modern" id="submitBtn">
                                <i class="fas fa-save"></i>
                                تحديث الدورة
                            </button>
                            <a href="<?php echo e(route('showcourses', request()->secid ?? '')); ?>" class="btn-back-modern">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('assets/js/jquery-3.7.1.js')); ?>"></script>
<script>
    $(document).ready(function() {

        // ==========================================
        // DATE VALIDATION
        // ==========================================
        let startInput = document.getElementById('startdate');
        let endInput = document.getElementById('enddate');
        let messageDiv = document.getElementById('dateMessage');
        let submitButton = document.getElementById('submitBtn');

        function compareDates() {
            let startValue = startInput.value ? new Date(startInput.value).getTime() : null;
            let endValue = endInput.value ? new Date(endInput.value).getTime() : null;

            if (startValue && endValue) {
                if (endValue < startValue) {
                    messageDiv.innerHTML = '<i class="fas fa-exclamation-circle" style="color: #dc3545;"></i> <span style="color: #dc3545;">تاريخ النهاية يجب أن يكون بعد تاريخ البداية</span>';
                    endInput.classList.add('is-invalid');
                    if (submitButton) submitButton.disabled = true;
                } else {
                    messageDiv.innerHTML = '<i class="fas fa-check-circle" style="color: #28a745;"></i> <span style="color: #28a745;">التواريخ صحيحة</span>';
                    endInput.classList.remove('is-invalid');
                    if (submitButton) submitButton.disabled = false;
                }
            }
        }

        if (startInput && endInput) {
            startInput.addEventListener('change', compareDates);
            endInput.addEventListener('change', compareDates);
            // Run initial validation
            compareDates();
        }

        // ==========================================
        // TIME VALIDATION
        // ==========================================
        $('#starthour, #endhour').on('change', function() {
            var startHour = $('#starthour').val();
            var endHour = $('#endhour').val();

            if (startHour && endHour) {
                if (endHour <= startHour) {
                    $('#endhour').addClass('is-invalid');
                    if (!$('#timeMessage').length) {
                        $('#endhour').after('<div id="timeMessage" style="font-size: 0.8rem; color: #dc3545; margin-top: 4px;"><i class="fas fa-exclamation-circle"></i> ساعة النهاية يجب أن تكون بعد ساعة البداية</div>');
                    }
                } else {
                    $('#endhour').removeClass('is-invalid');
                    $('#timeMessage').remove();
                }
            }
        });

        // ==========================================
        // CHECKBOX VALIDATION - At least one checked
        // ==========================================
        var requiredCheckboxes = $('.checkbox-group-modern :checkbox[required]');

        requiredCheckboxes.on('change', function() {
            var isChecked = requiredCheckboxes.is(':checked');
            if (isChecked) {
                requiredCheckboxes.removeAttr('required');
                $('#daysMessage').hide();
                $('.checkbox-group-modern').css('border-color', '#28a745');
            } else {
                requiredCheckboxes.attr('required', 'required');
                $('.checkbox-group-modern').css('border-color', '#e8edf5');
            }
        });

        // ==========================================
        // PRE-CHECK DAYS BASED ON EXISTING DATA
        // ==========================================
        var existingDays = $('#existingDays').val();
        if (existingDays) {
            var daysArray = existingDays.split(',');
            $('.checkbox-group-modern .form-check-input').each(function() {
                var dayValue = $(this).val();
                if (daysArray.includes(dayValue)) {
                    $(this).prop('checked', true);
                }
            });
            // Remove required if any day is checked
            if ($('.checkbox-group-modern .form-check-input:checked').length > 0) {
                requiredCheckboxes.removeAttr('required');
                $('.checkbox-group-modern').css('border-color', '#28a745');
            }
        }

        // ==========================================
        // FORM SUBMISSION - Prevent Enter key
        // ==========================================
        $('#editCourseForm').on('keydown', function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });

        // ==========================================
        // FORM SUBMISSION - Show loading state
        // ==========================================
        $('#editCourseForm').on('submit', function() {
            var $btn = $('#submitBtn');
            $btn.html('<i class="fas fa-spinner fa-spin"></i> جاري التعديل...').prop('disabled', true);
        });

        // ==========================================
        // AUTO-CLOSE ALERTS
        // ==========================================
        setTimeout(function() {
            $('.alert-modern').fadeOut('slow');
        }, 5000);

        // ==========================================
        // REAL-TIME VALIDATION FEEDBACK
        // ==========================================
        $('.form-control, .form-select').on('blur', function() {
            if ($(this).prop('required') && !$(this).val()) {
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        $('.form-control, .form-select').on('input', function() {
            if ($(this).val()) {
                $(this).removeClass('is-invalid');
            }
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/course/editcourse.blade.php ENDPATH**/ ?>