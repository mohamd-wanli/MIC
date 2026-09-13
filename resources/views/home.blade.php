{{-- @extends('layouts.master')

@section('title', 'الرئيسية')

@section('css')
<style>
    /* ============================================
       MODERN DASHBOARD STYLES
       ============================================ */

    /* Welcome Header */
    .welcome-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 35px 40px;
        border-radius: 20px;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.25);
    }

    .welcome-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 350px;
        height: 350px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-header::after {
        content: '';
        position: absolute;
        bottom: -60%;
        left: -5%;
        width: 250px;
        height: 250px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 50%;
        pointer-events: none;
    }

    .welcome-header .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-header h2 {
        color: #ffffff;
        font-weight: 700;
        font-size: 1.8rem;
        margin: 0 0 8px 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .welcome-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1rem;
        margin: 0;
    }

    .welcome-header .welcome-icon {
        position: absolute;
        left: 40px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 6rem;
        color: rgba(255, 255, 255, 0.1);
        z-index: 0;
    }

    /* Statistics Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef2f7;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.1);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        opacity: 0.08;
        transform: translate(30%, -30%);
    }

    .stat-card.primary::before { background: #667eea; }
    .stat-card.success::before { background: #11998e; }
    .stat-card.warning::before { background: #f7971e; }
    .stat-card.info::before { background: #2193b0; }

    .stat-card .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .stat-card .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #ffffff;
        flex-shrink: 0;
    }

    .stat-card.primary .stat-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
    }

    .stat-card.success .stat-icon {
        background: linear-gradient(135deg, #11998e, #38ef7d);
        box-shadow: 0 4px 15px rgba(17, 153, 142, 0.35);
    }

    .stat-card.warning .stat-icon {
        background: linear-gradient(135deg, #f7971e, #ffd200);
        box-shadow: 0 4px 15px rgba(247, 151, 30, 0.35);
    }

    .stat-card.info .stat-icon {
        background: linear-gradient(135deg, #2193b0, #6dd5ed);
        box-shadow: 0 4px 15px rgba(33, 147, 176, 0.35);
    }

    .stat-card .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2d3436;
        line-height: 1;
        margin-bottom: 5px;
    }

    .stat-card .stat-label {
        color: #6c757d;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .stat-card .stat-trend {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .stat-card .stat-trend.up {
        background: #d4edda;
        color: #155724;
    }

    .stat-card .stat-trend.down {
        background: #f8d7da;
        color: #721c24;
    }

    /* Section Card */
    .section-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid #eef2f7;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .section-card .section-header {
        padding: 18px 25px;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #f8faff;
    }

    .section-card .section-header h5 {
        margin: 0;
        font-weight: 700;
        color: #2d3436;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-card .section-header h5 i {
        color: #667eea;
    }

    .section-card .section-header .view-all {
        color: #667eea;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.3s ease;
    }

    .section-card .section-header .view-all:hover {
        gap: 8px;
    }

    .section-card .section-body {
        padding: 20px 25px;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 15px;
    }

    .quick-action-btn {
        background: #f8faff;
        border: 2px solid #eef2f7;
        border-radius: 12px;
        padding: 20px 15px;
        text-align: center;
        text-decoration: none;
        color: #2d3436;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .quick-action-btn:hover {
        background: #ffffff;
        border-color: #667eea;
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        color: #667eea;
    }

    .quick-action-btn i {
        font-size: 1.8rem;
        color: #667eea;
        transition: transform 0.3s ease;
    }

    .quick-action-btn:hover i {
        transform: scale(1.15);
    }

    .quick-action-btn span {
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Recent Activity List */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 15px;
        padding: 12px 0;
        border-bottom: 1px solid #f1f3f8;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-item .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }

    .activity-icon.blue { background: #e3f2fd; color: #1976d2; }
    .activity-icon.green { background: #e8f5e9; color: #388e3c; }
    .activity-icon.orange { background: #fff3e0; color: #f57c00; }
    .activity-icon.purple { background: #f3e5f5; color: #7b1fa2; }

    .activity-item .activity-content {
        flex: 1;
    }

    .activity-item .activity-content .activity-title {
        font-weight: 600;
        color: #2d3436;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    .activity-item .activity-content .activity-time {
        font-size: 0.75rem;
        color: #adb5bd;
    }

    /* Progress Bars */
    .progress-item {
        margin-bottom: 18px;
    }

    .progress-item:last-child {
        margin-bottom: 0;
    }

    .progress-item .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #2d3436;
    }

    .progress-item .progress-label .progress-value {
        color: #667eea;
        font-weight: 700;
    }

    .progress-item .progress-bar-custom {
        height: 8px;
        background: #f1f3f8;
        border-radius: 50px;
        overflow: hidden;
    }

    .progress-item .progress-bar-custom .progress-fill {
        height: 100%;
        border-radius: 50px;
        transition: width 1s ease;
    }

    .progress-fill.blue { background: linear-gradient(90deg, #667eea, #764ba2); }
    .progress-fill.green { background: linear-gradient(90deg, #11998e, #38ef7d); }
    .progress-fill.orange { background: linear-gradient(90deg, #f7971e, #ffd200); }
    .progress-fill.pink { background: linear-gradient(90deg, #eb3349, #f45c43); }

    /* Responsive */
    @media (max-width: 991px) {
        .welcome-header {
            padding: 25px;
        }
        .welcome-header h2 {
            font-size: 1.4rem;
        }
        .welcome-header .welcome-icon {
            font-size: 4rem;
            left: 20px;
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }
        .stat-card {
            padding: 18px;
        }
        .stat-card .stat-number {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 767px) {
        .welcome-header {
            padding: 20px;
            text-align: center;
        }
        .welcome-header h2 {
            font-size: 1.2rem;
            justify-content: center;
        }
        .welcome-header .welcome-icon {
            display: none;
        }
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }
        .stat-card .stat-icon {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
        }
        .stat-card .stat-number {
            font-size: 1.4rem;
        }
        .stat-card .stat-label {
            font-size: 0.75rem;
        }
        .quick-actions {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }
        .stat-card {
            padding: 14px;
        }
        .stat-card .stat-number {
            font-size: 1.2rem;
        }
        .stat-card .stat-label {
            font-size: 0.7rem;
        }
        .quick-action-btn {
            padding: 15px 10px;
        }
        .quick-action-btn i {
            font-size: 1.4rem;
        }
        .quick-action-btn span {
            font-size: 0.75rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Welcome Header -->
    <div class="welcome-header">
        <div class="welcome-content">
            <h2>
                <i class="fas fa-hand-sparkles"></i>
                مرحباً بك، {{ Auth::user()->name }}
            </h2>
            <p>
                <i class="fas fa-calendar-alt"></i>
                {{ date('Y-m-d') }} &nbsp;|&nbsp;
                <i class="fas fa-clock"></i>
                {{ date('h:i A') }}
                &nbsp;|&nbsp;
                @if(Auth::user()->department_id)
                    <i class="fas fa-building"></i>
                    {{ Auth::user()->department->name ?? 'غير محدد' }}
                @endif
            </p>
        </div>
        <i class="fas fa-chart-line welcome-icon"></i>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <!-- Total Students -->
        <div class="stat-card primary">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number">{{ $totalStudents ?? 0 }}</div>
            <div class="stat-label">إجمالي الطلاب</div>
        </div>

        <!-- Total Courses -->
        <div class="stat-card success">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number">{{ $totalCourses ?? 0 }}</div>
            <div class="stat-label">إجمالي الدورات</div>
        </div>

        <!-- Total Teachers -->
        <div class="stat-card warning">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> نشط
                </span>
            </div>
            <div class="stat-number">{{ $totalTeachers ?? 0 }}</div>
            <div class="stat-label">المدرسين</div>
        </div>

        <!-- Total Payments -->
        <div class="stat-card info">
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <span class="stat-trend up">
                    <i class="fas fa-arrow-up"></i> مدفوع
                </span>
            </div>
            <div class="stat-number">{{ number_format($totalPayments ?? 0) }}</div>
            <div class="stat-label">إجمالي المدفوعات (ج.م)</div>
        </div>
    </div>

    <!-- Quick Actions & Recent Activity -->
    <div class="row g-3 mb-3">
        <!-- Quick Actions -->
        <div class="col-lg-5">
            <div class="section-card">
                <div class="section-header">
                    <h5>
                        <i class="fas fa-bolt"></i>
                        إجراءات سريعة
                    </h5>
                </div>
                <div class="section-body">
                    <div class="quick-actions">
                        @can('اضافة طالب')
                        <a href="{{ route('student.create') }}" class="quick-action-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>إضافة طالب</span>
                        </a>
                        @endcan

                        @can('اضافة دورة')
                        <a href="{{ url('/courses/create') }}" class="quick-action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>إضافة دورة</span>
                        </a>
                        @endcan

                        @can('بحث بالاسم')
                        <a href="{{ route('students.searchByName') }}" class="quick-action-btn">
                            <i class="fas fa-search"></i>
                            <span>بحث بالاسم</span>
                        </a>
                        @endcan

                        @can('بحث برقم الصفحة')
                        <a href="{{ route('students.search') }}" class="quick-action-btn">
                            <i class="fas fa-file-alt"></i>
                            <span>بحث برقم الصفحة</span>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Students -->
        <div class="col-lg-7">
            <div class="section-card">
                <div class="section-header">
                    <h5>
                        <i class="fas fa-user-clock"></i>
                        أحدث الطلاب المسجلين
                    </h5>
                    <a href="{{ route('student.index') }}" class="view-all">
                        عرض الكل <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="section-body">
                    <ul class="activity-list">
                        @forelse($recentStudents ?? [] as $student)
                            <li class="activity-item">
                                <div class="activity-icon blue">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">{{ $student->fullname }}</div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        {{ $student->created_at ? $student->created_at->diffForHumans() : '—' }}
                                    </div>
                                </div>
                                <a href="{{ route('student.show', $student->id) }}" class="table-action-btn" style="background: linear-gradient(135deg, #667eea, #764ba2); color: #fff; padding: 5px 15px; border-radius: 50px; font-size: 0.75rem; text-decoration: none; font-weight: 600;">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </li>
                        @empty
                            <li style="text-align: center; padding: 30px; color: #adb5bd;">
                                <i class="fas fa-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                لا توجد بيانات حديثة
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Progress & Recent Payments -->
    <div class="row g-3">
        <!-- Statistics Progress -->
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5>
                        <i class="fas fa-chart-pie"></i>
                        إحصائيات عامة
                    </h5>
                </div>
                <div class="section-body">
                    @php
                        $maxValue = max($totalStudents ?? 1, $totalCourses ?? 1, $totalTeachers ?? 1);
                    @endphp

                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fas fa-user-graduate" style="color: #667eea;"></i> الطلاب</span>
                            <span class="progress-value">{{ $totalStudents ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill blue" style="width: {{ $maxValue > 0 ? (($totalStudents ?? 0) / $maxValue) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fas fa-graduation-cap" style="color: #11998e;"></i> الدورات</span>
                            <span class="progress-value" style="color: #11998e;">{{ $totalCourses ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill green" style="width: {{ $maxValue > 0 ? (($totalCourses ?? 0) / $maxValue) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fas fa-chalkboard-teacher" style="color: #f7971e;"></i> المدرسين</span>
                            <span class="progress-value" style="color: #f7971e;">{{ $totalTeachers ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill orange" style="width: {{ $maxValue > 0 ? (($totalTeachers ?? 0) / $maxValue) * 100 : 0 }}%"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span><i class="fas fa-book" style="color: #eb3349;"></i> المواد</span>
                            <span class="progress-value" style="color: #eb3349;">{{ $totalSubjects ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill pink" style="width: {{ $maxValue > 0 ? (($totalSubjects ?? 0) / $maxValue) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Payments -->
        <div class="col-lg-6">
            <div class="section-card">
                <div class="section-header">
                    <h5>
                        <i class="fas fa-money-bill-wave"></i>
                        أحدث المدفوعات
                    </h5>
                </div>
                <div class="section-body">
                    <ul class="activity-list">
                        @forelse($recentPayments ?? [] as $payment)
                            <li class="activity-item">
                                <div class="activity-icon green">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">
                                        {{ number_format($payment->payment_value) }} ج.م
                                        — {{ $payment->student->fullname ?? 'غير معروف' }}
                                    </div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        {{ $payment->created_at ? $payment->created_at->diffForHumans() : '—' }}
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li style="text-align: center; padding: 30px; color: #adb5bd;">
                                <i class="fas fa-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                لا توجد مدفوعات حديثة
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection --}}
@extends('layouts.master')

@section('title', 'الرئيسية')

@section('css')
<style>
    /* ============================================
       PREMIUM DASHBOARD — Design Tokens
       ============================================ */
    :root {
        --brand-1: #6366f1;
        --brand-2: #8b5cf6;
        --brand-3: #a855f7;
        --ink: #0f172a;
        --ink-soft: #475569;
        --ink-mute: #94a3b8;
        --surface: #ffffff;
        --page: #f4f6fb;
        --border: #e8edf5;
        --success: #10b981;
        --warning: #f59e0b;
        --info: #06b6d4;
        --rose: #f43f5e;
        --radius: 20px;
        --shadow-sm: 0 1px 2px rgba(15, 23, 42, .04), 0 4px 14px rgba(15, 23, 42, .05);
        --shadow-md: 0 10px 30px rgba(15, 23, 42, .08);
        --shadow-brand: 0 10px 30px rgba(99, 102, 241, .22);
    }

    /* ============================================
       Page backdrop
       ============================================ */
    .container-fluid {
        position: relative;
    }

    /* ============================================
       Entrance animation (staggered)
       ============================================ */
    @keyframes dashFadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .dash-anim {
        opacity: 0;
        animation: dashFadeUp .55s cubic-bezier(.22, 1, .36, 1) forwards;
    }
    .dash-anim.d1 { animation-delay: .05s; }
    .dash-anim.d2 { animation-delay: .15s; }
    .dash-anim.d3 { animation-delay: .25s; }
    .dash-anim.d4 { animation-delay: .35s; }
    .dash-anim.d5 { animation-delay: .45s; }

    /* ============================================
       Welcome Header — aurora hero
       ============================================ */
    .welcome-header {
        position: relative;
        overflow: hidden;
        border-radius: var(--radius);
        padding: 40px 44px;
        margin-bottom: 26px;
        color: #fff;
        background:
            radial-gradient(600px 220px at 85% -20%, rgba(168, 85, 247, .55), transparent 60%),
            radial-gradient(500px 240px at 10% 110%, rgba(34, 211, 238, .35), transparent 60%),
            linear-gradient(120deg, #312e81 0%, #4f46e5 45%, #7c3aed 100%);
        box-shadow: var(--shadow-brand);
        isolation: isolate;
    }

    /* floating orbs */
    .welcome-header::before,
    .welcome-header::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        z-index: 0;
        pointer-events: none;
    }

    .welcome-header::before {
        width: 340px;
        height: 340px;
        top: -55%;
        inset-inline-end: -8%;
        background: rgba(255, 255, 255, .07);
    }

    .welcome-header::after {
        width: 240px;
        height: 240px;
        bottom: -65%;
        inset-inline-start: -4%;
        background: rgba(255, 255, 255, .05);
    }

    /* subtle grid texture */
    .welcome-header .hero-grid {
        position: absolute;
        inset: 0;
        z-index: 0;
        background-image:
            linear-gradient(rgba(255,255,255,.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,.05) 1px, transparent 1px);
        background-size: 36px 36px;
        mask-image: radial-gradient(ellipse 90% 120% at 70% 0%, #000 30%, transparent 75%);
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
        margin: 0 0 10px;
        font-size: 1.9rem;
        font-weight: 800;
        letter-spacing: -.02em;
        color: #fff;
    }

    .welcome-header h2 .hello-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .22);
        backdrop-filter: blur(6px);
        font-size: 1.15rem;
        animation: waveIcon 2.6s ease-in-out infinite;
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
        color: rgba(255, 255, 255, .85);
    }

    .welcome-header p .chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 5px 13px;
        border-radius: 50px;
        background: rgba(255, 255, 255, .12);
        border: 1px solid rgba(255, 255, 255, .18);
        backdrop-filter: blur(6px);
        font-weight: 500;
    }

    .welcome-header p .sep {
        color: rgba(255, 255, 255, .4);
        margin: 0 4px;
    }

    .welcome-header .welcome-icon {
        position: absolute;
        inset-inline-end: 42px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 6.5rem;
        color: rgba(255, 255, 255, .1);
        z-index: 0;
        transition: transform .5s ease;
    }

    .welcome-header:hover .welcome-icon {
        transform: translateY(-50%) rotate(-6deg) scale(1.06);
    }

    /* ============================================
       Statistics Cards
       ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        gap: 20px;
        margin-bottom: 26px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        padding: 24px;
        box-shadow: var(--shadow-sm);
        transition: transform .35s cubic-bezier(.22, 1, .36, 1), box-shadow .35s ease, border-color .35s ease;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-md);
        border-color: transparent;
    }

    /* soft color wash in corner */
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        inset-inline-end: 0;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        opacity: .09;
        transform: translate(35%, -35%);
        transition: transform .45s ease, opacity .45s ease;
    }

    .stat-card:hover::before {
        transform: translate(25%, -25%) scale(1.25);
        opacity: .14;
    }

    .stat-card.primary::before  { background: var(--brand-1); }
    .stat-card.success::before  { background: var(--success); }
    .stat-card.warning::before  { background: var(--warning); }
    .stat-card.info::before     { background: var(--info); }

    /* top accent line */
    .stat-card::after {
        content: '';
        position: absolute;
        top: 0;
        inset-inline-start: 24px;
        width: 44px;
        height: 4px;
        border-radius: 0 0 6px 6px;
        background: linear-gradient(90deg, var(--brand-1), var(--brand-2));
        opacity: 0;
        transition: opacity .3s ease;
    }

    .stat-card.primary::after  { background: linear-gradient(90deg, #6366f1, #a855f7); }
    .stat-card.success::after  { background: linear-gradient(90deg, #10b981, #34d399); }
    .stat-card.warning::after  { background: linear-gradient(90deg, #f59e0b, #fbbf24); }
    .stat-card.info::after     { background: linear-gradient(90deg, #06b6d4, #22d3ee); }

    .stat-card:hover::after { opacity: 1; }

    .stat-card .stat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }

    .stat-card .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: #fff;
        flex-shrink: 0;
        transition: transform .35s cubic-bezier(.34, 1.56, .64, 1);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(-6deg);
    }

    .stat-card.primary .stat-icon { background: linear-gradient(135deg, #6366f1, #8b5cf6); box-shadow: 0 6px 18px rgba(99, 102, 241, .35); }
    .stat-card.success .stat-icon { background: linear-gradient(135deg, #059669, #34d399); box-shadow: 0 6px 18px rgba(16, 185, 129, .35); }
    .stat-card.warning .stat-icon { background: linear-gradient(135deg, #d97706, #fbbf24); box-shadow: 0 6px 18px rgba(245, 158, 11, .35); }
    .stat-card.info .stat-icon    { background: linear-gradient(135deg, #0891b2, #22d3ee); box-shadow: 0 6px 18px rgba(6, 182, 212, .35); }

    .stat-card .stat-number {
        font-size: 2.1rem;
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -.02em;
        color: var(--ink);
        margin-bottom: 4px;
        font-variant-numeric: tabular-nums;
    }

    .stat-card .stat-label {
        color: var(--ink-mute);
        font-size: .85rem;
        font-weight: 500;
    }

    .stat-card .stat-trend {
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 11px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .stat-card .stat-trend.up {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #d1fae5;
    }

    .stat-card .stat-trend.down {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fee2e2;
    }

    .stat-card .stat-trend i {
        font-size: .6rem;
    }

    /* ============================================
       Section Card
       ============================================ */
    .section-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow-sm);
        overflow: hidden;
        margin-bottom: 24px;
        height: calc(100% - 24px);
        transition: box-shadow .35s ease;
    }

    .section-card:hover {
        box-shadow: var(--shadow-md);
    }

    .section-card .section-header {
        padding: 17px 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
        background:
            linear-gradient(90deg, rgba(99, 102, 241, .05), rgba(139, 92, 246, .03)),
            #fbfbff;
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
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-size: .8rem;
        box-shadow: 0 4px 12px rgba(99, 102, 241, .3);
    }

    .section-card .section-header .view-all {
        color: var(--brand-1);
        font-size: .8rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 14px;
        border-radius: 50px;
        background: rgba(99, 102, 241, .08);
        transition: all .3s ease;
    }

    .section-card .section-header .view-all:hover {
        background: rgba(99, 102, 241, .16);
        gap: 9px;
    }

    .section-card .section-body {
        padding: 18px 24px 22px;
    }

    /* ============================================
       Quick Actions
       ============================================ */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(135px, 1fr));
        gap: 14px;
    }

    .quick-action-btn {
        position: relative;
        overflow: hidden;
        background: #f8faff;
        border: 1.5px solid var(--border);
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

    /* hover fill sweep */
    .quick-action-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(99, 102, 241, .06), rgba(139, 92, 246, .1));
        opacity: 0;
        transition: opacity .35s ease;
    }

    .quick-action-btn:hover {
        border-color: rgba(99, 102, 241, .55);
        transform: translateY(-5px);
        box-shadow: 0 12px 28px rgba(99, 102, 241, .16);
        color: var(--brand-1);
    }

    .quick-action-btn:hover::before {
        opacity: 1;
    }

    .quick-action-btn i {
        position: relative;
        font-size: 1.7rem;
        color: var(--brand-1);
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

    /* ============================================
       Activity List
       ============================================ */
    .activity-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 11px 10px;
        border-bottom: 1px solid #f1f4f9;
        border-radius: 12px;
        transition: background .25s ease;
    }

    .activity-item:hover {
        background: #f8faff;
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

    .activity-icon.blue   { background: #eef2ff; color: #4f46e5; }
    .activity-icon.green  { background: #ecfdf5; color: #059669; }
    .activity-icon.orange { background: #fffbeb; color: #d97706; }
    .activity-icon.purple { background: #faf5ff; color: #9333ea; }

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
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: .74rem;
        text-decoration: none;
        font-weight: 700;
        box-shadow: 0 4px 12px rgba(99, 102, 241, .3);
        transition: all .3s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .activity-view-btn:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, .4);
    }

    /* empty state */
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
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #cbd5e1;
    }

    .empty-state p {
        margin: 0;
        font-size: .88rem;
        font-weight: 500;
    }

    /* ============================================
       Progress Bars
       ============================================ */
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
        background: #eef1f7;
        border-radius: 50px;
        overflow: hidden;
        box-shadow: inset 0 1px 3px rgba(15, 23, 42, .06);
    }

    .progress-item .progress-bar-custom .progress-fill {
        height: 100%;
        width: 0; /* animated by JS */
        border-radius: 50px;
        position: relative;
        transition: width 1.2s cubic-bezier(.22, 1, .36, 1);
    }

    /* moving shine */
    .progress-item .progress-bar-custom .progress-fill::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .45), transparent);
        transform: translateX(-100%);
        animation: shine 2.4s ease-in-out infinite;
    }

    @keyframes shine {
        60%  { transform: translateX(100%); }
        100% { transform: translateX(100%); }
    }

    .progress-fill.blue   { background: linear-gradient(90deg, #6366f1, #a855f7); box-shadow: 0 2px 8px rgba(99, 102, 241, .35); }
    .progress-fill.green  { background: linear-gradient(90deg, #059669, #34d399); box-shadow: 0 2px 8px rgba(16, 185, 129, .35); }
    .progress-fill.orange { background: linear-gradient(90deg, #d97706, #fbbf24); box-shadow: 0 2px 8px rgba(245, 158, 11, .35); }
    .progress-fill.pink   { background: linear-gradient(90deg, #e11d48, #fb7185); box-shadow: 0 2px 8px rgba(244, 63, 94, .35); }

    /* ============================================
       Payment amount highlight
       ============================================ */
    .payment-amount {
        color: #059669;
        font-weight: 800;
        font-variant-numeric: tabular-nums;
    }

    /* ============================================
       Responsive
       ============================================ */
    @media (max-width: 991px) {
        .welcome-header { padding: 28px; }
        .welcome-header h2 { font-size: 1.5rem; }
        .welcome-header .welcome-icon { font-size: 4.2rem; inset-inline-end: 22px; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 15px; }
        .stat-card { padding: 19px; }
        .stat-card .stat-number { font-size: 1.7rem; }
    }

    @media (max-width: 767px) {
        .welcome-header { padding: 24px 20px; text-align: center; }
        .welcome-header h2 { font-size: 1.3rem; justify-content: center; }
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

    /* respect reduced motion */
    @media (prefers-reduced-motion: reduce) {
        .dash-anim, .welcome-header h2 .hello-badge, .progress-fill::after {
            animation: none !important;
        }
        .dash-anim { opacity: 1; }
    }
</style>
@endsection

@section('content')
<div class="container-fluid px-3 px-md-4">

    <!-- Welcome Header -->
    <div class="welcome-header dash-anim d1">
        <div class="hero-grid"></div>
        <div class="welcome-content">
            <h2>
                <span class="hello-badge"><i class="fas fa-hand-sparkles"></i></span>
                مرحباً بك، {{ Auth::user()->name }}
            </h2>
            <p>
                <span class="chip">
                    <i class="fas fa-calendar-alt"></i>
                    {{ date('Y-m-d') }}
                </span>
                <span class="sep">•</span>
                <span class="chip">
                    <i class="fas fa-clock"></i>
                    {{ date('h:i A') }}
                </span>
                @if(Auth::user()->department_id)
                    <span class="sep">•</span>
                    <span class="chip">
                        <i class="fas fa-building"></i>
                        {{ Auth::user()->department->name ?? 'غير محدد' }}
                    </span>
                @endif
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
            <div class="stat-number" data-counter="{{ $totalStudents ?? 0 }}">0</div>
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
            <div class="stat-number" data-counter="{{ $totalCourses ?? 0 }}">0</div>
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
            <div class="stat-number" data-counter="{{ $totalTeachers ?? 0 }}">0</div>
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
            <div class="stat-number" data-counter="{{ $totalPayments ?? 0 }}" data-format="1">0</div>
            <div class="stat-label">إجمالي المدفوعات (ج.م)</div>
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
                        @can('اضافة طالب')
                        <a href="{{ route('student.create') }}" class="quick-action-btn">
                            <i class="fas fa-user-plus"></i>
                            <span>إضافة طالب</span>
                        </a>
                        @endcan

                        @can('اضافة دورة')
                        <a href="{{ url('/courses/create') }}" class="quick-action-btn">
                            <i class="fas fa-plus-circle"></i>
                            <span>إضافة دورة</span>
                        </a>
                        @endcan

                        @can('بحث بالاسم')
                        <a href="{{ route('students.searchByName') }}" class="quick-action-btn">
                            <i class="fas fa-search"></i>
                            <span>بحث بالاسم</span>
                        </a>
                        @endcan

                        @can('بحث برقم الصفحة')
                        <a href="{{ route('students.search') }}" class="quick-action-btn">
                            <i class="fas fa-file-alt"></i>
                            <span>بحث برقم الصفحة</span>
                        </a>
                        @endcan
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
                    <a href="{{ route('student.index') }}" class="view-all">
                        عرض الكل <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
                <div class="section-body">
                    <ul class="activity-list">
                        @forelse($recentStudents ?? [] as $student)
                            <li class="activity-item">
                                <div class="activity-icon blue">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">{{ $student->fullname }}</div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        {{ $student->created_at ? $student->created_at->diffForHumans() : '—' }}
                                    </div>
                                </div>
                                <a href="{{ route('student.show', $student->id) }}" class="activity-view-btn">
                                    <i class="fas fa-eye"></i> عرض
                                </a>
                            </li>
                        @empty
                            <li class="empty-state">
                                <div class="empty-icon"><i class="fas fa-user-graduate"></i></div>
                                <p>لا توجد بيانات حديثة</p>
                            </li>
                        @endforelse
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
                    @php
                        $maxValue = max($totalStudents ?? 1, $totalCourses ?? 1, $totalTeachers ?? 1, $totalSubjects ?? 1);
                        $pct = function ($v) use ($maxValue) {
                            return $maxValue > 0 ? round(($v / $maxValue) * 100, 1) : 0;
                        };
                    @endphp

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-user-graduate" style="color: #6366f1;"></i> الطلاب</span>
                            <span class="progress-value" style="color: #6366f1;">{{ $totalStudents ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill blue" data-width="{{ $pct($totalStudents ?? 0) }}"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-graduation-cap" style="color: #059669;"></i> الدورات</span>
                            <span class="progress-value" style="color: #059669;">{{ $totalCourses ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill green" data-width="{{ $pct($totalCourses ?? 0) }}"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-chalkboard-teacher" style="color: #d97706;"></i> المدرسين</span>
                            <span class="progress-value" style="color: #d97706;">{{ $totalTeachers ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill orange" data-width="{{ $pct($totalTeachers ?? 0) }}"></div>
                        </div>
                    </div>

                    <div class="progress-item">
                        <div class="progress-label">
                            <span class="progress-name"><i class="fas fa-book" style="color: #e11d48;"></i> المواد</span>
                            <span class="progress-value" style="color: #e11d48;">{{ $totalSubjects ?? 0 }}</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill pink" data-width="{{ $pct($totalSubjects ?? 0) }}"></div>
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
                        @forelse($recentPayments ?? [] as $payment)
                            <li class="activity-item">
                                <div class="activity-icon green">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                                <div class="activity-content">
                                    <div class="activity-title">
                                        <span class="payment-amount">{{ number_format($payment->payment_value) }} ج.م</span>
                                        — {{ $payment->student->fullname ?? 'غير معروف' }}
                                    </div>
                                    <div class="activity-time">
                                        <i class="fas fa-clock"></i>
                                        {{ $payment->created_at ? $payment->created_at->diffForHumans() : '—' }}
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="empty-state">
                                <div class="empty-icon"><i class="fas fa-money-bill-wave"></i></div>
                                <p>لا توجد مدفوعات حديثة</p>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('js')
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
@endsection
