<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    @php
        /*
        |----------------------------------------------------------------------
        | Sidebar state resolver
        |----------------------------------------------------------------------
        | Returns the Bootstrap classes + ARIA attributes required to keep a
        | collapsible group open and highlighted after a page reload.
        |
        | Usage:  $state(['route.name'])          -> named routes
        |         $state([], ['uri', 'uri/*'])    -> URI patterns
        */
        $state = static function (array $routes = [], array $uris = []): array {
            $active = ($routes !== [] && request()->routeIs(...$routes))
                || ($uris !== [] && request()->is(...$uris));

            return [
                'active'   => $active,
                'link'     => $active ? 'nav-link' : 'nav-link collapsed',
                'panel'    => $active ? 'nav-content collapse show' : 'nav-content collapse',
                'expanded' => $active ? 'true' : 'false',
            ];
        };
    @endphp

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- ==========================================================
             STUDENT MANAGEMENT
             ========================================================== --}}
        @php $students = $state([], ['student', 'student/*']); @endphp

        <li class="nav-item">
            <a class="{{ $students['link'] }}"
               data-bs-toggle="collapse"
               data-bs-target="#students-nav"
               href="#"
               role="button"
               aria-expanded="{{ $students['expanded'] }}"
               aria-controls="students-nav">
                <i class="bi bi-people-fill" aria-hidden="true"></i>
                <span>إدارة الطلاب</span>
                <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
            </a>

            <ul id="students-nav" class="{{ $students['panel'] }}" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('student') }}"
                       @class(['active' => request()->is('student')])>
                        <i class="bi bi-person-lines-fill" aria-hidden="true"></i>
                        <span>الطلاب</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ==========================================================
             COURSE MANAGEMENT
             ========================================================== --}}
        @canany(['الدورات', 'الاقسام', 'المواد', 'المدرسون'])
            @php
                $courses = $state([
                    'showcourses',
                    'showdepartment',
                    'showsubject',
                    'showteachers',
                ]);
            @endphp

            <li class="nav-item">
                <a class="{{ $courses['link'] }}"
                   data-bs-toggle="collapse"
                   data-bs-target="#courses-nav"
                   href="#"
                   role="button"
                   aria-expanded="{{ $courses['expanded'] }}"
                   aria-controls="courses-nav">
                    <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>
                    <span>إدارة الدورات</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="courses-nav" class="{{ $courses['panel'] }}" data-bs-parent="#sidebar-nav">
                    @can('الدورات')
                        <li>
                            <a href="{{ route('showcourses', request()->secid) }}"
                               @class(['active' => request()->routeIs('showcourses')])>
                                <i class="bi bi-book-fill" aria-hidden="true"></i>
                                <span>الدورات</span>
                            </a>
                        </li>
                    @endcan

                    @can('الاقسام')
                        <li>
                            <a href="{{ route('showdepartment', request()->secid) }}"
                               @class(['active' => request()->routeIs('showdepartment')])>
                                <i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i>
                                <span>الأقسام</span>
                            </a>
                        </li>
                    @endcan

                    @can('المواد')
                        <li>
                            <a href="{{ route('showsubject', request()->secid) }}"
                               @class(['active' => request()->routeIs('showsubject')])>
                                <i class="bi bi-book-half" aria-hidden="true"></i>
                                <span>المواد</span>
                            </a>
                        </li>
                    @endcan

                    @can('المدرسون')
                        <li>
                            <a href="{{ route('showteachers', request()->secid) }}"
                               @class(['active' => request()->routeIs('showteachers')])>
                                <i class="bi bi-person-badge-fill" aria-hidden="true"></i>
                                <span>المدرسون</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        {{-- ==========================================================
             REPORTS
             ========================================================== --}}
        @canany(['التقارير', 'تقرير الشهادات', 'تقرير التحصيل اليومي'])
            @php
                $reports = $state(
                    ['payments.handover', 'payments.reports.collections', 'payments.reports.handovers'],
                    ['certifications_Report', 'Students_By_Course']
                );
            @endphp

            <li class="nav-item">
                <a class="{{ $reports['link'] }}"
                   data-bs-toggle="collapse"
                   data-bs-target="#reports-nav"
                   href="#"
                   role="button"
                   aria-expanded="{{ $reports['expanded'] }}"
                   aria-controls="reports-nav">
                    <i class="bi bi-file-earmark-bar-graph-fill" aria-hidden="true"></i>
                    <span>التقارير</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="reports-nav" class="{{ $reports['panel'] }}" data-bs-parent="#sidebar-nav">
                    @can('تقرير الشهادات')
                        <li>
                            <a href="{{ url('certifications_Report') }}"
                               @class(['active' => request()->is('certifications_Report')])>
                                <i class="bi bi-award-fill" aria-hidden="true"></i>
                                <span>القوائم</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ url('Students_By_Course') }}"
                           @class(['active' => request()->is('Students_By_Course')])>
                            <i class="bi bi-people-fill" aria-hidden="true"></i>
                            <span>تقارير طلاب ضمن دورة</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('payments.handover') }}"
                           @class(['active' => request()->routeIs('payments.handover')])>
                            <i class="bi bi-hand-index-thumb" aria-hidden="true"></i>
                            <span>تسليم الإيصالات</span>
                        </a>
                    </li>

                    @can('تقرير التحصيل اليومي')
                        <li>
                            <a href="{{ route('payments.reports.collections') }}"
                               @class(['active' => request()->routeIs('payments.reports.collections')])>
                                <i class="bi bi-cash-stack" aria-hidden="true"></i>
                                <span>تقرير التحصيل اليومي</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('payments.reports.handovers') }}"
                           @class(['active' => request()->routeIs('payments.reports.handovers')])>
                            <i class="bi bi-hand-thumbs-up" aria-hidden="true"></i>
                            <span>تقرير تسليمات الصندوق</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany

        {{-- ==========================================================
             PROFESSIONAL CERTIFICATES
             ========================================================== --}}
        @canany(['الشهادات الحرفية', 'دورات قيد العمل', 'بحث شهادات', 'تقرير مجموعات'])
            @php
                $certificates = $state([], ['Course_active', 'Course_complete', 'report']);
            @endphp

            <li class="nav-item">
                <a class="{{ $certificates['link'] }}"
                   data-bs-toggle="collapse"
                   data-bs-target="#certificates-nav"
                   href="#"
                   role="button"
                   aria-expanded="{{ $certificates['expanded'] }}"
                   aria-controls="certificates-nav">
                    <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                    <span>الشهادات الحرفية</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="certificates-nav" class="{{ $certificates['panel'] }}" data-bs-parent="#sidebar-nav">
                    @can('دورات قيد العمل')
                        <li>
                            <a href="{{ url('Course_active') }}"
                               @class(['active' => request()->is('Course_active')])>
                                <i class="bi bi-play-circle-fill" aria-hidden="true"></i>
                                <span>دورات قيد العمل</span>
                            </a>
                        </li>
                    @endcan

                    @can('بحث شهادات')
                        <li>
                            <a href="{{ url('Course_complete') }}"
                               @class(['active' => request()->is('Course_complete')])>
                                <i class="bi bi-search" aria-hidden="true"></i>
                                <span>بحث</span>
                            </a>
                        </li>
                    @endcan

                    @can('تقرير مجموعات')
                        <li>
                            <a href="{{ url('report') }}"
                               @class(['active' => request()->is('report')])>
                                <i class="bi bi-people-fill" aria-hidden="true"></i>
                                <span>تقرير مجموعات</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany

        {{-- ==========================================================
             USERS & PERMISSIONS
             ========================================================== --}}
        @canany(['المستخدمون والصلاحيات', 'المستخدمون', 'الصلاحيات'])
            @php $acl = $state([], ['users', 'roles', 'meters']); @endphp

            <li class="nav-item">
                <a class="{{ $acl['link'] }}"
                   data-bs-toggle="collapse"
                   data-bs-target="#acl-nav"
                   href="#"
                   role="button"
                   aria-expanded="{{ $acl['expanded'] }}"
                   aria-controls="acl-nav">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                    <span>المستخدمون والصلاحيات</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="acl-nav" class="{{ $acl['panel'] }}" data-bs-parent="#sidebar-nav">
                    @can('المستخدمون')
                        <li>
                            <a href="{{ url('users') }}"
                               @class(['active' => request()->is('users')])>
                                <i class="bi bi-person-circle" aria-hidden="true"></i>
                                <span>المستخدمون</span>
                            </a>
                        </li>
                    @endcan

                    @can('الصلاحيات')
                        <li>
                            <a href="{{ url('roles') }}"
                               @class(['active' => request()->is('roles')])>
                                <i class="bi bi-key-fill" aria-hidden="true"></i>
                                <span>الصلاحيات</span>
                            </a>
                        </li>
                    @endcan

                    <li>
                        <a href="{{ url('meters') }}"
                           @class(['active' => request()->is('meters')])>
                            <i class="bi bi-list-check" aria-hidden="true"></i>
                            <span>مواد الامتحانات</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany

    </ul>
</aside>
<!-- End Sidebar -->
