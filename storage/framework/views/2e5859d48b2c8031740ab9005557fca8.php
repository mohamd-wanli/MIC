<?php $__env->startSection('title', 'الرئيسية'); ?>

<?php $__env->startSection('css'); ?>
<style>
    /* ============================================
       PREMIUM DASHBOARD — Design Tokens
       ============================================ */
    :root {
        --brand-1: #a77b35;
        --brand-2: #c49a54;
        --brand-3: #6d7892;
        --ink: #263247;
        --ink-soft: #536176;
        --ink-mute: #8994a5;
        --surface: #ffffff;
        --surface-strong: #ffffff;
        --surface-soft: #f7f8fb;
        --page: #f3f5f8;
        --border: #e5e9ef;
        --success: #16845b;
        --warning: #bd7a19;
        --info: #287ea3;
        --rose: #c14d61;
        --radius: 22px;
        --shadow-sm: 0 4px 16px rgba(34, 48, 68, 0.06);
        --shadow-md: 0 16px 38px rgba(34, 48, 68, 0.12);
        --shadow-brand: 0 12px 28px rgba(71, 83, 104, 0.12);
    }

    body {
        background:
            radial-gradient(circle at top left, rgba(196, 154, 84, 0.08), transparent 26%),
            radial-gradient(circle at bottom right, rgba(117, 154, 186, 0.08), transparent 24%),
            var(--page);
    }

    .container-fluid {
        position: relative;
        padding-top: 12px;
    }

    @keyframes dashFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .dash-anim {
        opacity: 0;
        animation: dashFadeUp .6s cubic-bezier(.22, 1, .36, 1) forwards;
    }
    .dash-anim.d1 { animation-delay: .05s; }
    .dash-anim.d2 { animation-delay: .12s; }
    .dash-anim.d3 { animation-delay: .2s; }
    .dash-anim.d4 { animation-delay: .28s; }
    .dash-anim.d5 { animation-delay: .35s; }

    .welcome-header {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius);
        padding: 38px 42px;
        margin-bottom: 26px;
        color: #fff;
        background:
            radial-gradient(520px 220px at 86% 0%, rgba(196, 154, 84, 0.16), transparent 58%),
            radial-gradient(540px 220px at 8% 100%, rgba(112, 151, 182, 0.16), transparent 60%),
            linear-gradient(120deg, #344257 0%, #45566b 48%, #344257 100%);
        border: 1px solid rgba(255, 255, 255, 0.26);
        box-shadow: var(--shadow-brand);
        isolation: isolate;
    }

    .welcome-header::before,
    .welcome-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
    }

    .welcome-header::before {
        width: 390px;
        height: 390px;
        top: -52%;
        inset-inline-end: -8%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.18), transparent 62%);
    }

    .welcome-header::after {
        width: 260px;
        height: 260px;
        bottom: -55%;
        inset-inline-start: -4%;
        background: radial-gradient(circle, rgba(196, 154, 84, 0.14), transparent 60%);
    }

    .welcome-header .hero-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.045) 1px, transparent 1px);
        background-size: 32px 32px;
        mask-image: radial-gradient(ellipse 88% 120% at 70% 0%, #000 23%, transparent 70%);
        pointer-events: none;
    }

    .welcome-header .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-header h2 {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 0 0 12px;
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -.03em;
        color: #ffffff;
    }

    .welcome-header h2 .hello-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 15px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.08));
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.2), 0 10px 22px rgba(20, 33, 52, 0.12);
        font-size: 1.15rem;
        animation: waveIcon 2.7s ease-in-out infinite;
        transform-origin: 70% 70%;
    }

    @keyframes waveIcon {
        0%, 60%, 100% { transform: rotate(0deg); }
        10% { transform: rotate(14deg); }
        20% { transform: rotate(-8deg); }
        30% { transform: rotate(14deg); }
        40% { transform: rotate(-4deg); }
        50% { transform: rotate(10deg); }
    }

    .welcome-header p {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px 4px;
        margin: 0;
        font-size: .92rem;
        color: rgba(255,255,255,.85);
    }

    .welcome-header p .chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 7px 13px;
        border-radius: 50px;
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(6px);
        font-weight: 600;
    }

    .welcome-header p .sep {
        color: rgba(255,255,255,.35);
        margin: 0 4px;
    }

    .welcome-header .welcome-icon {
        position: absolute;
        inset-inline-end: 38px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 6.6rem;
        color: rgba(255, 255, 255, 0.12);
        z-index: 0;
        transition: transform .5s ease;
    }

    .welcome-header:hover .welcome-icon {
        transform: translateY(-50%) rotate(-6deg) scale(1.08);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 26px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff, #fbfcfe);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        transition: transform .35s cubic-bezier(.22, 1, .36, 1), box-shadow .35s ease, border-color .35s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: rgba(167, 123, 53, 0.35);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        inset-inline-end: 0;
        width: 140px;
        height: 140px;
        border-radius: 50%;
        opacity: .10;
        transform: translate(35%, -35%);
        transition: transform .45s ease, opacity .45s ease;
    }

    .stat-card:hover::before {
        transform: translate(25%, -25%) scale(1.25);
        opacity: .15;
    }

    .stat-card.primary::before { background: #c49a54; }
    .stat-card.success::before { background: #35a97b; }
    .stat-card.warning::before { background: #e5aa4d; }
    .stat-card.info::before { background: #56a9ce; }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        inset-inline-start: 24px;
        width: 46px;
        height: 4px;
        border-radius: 0 0 8px 8px;
        background: linear-gradient(90deg, var(--brand-1), var(--brand-2));
        opacity: .95;
    }

    .stat-card .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .stat-card .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #0d1722;
        flex-shrink: 0;
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
        box-shadow: inset 0 1px 0 rgba(255,255,255,.25);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-6deg);
    }

    .stat-card.primary .stat-icon { background: linear-gradient(135deg, #b98b43, #dfbd7c); color: #fff; }
    .stat-card.success .stat-icon { background: linear-gradient(135deg, #258960, #57bd91); color: #fff; }
    .stat-card.warning .stat-icon { background: linear-gradient(135deg, #c98a32, #e8b85f); color: #fff; }
    .stat-card.info .stat-icon { background: linear-gradient(135deg, #327f9f, #65b2ce); color: #fff; }

    .stat-card .stat-number {
        font-size: 2.1rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -.03em;
        color: var(--ink);
        margin-bottom: 4px;
        font-variant-numeric: tabular-nums;
    }

    .stat-card .stat-label {
        color: var(--ink-mute);
        font-size: .85rem;
        font-weight: 600;
    }

    .stat-card .stat-trend {
        font-size: .72rem;
        font-weight: 700;
        padding: 5px 11px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border: 1px solid rgba(255,255,255,.06);
        background: linear-gradient(180deg, #ffffff, #fafbfd);
        color: var(--ink-soft);
    }

    .section-card {
        background: linear-gradient(180deg, #ffffff, #fbfcfe);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 24px;
        height: calc(100% - 24px);
        transition: box-shadow .35s ease, border-color .35s ease;
    }

    .section-card:hover {
        box-shadow: var(--shadow-md);
        border-color: rgba(167, 123, 53, 0.3);
    }

    .section-card .section-header {
        padding: 17px 24px;
        border-bottom: 1px solid #ece7dd;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(90deg, rgba(196, 154, 84, 0.07), rgba(255,255,255,0.4));
    }

    .section-card .section-header h5 {
        margin: 0;
        font-weight: 800;
        font-size: .98rem;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 10px;
        letter-spacing: -.01em;
    }

    .section-card .section-header h5 .head-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 33px;
        height: 33px;
        border-radius: 12px;
        background: linear-gradient(135deg, #b98b43, #d6b36e);
        color: #fff;
        font-size: .8rem;
        box-shadow: 0 6px 18px rgba(215, 179, 106, 0.22);
    }

    .section-card .section-header .view-all {
        color: var(--brand-2);
        font-size: .8rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 14px;
        border-radius: 50px;
        background: rgba(196, 154, 84, 0.08);
        border: 1px solid rgba(167, 123, 53, 0.18);
        transition: all .3s ease;
    }

    .section-card .section-header .view-all:hover {
        background: rgba(196, 154, 84, 0.14);
        gap: 9px;
    }

    .section-card .section-body {
        padding: 18px 24px 22px;
    }

    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(135px, 1fr));
        gap: 14px;
    }

    .quick-action-btn {
        position: relative;
        overflow: hidden;
        background: #fbfcfe;
        border: 1px solid #e7ebf0;
        border-radius: 16px;
        padding: 22px 14px;
        text-align: center;
        text-decoration: none;
        color: var(--ink-soft);
        transition: all .35s cubic-bezier(.22, 1, .36, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 11px;
    }

    .quick-action-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(196, 154, 84, 0.07), rgba(94, 145, 182, 0.05));
        opacity: 0;
        transition: opacity .35s ease;
    }

    .quick-action-btn:hover {
        border-color: rgba(167, 123, 53, 0.42);
        transform: translateY(-5px);
        box-shadow: 0 12px 26px rgba(34, 48, 68, 0.10);
        color: var(--brand-2);
    }

    .quick-action-btn:hover::before {
        opacity: 1;
    }

    .quick-action-btn i {
        position: relative;
        font-size: 1.7rem;
        color: var(--brand-2);
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .quick-action-btn:hover i {
        transform: scale(1.18) translateY(-2px);
    }

    .quick-action-btn span {
        position: relative;
        font-size: .83rem;
        font-weight: 700;
    }

    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 10px;
        border-bottom: 1px solid #edf0f4;
        border-radius: 12px;
        transition: background .25s ease;
    }

    .activity-item:hover {
        background: #f7f8fa;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item .activity-icon {
        width: 42px;
        height: 42px;
        border-radius: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: .95rem;
        flex-shrink: 0;
        transition: transform .3s ease;
    }

    .activity-item:hover .activity-icon {
        transform: scale(1.08);
    }

    .activity-icon.blue { background: #eaf3f8; color: #287ea3; }
    .activity-icon.green { background: #eaf6f0; color: #16845b; }
    .activity-icon.orange { background: #fbf3e6; color: #bd7a19; }
    .activity-icon.purple { background: #f1ecf8; color: #73529b; }

    .activity-item .activity-content {
        flex: 1;
        min-width: 0;
    }

    .activity-item .activity-content .activity-title {
        font-weight: 700;
        color: var(--ink);
        font-size: .88rem;
        margin-bottom: 3px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .activity-item .activity-content .activity-time {
        font-size: .74rem;
        color: var(--ink-mute);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .activity-view-btn {
        flex-shrink: 0;
        background: linear-gradient(135deg, #a77b35, #c49a54);
        color: #fff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: .74rem;
        text-decoration: none;
        font-weight: 800;
        box-shadow: 0 8px 20px rgba(215, 179, 106, 0.2);
        transition: all .3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .activity-view-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 26px rgba(215, 179, 106, 0.28);
    }

    .empty-state {
        text-align: center;
        padding: 38px 20px;
        color: var(--ink-mute);
    }

    .empty-state .empty-icon {
        width: 64px;
        height: 64px;
        margin: 0 auto 14px;
        border-radius: 20px;
        background: #f7f8fa;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #b9c1cc;
        border: 1px solid #e8ebf0;
    }

    .progress-item {
        margin-bottom: 20px;
    }

    .progress-item:last-child {
        margin-bottom: 0;
    }

    .progress-item .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 9px;
        font-size: .86rem;
        font-weight: 700;
        color: var(--ink);
    }

    .progress-item .progress-label .progress-name {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .progress-item .progress-label .progress-value {
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    .progress-item .progress-bar-custom {
        height: 10px;
        background: #edf0f4;
        border: 1px solid #e4e8ee;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.18);
    }

    .progress-item .progress-bar-custom .progress-fill {
        height: 100%;
        width: 0;
        border-radius: 50px;
        position: relative;
        transition: width 1.2s cubic-bezier(.22, 1, .36, 1);
    }

    .progress-item .progress-bar-custom .progress-fill::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .42), transparent);
        transform: translateX(-100%);
        animation: shine 2.4s ease-in-out infinite;
    }

    @keyframes shine {
        60%  { transform: translateX(100%); }
        100% { transform: translateX(100%); }
    }

    .progress-fill.blue { background: linear-gradient(90deg, #5ec8ff, #8edcff); box-shadow: 0 2px 8px rgba(94, 200, 255, .30); }
    .progress-fill.green { background: linear-gradient(90deg, #39d98a, #8beec0); box-shadow: 0 2px 8px rgba(57, 217, 138, .30); }
    .progress-fill.orange { background: linear-gradient(90deg, #f7b955, #f9d47e); box-shadow: 0 2px 8px rgba(247, 185, 85, .30); }
    .progress-fill.pink { background: linear-gradient(90deg, #ff6b81, #ffb2be); box-shadow: 0 2px 8px rgba(255, 107, 129, .30); }

    .payment-amount {
        color: #16845b;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    @media (max-width: 991px) {
        .welcome-header { padding: 28px; }
        .welcome-header h2 { font-size: 1.6rem; }
        .welcome-header .welcome-icon { font-size: 4.3rem; inset-inline-end: 22px; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .stat-card { padding: 19px; }
        .stat-card .stat-number { font-size: 1.7rem; }
    }

    @media (max-width: 767px) {
        .welcome-header { padding: 24px 20px; text-align: center; }
        .welcome-header h2 { font-size: 1.32rem; justify-content: center; }
        .welcome-header p { justify-content: center; }
        .welcome-header .welcome-icon { display: none; }
        .stats-grid { grid-template-columns: 1fr 1fr; gap: 12px; }
        .stat-card .stat-icon { width: 42px; height: 42px; font-size: 1.1rem; }
        .stat-card .stat-number { font-size: 1.45rem; }
        .stat-card .stat-label { font-size: .74rem; }
        .quick-actions { grid-template-columns: 1fr 1fr; }
        .section-card .section-header .view-all span { display: none; }
        .activity-view-btn { padding: 5px 12px; }
    }

    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr 1fr; gap: 10px; }
        .stat-card { padding: 15px; }
        .stat-card .stat-number { font-size: 1.25rem; }
        .stat-card .stat-label { font-size: .7rem; }
        .stat-trend { display: none !important; }
        .quick-action-btn { padding: 16px 10px; }
        .quick-action-btn i { font-size: 1.4rem; }
        .quick-action-btn span { font-size: .75rem; }
    }

    @media (prefers-reduced-motion: reduce) {
        .dash-anim, .welcome-header h2 .hello-badge, .progress-fill::after {
            animation: none !important;
        }
        .dash-anim { opacity: 1; }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-3 px-md-4">

    <!-- Welcome Header -->
    <div class="welcome-header dash-anim d1">
        <div class="hero-grid"></div>
        <div class="welcome-content">
            <h2>
                <span class="hello-badge"><i class="fas fa-hand-sparkles"></i></span>
                مرحباً بك، <?php echo e(Auth::user()->name); ?>

            </h2>
            <p>
                <span class="chip">
                    <i class="fas fa-calendar-alt"></i>
                    <?php echo e(date('Y-m-d')); ?>

                </span>
                <span class="sep">•</span>
                <span class="chip">
                    <i class="fas fa-clock"></i>
                    <?php echo e(date('h:i A')); ?>

                </span>
                <?php if(Auth::user()->department_id): ?>
                    <span class="sep">•</span>
                    <span class="chip">
                        <i class="fas fa-building"></i>
                        <?php echo e(Auth::user()->department->name ?? 'غير محدد'); ?>

                    </span>
                <?php endif; ?>
            </p>
        </div>
        <i class="fas fa-chart-line welcome-icon"></i>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Total Students -->
        <div class="stat-card primary dash-anim d2">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number" data-counter="<?php echo e($totalStudents ?? 0); ?>">0</div>
            <div class="stat-label">إجمالي الطلاب</div>
        </div>

        <!-- Total Courses -->
        <div class="stat-card success dash-anim d2">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number" data-counter="<?php echo e($totalCourses ?? 0); ?>">0</div>
            <div class="stat-label">إجمالي الدورات</div>
        </div>

        <!-- Total Teachers -->
        <div class="stat-card warning dash-anim d2">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number" data-counter="<?php echo e($totalTeachers ?? 0); ?>">0</div>
            <div class="stat-label">المدرسين</div>
        </div>

        <!-- Total Payments -->
        <div class="stat-card info dash-anim d2">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-check"></i> مدفوع
                </span>
            </div>
            <div class="stat-number" data-counter="<?php echo e($totalPayments ?? 0); ?>" data-format="1">0</div>
            <div class="stat-label">إجمالي المدفوعات (ل.س)</div>
        </div>
    </div>

    <!-- Quick Actions & Recent Students -->
    <div class="row g-3 mb-1">
        <!-- Quick Actions -->
        <div class="col-lg-5">
            <div class="section-card dash-anim d3">
                <div class="section-header">
                    <h5>
                        <span class="head-icon"><i class="fas fa-bolt"></i></span>
                        إجراءات سريعة
                    </h5>
                </div>
                <div class="section-body">
                    <div class="quick-actions">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة طالب')): ?>
                        <a href="<?php echo e(route('student.create')); ?>" class="quick-action-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>إضافة طالب</span>
                        </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('اضافة دورة')): ?>
                        <a href="<?php echo e(url('/courses/create')); ?>" class="quick-action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>إضافة دورة</span>
                        </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث بالاسم')): ?>
                        <a href="<?php echo e(route('students.searchByName')); ?>" class="quick-action-btn">
                            <i class="fas fa-search"></i>
                            <span>بحث بالاسم</span>
                        </a>
                        <?php endif; ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('بحث برقم الصفحة')): ?>
                        <a href="<?php echo e(route('students.search')); ?>" class="quick-action-btn">
                            <i class="fas fa-file-alt"></i>
                            <span>بحث برقم الصفحة</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Students -->
        <div class="col-lg-7">
            <div class="section-card dash-anim d3">
                <div class="section-header">
                    <h5>
                        <span class="head-icon"><i class="fas fa-user-clock"></i></span>
                        أحدث الطلاب المسجلين
                    </h5>
                    <a href="<?php echo e(route('student.index')); ?>" class="view-all">
                        عرض الكل <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="section-body">
                    <ul class="activity-list">
                        <?php $__empty_1 = true; $__currentLoopData = $recentStudents ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="activity-item">
                                <div class="activity-icon blue">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title"><?php echo e($student->fullname); ?></div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($student->created_at ? $student->created_at->diffForHumans() : '—'); ?>

                                    </div>
                                </div>
                                <a href="<?php echo e(route('student.show', $student->id)); ?>" class="activity-view-btn">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="empty-state">
                                <div class="empty-icon"><i class="fas fa-user-graduate"></i></div>
                                <p>لا توجد بيانات حديثة</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress & Recent Payments -->
    <div class="row g-3">
        <!-- Statistics Progress -->
        <div class="col-lg-6">
            <div class="section-card dash-anim d4">
                <div class="section-header">
                    <h5>
                        <span class="head-icon"><i class="fas fa-chart-pie"></i></span>
                        إحصائيات عامة
                    </h5>
                </div>
                <div class="section-body">
                    <?php
                        $maxValue = max($totalStudents ?? 1, $totalCourses ?? 1, $totalTeachers ?? 1, $totalSubjects ?? 1);
                        $pct = function ($v) use ($maxValue) {
                            return $maxValue > 0 ? round(($v / $maxValue) * 100, 1) : 0;
                        };
                    ?>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-user-graduate" style="color: #6366f1;"></i> الطلاب</span>
                            <span class="progress-value" style="color: #6366f1;"><?php echo e($totalStudents ?? 0); ?></span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill blue" data-width="<?php echo e($pct($totalStudents ?? 0)); ?>"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-graduation-cap" style="color: #059669;"></i> الدورات</span>
                            <span class="progress-value" style="color: #059669;"><?php echo e($totalCourses ?? 0); ?></span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill green" data-width="<?php echo e($pct($totalCourses ?? 0)); ?>"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-chalkboard-teacher" style="color: #d97706;"></i> المدرسين</span>
                            <span class="progress-value" style="color: #d97706;"><?php echo e($totalTeachers ?? 0); ?></span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill orange" data-width="<?php echo e($pct($totalTeachers ?? 0)); ?>"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-book" style="color: #e11d48;"></i> المواد</span>
                            <span class="progress-value" style="color: #e11d48;"><?php echo e($totalSubjects ?? 0); ?></span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill pink" data-width="<?php echo e($pct($totalSubjects ?? 0)); ?>"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="col-lg-6">
            <div class="section-card dash-anim d5">
                <div class="section-header">
                    <h5>
                        <span class="head-icon"><i class="fas fa-money-bill-wave"></i></span>
                        أحدث المدفوعات
                    </h5>
                </div>
                <div class="section-body">
                    <ul class="activity-list">
                        <?php $__empty_1 = true; $__currentLoopData = $recentPayments ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <li class="activity-item">
                                <div class="activity-icon green">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">
                                        <span class="payment-amount"><?php echo e(number_format($payment->payment_value)); ?> ل.س</span>
                                        — <?php echo e($payment->student->fullname ?? 'غير معروف'); ?>

                                    </div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($payment->created_at ? $payment->created_at->diffForHumans() : '—'); ?>

                                    </div>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <li class="empty-state">
                                <div class="empty-icon"><i class="fas fa-money-bill-wave"></i></div>
                                <p>لا توجد مدفوعات حديثة</p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        /* Animated counters for stat numbers */
        document.querySelectorAll('[data-counter]').forEach(function (el) {
            var target = parseFloat(el.getAttribute('data-counter')) || 0;
            var useFormat = el.hasAttribute('data-format');
            var duration = 1200;
            var start = null;

            function step(ts) {
                if (!start) start = ts;
                var p = Math.min((ts - start) / duration, 1);
                var eased = 1 - Math.pow(1 - p, 3); /* easeOutCubic */
                var value = Math.round(target * eased);
                el.textContent = useFormat ? value.toLocaleString('en-US') : value;
                if (p < 1) requestAnimationFrame(step);
            }

            requestAnimationFrame(step);
        });

        /* Animated progress bars */
        setTimeout(function () {
            document.querySelectorAll('.progress-fill[data-width]').forEach(function (bar) {
                bar.style.width = bar.getAttribute('data-width') + '%';
            });
        }, 250);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/home.blade.php ENDPATH**/ ?>