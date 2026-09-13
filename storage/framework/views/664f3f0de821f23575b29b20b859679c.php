<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <!-- ==========================================
    STUDENT MANAGEMENT
    ========================================== -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-people-fill"></i>
        <span>إدارة الطلاب</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?php echo e(url('student')); ?>">
            <i class="bi bi-person-lines-fill"></i>
            <span>الطلاب</span>
          </a>
        </li>
        
      </ul>
    </li>

    <!-- ==========================================
    COURSE MANAGEMENT
    ========================================== -->
    <li class="nav-item">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any('إدارة الدورات')): ?>
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-bookmark-fill"></i>
        <span>إدارة الدورات</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <?php endif; ?>
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الدورات')): ?>
        <li>
          <a href="<?php echo e(route('showcourses', request()->secid)); ?>">
            <i class="bi bi-book-fill"></i>
            <span>الدورات</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الاقسام')): ?>
        <li>
          <a href="<?php echo e(route('showdepartment', request()->secid)); ?>">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            <span>الأقسام</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المواد')): ?>
        <li>
          <a href="<?php echo e(route('showsubject', request()->secid)); ?>">
            <i class="bi bi-book-half"></i>
            <span>المواد</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المدرسون')): ?>
        <li>
          <a href="<?php echo e(route('showteachers', request()->secid)); ?>">
            <i class="bi bi-person-badge-fill"></i>
            <span>المدرسون</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    

    <!-- ==========================================
    REPORTS
    ========================================== -->
    <li class="nav-item">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('التقارير')): ?>
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-bar-graph-fill"></i>
        <span>التقارير</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <?php endif; ?>
      <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        





         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير الشهادات')): ?>
        <li>
          <a href="<?php echo e(url('certifications_Report')); ?>">
            <i class="bi bi-award-fill"></i>
            <span>القوائم</span>
          </a>
        </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo e(url('Students_By_Course')); ?>">
            <i class="bi bi-people-fill"></i>
            <span>تقارير طلاب ضمن دورة</span>
          </a>
        </li>
        
        
        <li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo e(route('payments.handover')); ?>">
        <i class="bi bi-hand-index-thumb"></i>
        <span>تسليم الإيصالات</span>
    </a>
</li>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير التحصيل اليومي')): ?>
<li>
    <a href="<?php echo e(route('payments.reports.collections')); ?>">
        <i class="bi bi-cash-stack"></i>
        <span>تقرير التحصيل اليومي</span>
    </a>
</li>
<?php endif; ?>
<li>
    <a href="<?php echo e(route('payments.reports.handovers')); ?>">
        <i class="bi bi-hand-thumbs-up"></i>
        <span>تقرير تسليمات الصندوق</span>
    </a>
</li>

      </ul>
    </li>

    <!-- ==========================================
    PROFESSIONAL CERTIFICATES
    ========================================== -->
    <li class="nav-item">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الشهادات الحرفية')): ?>
      <a class="nav-link collapsed" data-bs-target="#Report-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-patch-check-fill"></i>
        <span>الشهادات الحرفية</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <?php endif; ?>
      <ul id="Report-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('دورات قيد العمل')): ?>
        <li>
          <a href="<?php echo e(url('Course_active')); ?>">
            <i class="bi bi-play-circle-fill"></i>
            <span>دورات قيد العمل</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث شهادات')): ?>
        <li>
          <a href="<?php echo e(url('Course_complete')); ?>">
            <i class="bi bi-search"></i>
            <span>بحث</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير مجموعات')): ?>
        <li>
          <a href="<?php echo e(url('report')); ?>">
            <i class="bi bi-people-fill"></i>
            <span>تقرير مجموعات</span>
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </li>

    <!-- ==========================================
    USERS & PERMISSIONS
    ========================================== -->
    <li class="nav-item">
      <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المستخدمون والصلاحيات')): ?>
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-shield-lock-fill"></i>
        <span>المستخدمون والصلاحيات</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <?php endif; ?>
      <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المستخدمون')): ?>
        <li>
          <a href="<?php echo e(url('users')); ?>">
            <i class="bi bi-person-circle"></i>
            <span>المستخدمون</span>
          </a>
        </li>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الصلاحيات')): ?>
        <li>
          <a href="<?php echo e(url('roles')); ?>">
            <i class="bi bi-key-fill"></i>
            <span>الصلاحيات</span>
          </a>
        </li>
        <?php endif; ?>
        <li>
          <a href="<?php echo e(url('meters')); ?>">
            <i class="bi bi-list-check"></i>
            <span>مواد الامتحانات</span>
          </a>
        </li>
      </ul>
    </li>

  </ul>

</aside>
<!-- End Sidebar -->
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>