<?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td>
            <input type="checkbox"
                   name="selected_courses[]"
                   value="<?php echo e($course->id); ?>"
                   class="checkbox-modern course-checkbox"
                   <?php echo e(in_array($course->id, session('selected_courses', [])) ? 'checked' : ''); ?>>
        </td>
        <td>
            <?php $department = $departments->where('id', $course->dep_id)->first(); ?>
            <?php if($department): ?>
                <span class="badge-modern badge-primary"><?php echo e($department->name); ?></span>
            <?php else: ?>
                <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
            <?php endif; ?>
        </td>
        <td>
            <?php $subject = $subjects->where('id', $course->subject_id)->first(); ?>
            <?php if($subject): ?>
                <span style="font-weight: 600;"><?php echo e($subject->name); ?></span>
            <?php else: ?>
                <span style="color: #adb5bd; font-size: 0.8rem;">—</span>
            <?php endif; ?>
        </td>
        <td>
            <span style="font-weight: 700; color: #667eea; font-family: monospace;">
                <?php echo e($course->coursenumber); ?>

            </span>
        </td>
        <td>
            <?php if($course->page_number): ?>
                <span class="badge-modern badge-success">
                    <i class="fas fa-file-alt"></i> <?php echo e($course->page_number); ?>

                </span>
            <?php else: ?>
                <span style="color: #adb5bd;">—</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if($course->start_date): ?>
                <span style="display: inline-flex; align-items: center; gap: 5px;">
                    <i class="fas fa-calendar-alt" style="color: #667eea; font-size: 0.7rem;"></i>
                    <?php echo e($course->start_date); ?>

                </span>
            <?php else: ?>
                <span style="color: #adb5bd;">—</span>
            <?php endif; ?>
        </td>
        <td>
            <?php if($course->days_of_course): ?>
                <?php $days = explode(',', $course->days_of_course); ?>
                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="day-tag-modern"><?php echo e(trim($day)); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <span style="color: #adb5bd;">—</span>
            <?php endif; ?>
        </td>
        <td>
            <div style="display: flex; flex-wrap: wrap; gap: 5px; justify-content: center;">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تفاصيل دورة')): ?>
                <a href="<?php echo e(route('showcourse', ['id' => $course->id])); ?>" class="table-action-btn view-btn">
                    <i class="fas fa-eye"></i> تفاصيل
                </a>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تعديل دورة')): ?>
                <a href="<?php echo e(route('editcourse', ['id' => $course->id])); ?>" class="table-action-btn edit-btn">
                    <i class="fas fa-edit"></i> تعديل
                </a>
                <?php endif; ?>
                <button class="table-action-btn delete-btn delete-course" data-id="<?php echo e($course->id); ?>">
                    <i class="fas fa-trash-alt"></i> حذف
                </button>
            </div>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="8">
            <div class="empty-state-modern">
                <i class="fas fa-inbox"></i>
                <h5>لا توجد دورات مطابقة</h5>
                <p>حاول تعديل معايير البحث</p>
            </div>
        </td>
    </tr>
<?php endif; ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/course/partials/table_body.blade.php ENDPATH**/ ?>