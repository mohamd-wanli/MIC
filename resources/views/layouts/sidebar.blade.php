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
          <a href="{{ url('student') }}">
            <i class="bi bi-person-lines-fill"></i>
            <span>الطلاب</span>
          </a>
        </li>
        {{-- <li>
          <a href="{{ url('Search_student') }}">
            <i class="bi bi-search"></i>
            <span>بحث</span>
          </a>
        </li> --}}
      </ul>
    </li>

    <!-- ==========================================
    COURSE MANAGEMENT
    ========================================== -->
    <li class="nav-item">
      @canany('إدارة الدورات')
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-bookmark-fill"></i>
        <span>إدارة الدورات</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      @endcan
      <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @can('الدورات')
        <li>
          <a href="{{ route('showcourses', request()->secid) }}">
            <i class="bi bi-book-fill"></i>
            <span>الدورات</span>
          </a>
        </li>
        @endcan
        @can('الاقسام')
        <li>
          <a href="{{ route('showdepartment', request()->secid) }}">
            <i class="bi bi-grid-3x3-gap-fill"></i>
            <span>الأقسام</span>
          </a>
        </li>
        @endcan
        @can('المواد')
        <li>
          <a href="{{ route('showsubject', request()->secid) }}">
            <i class="bi bi-book-half"></i>
            <span>المواد</span>
          </a>
        </li>
        @endcan
        @can('المدرسون')
        <li>
          <a href="{{ route('showteachers', request()->secid) }}">
            <i class="bi bi-person-badge-fill"></i>
            <span>المدرسون</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    {{-- <!-- ==========================================
    ICDL + SCBC
    ========================================== -->
    <li class="nav-item">
      @can('ICDL + SCBC')
      <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-laptop-fill"></i>
        <span>ICDL + SCBC</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      @endcan
      <ul id="charts-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @canany(['Admin','الأيام الامتحانية'])
        <li>
          <a href="{{ url('Examday') }}">
            <i class="bi bi-calendar-event-fill"></i>
            <span>الأيام الامتحانية</span>
          </a>
        </li>
        @endcanany
        @can('الأيام الامتحانية النشطة')
        <li>
          <a href="{{ url('Examday_active') }}">
            <i class="bi bi-check-circle-fill"></i>
            <span>الأيام الامتحانية النشطة</span>
          </a>
        </li>
        @endcan
        @can('الأيام الامتحانية الملغاة')
        <li>
          <a href="{{ url('Examday_cancele') }}">
            <i class="bi bi-x-circle-fill"></i>
            <span>الأيام الامتحانية الملغاة</span>
          </a>
        </li>
        @endcan
        @can('الأيام الامتحانية المكتملة')
        <li>
          <a href="{{ url('Examday_complete') }}">
            <i class="bi bi-check2-circle"></i>
            <span>الأيام الامتحانية المكتملة</span>
          </a>
        </li>
        @endcan
      </ul>
    </li> --}}

    <!-- ==========================================
    REPORTS
    ========================================== -->
    <li class="nav-item">
      @can('التقارير')
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-file-earmark-bar-graph-fill"></i>
        <span>التقارير</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      @endcan
      <ul id="icons-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        {{-- @can('تقارير الفواتير')
        <li>
          <a href="{{ url('invoices_report') }}">
            <i class="bi bi-receipt-cutoff"></i>
            <span>تقارير الفواتير</span>
          </a>
        </li>
        @endcan --}}





         @can('تقرير الشهادات')
        <li>
          <a href="{{ url('certifications_Report') }}">
            <i class="bi bi-award-fill"></i>
            <span>القوائم</span>
          </a>
        </li>
        @endcan
        <li>
          <a href="{{ url('Students_By_Course') }}">
            <i class="bi bi-people-fill"></i>
            <span>تقارير طلاب ضمن دورة</span>
          </a>
        </li>
        {{-- <li>
          <a href="{{ url('certificate-requests') }}">
            <i class="bi bi-file-earmark-check-fill"></i>
            <span>تقارير طلبات شهادة</span>
          </a>
        </li> --}}
        {{-- <li>
            <a href="{{ route('reports.payments') }}" class="btn-modern btn-info-modern">
    <i class="fas fa-file-invoice"></i>
    تقرير المدفوعات
</a>
        </li> --}}
        <li class="nav-item">
    <a class="nav-link collapsed" href="{{ route('payments.handover') }}">
        <i class="bi bi-hand-index-thumb"></i>
        <span>تسليم الإيصالات</span>
    </a>
</li>


@can('تقرير التحصيل اليومي')
<li>
    <a href="{{ route('payments.reports.collections') }}">
        <i class="bi bi-cash-stack"></i>
        <span>تقرير التحصيل اليومي</span>
    </a>
</li>
@endcan
<li>
    <a href="{{ route('payments.reports.handovers') }}">
        <i class="bi bi-hand-thumbs-up"></i>
        <span>تقرير تسليمات الصندوق</span>
    </a>
</li>
{{-- <li>
    <a href="{{ route('payments.reports.pending') }}">
        <i class="bi bi-hourglass-split"></i>
        <span>العهدة الحالية</span>
    </a>
</li> --}}
      </ul>
    </li>

    <!-- ==========================================
    PROFESSIONAL CERTIFICATES
    ========================================== -->
    <li class="nav-item">
      @can('الشهادات الحرفية')
      <a class="nav-link collapsed" data-bs-target="#Report-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-patch-check-fill"></i>
        <span>الشهادات الحرفية</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      @endcan
      <ul id="Report-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @can('دورات قيد العمل')
        <li>
          <a href="{{ url('Course_active') }}">
            <i class="bi bi-play-circle-fill"></i>
            <span>دورات قيد العمل</span>
          </a>
        </li>
        @endcan
        @can('بحث شهادات')
        <li>
          <a href="{{ url('Course_complete') }}">
            <i class="bi bi-search"></i>
            <span>بحث</span>
          </a>
        </li>
        @endcan
        @can('تقرير مجموعات')
        <li>
          <a href="{{ url('report') }}">
            <i class="bi bi-people-fill"></i>
            <span>تقرير مجموعات</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>

    <!-- ==========================================
    USERS & PERMISSIONS
    ========================================== -->
    <li class="nav-item">
      @can('المستخدمون والصلاحيات')
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-shield-lock-fill"></i>
        <span>المستخدمون والصلاحيات</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      @endcan
      <ul id="tables-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        @can('المستخدمون')
        <li>
          <a href="{{ url('users') }}">
            <i class="bi bi-person-circle"></i>
            <span>المستخدمون</span>
          </a>
        </li>
        @endcan
        @can('الصلاحيات')
        <li>
          <a href="{{ url('roles') }}">
            <i class="bi bi-key-fill"></i>
            <span>الصلاحيات</span>
          </a>
        </li>
        @endcan
        <li>
          <a href="{{ url('meters') }}">
            <i class="bi bi-list-check"></i>
            <span>مواد الامتحانات</span>
          </a>
        </li>
      </ul>
    </li>

  </ul>

</aside>
<!-- End Sidebar -->
