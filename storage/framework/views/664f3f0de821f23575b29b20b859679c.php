<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <?php
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
    ?>

    <ul class="sidebar-nav" id="sidebar-nav">

        
        <?php $students = $state([], ['student', 'student/*']); ?>

        <li class="nav-item">
            <a class="<?php echo e($students['link']); ?>"
               data-bs-toggle="collapse"
               data-bs-target="#students-nav"
               href="#"
               role="button"
               aria-expanded="<?php echo e($students['expanded']); ?>"
               aria-controls="students-nav">
                <i class="bi bi-people-fill" aria-hidden="true"></i>
                <span>إدارة الطلاب</span>
                <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
            </a>

            <ul id="students-nav" class="<?php echo e($students['panel']); ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="<?php echo e(url('student')); ?>"
                       class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('student')]); ?>">
                        <i class="bi bi-person-lines-fill" aria-hidden="true"></i>
                        <span>الطلاب</span>
                    </a>
                </li>
            </ul>
        </li>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['الدورات', 'الاقسام', 'المواد', 'المدرسون'])): ?>
            <?php
                $courses = $state([
                    'showcourses',
                    'showdepartment',
                    'showsubject',
                    'showteachers',
                ]);
            ?>

            <li class="nav-item">
                <a class="<?php echo e($courses['link']); ?>"
                   data-bs-toggle="collapse"
                   data-bs-target="#courses-nav"
                   href="#"
                   role="button"
                   aria-expanded="<?php echo e($courses['expanded']); ?>"
                   aria-controls="courses-nav">
                    <i class="bi bi-journal-bookmark-fill" aria-hidden="true"></i>
                    <span>إدارة الدورات</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="courses-nav" class="<?php echo e($courses['panel']); ?>" data-bs-parent="#sidebar-nav">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الدورات')): ?>
                        <li>
                            <a href="<?php echo e(route('showcourses', request()->secid)); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('showcourses')]); ?>">
                                <i class="bi bi-book-fill" aria-hidden="true"></i>
                                <span>الدورات</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الاقسام')): ?>
                        <li>
                            <a href="<?php echo e(route('showdepartment', request()->secid)); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('showdepartment')]); ?>">
                                <i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i>
                                <span>الأقسام</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المواد')): ?>
                        <li>
                            <a href="<?php echo e(route('showsubject', request()->secid)); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('showsubject')]); ?>">
                                <i class="bi bi-book-half" aria-hidden="true"></i>
                                <span>المواد</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المدرسون')): ?>
                        <li>
                            <a href="<?php echo e(route('showteachers', request()->secid)); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('showteachers')]); ?>">
                                <i class="bi bi-person-badge-fill" aria-hidden="true"></i>
                                <span>المدرسون</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['التقارير', 'تقرير الشهادات', 'تقرير التحصيل اليومي'])): ?>
            <?php
                $reports = $state(
                    ['payments.handover', 'payments.reports.collections', 'payments.reports.handovers'],
                    ['certifications_Report', 'Students_By_Course']
                );
            ?>

            <li class="nav-item">
                <a class="<?php echo e($reports['link']); ?>"
                   data-bs-toggle="collapse"
                   data-bs-target="#reports-nav"
                   href="#"
                   role="button"
                   aria-expanded="<?php echo e($reports['expanded']); ?>"
                   aria-controls="reports-nav">
                    <i class="bi bi-file-earmark-bar-graph-fill" aria-hidden="true"></i>
                    <span>التقارير</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="reports-nav" class="<?php echo e($reports['panel']); ?>" data-bs-parent="#sidebar-nav">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير الشهادات')): ?>
                        <li>
                            <a href="<?php echo e(url('certifications_Report')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('certifications_Report')]); ?>">
                                <i class="bi bi-award-fill" aria-hidden="true"></i>
                                <span>القوائم</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="<?php echo e(url('Students_By_Course')); ?>"
                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('Students_By_Course')]); ?>">
                            <i class="bi bi-people-fill" aria-hidden="true"></i>
                            <span>تقارير طلاب ضمن دورة</span>
                        </a>
                    </li>

                    <li>
                        <a href="<?php echo e(route('payments.handover')); ?>"
                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('payments.handover')]); ?>">
                            <i class="bi bi-hand-index-thumb" aria-hidden="true"></i>
                            <span>تسليم الإيصالات</span>
                        </a>
                    </li>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير التحصيل اليومي')): ?>
                        <li>
                            <a href="<?php echo e(route('payments.reports.collections')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('payments.reports.collections')]); ?>">
                                <i class="bi bi-cash-stack" aria-hidden="true"></i>
                                <span>تقرير التحصيل اليومي</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="<?php echo e(route('payments.reports.handovers')); ?>"
                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->routeIs('payments.reports.handovers')]); ?>">
                            <i class="bi bi-hand-thumbs-up" aria-hidden="true"></i>
                            <span>تقرير تسليمات الصندوق</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['الشهادات الحرفية', 'دورات قيد العمل', 'بحث شهادات', 'تقرير مجموعات'])): ?>
            <?php
                $certificates = $state([], ['Course_active', 'Course_complete', 'report']);
            ?>

            <li class="nav-item">
                <a class="<?php echo e($certificates['link']); ?>"
                   data-bs-toggle="collapse"
                   data-bs-target="#certificates-nav"
                   href="#"
                   role="button"
                   aria-expanded="<?php echo e($certificates['expanded']); ?>"
                   aria-controls="certificates-nav">
                    <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                    <span>الشهادات الحرفية</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="certificates-nav" class="<?php echo e($certificates['panel']); ?>" data-bs-parent="#sidebar-nav">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('دورات قيد العمل')): ?>
                        <li>
                            <a href="<?php echo e(url('Course_active')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('Course_active')]); ?>">
                                <i class="bi bi-play-circle-fill" aria-hidden="true"></i>
                                <span>دورات قيد العمل</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث شهادات')): ?>
                        <li>
                            <a href="<?php echo e(url('Course_complete')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('Course_complete')]); ?>">
                                <i class="bi bi-search" aria-hidden="true"></i>
                                <span>بحث</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('تقرير مجموعات')): ?>
                        <li>
                            <a href="<?php echo e(url('report')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('report')]); ?>">
                                <i class="bi bi-people-fill" aria-hidden="true"></i>
                                <span>تقرير مجموعات</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </li>
        <?php endif; ?>

        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['المستخدمون والصلاحيات', 'المستخدمون', 'الصلاحيات'])): ?>
            <?php $acl = $state([], ['users', 'roles', 'meters']); ?>

            <li class="nav-item">
                <a class="<?php echo e($acl['link']); ?>"
                   data-bs-toggle="collapse"
                   data-bs-target="#acl-nav"
                   href="#"
                   role="button"
                   aria-expanded="<?php echo e($acl['expanded']); ?>"
                   aria-controls="acl-nav">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                    <span>المستخدمون والصلاحيات</span>
                    <i class="bi bi-chevron-down ms-auto" aria-hidden="true"></i>
                </a>

                <ul id="acl-nav" class="<?php echo e($acl['panel']); ?>" data-bs-parent="#sidebar-nav">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('المستخدمون')): ?>
                        <li>
                            <a href="<?php echo e(url('users')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('users')]); ?>">
                                <i class="bi bi-person-circle" aria-hidden="true"></i>
                                <span>المستخدمون</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('الصلاحيات')): ?>
                        <li>
                            <a href="<?php echo e(url('roles')); ?>"
                               class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('roles')]); ?>">
                                <i class="bi bi-key-fill" aria-hidden="true"></i>
                                <span>الصلاحيات</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="<?php echo e(url('meters')); ?>"
                           class="<?php echo \Illuminate\Support\Arr::toCssClasses(['active' => request()->is('meters')]); ?>">
                            <i class="bi bi-list-check" aria-hidden="true"></i>
                            <span>مواد الامتحانات</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

    </ul>
</aside>
<!-- End Sidebar -->
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>