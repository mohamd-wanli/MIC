{{-- <!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>مركز المأمون الدولي</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('images/logo.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --auth-bg-1: #f5f7ff;
            --auth-bg-2: #eef8ff;
            --primary: #1d4ed8;
            --primary-strong: #123eb8;
            --primary-soft: #dbeafe;
            --accent: #14b8a6;
            --text: #1f2937;
            --muted: #6b7280;
            --card: rgba(255, 255, 255, 0.9);
            --line: #e5e7eb;
            --danger: #dc2626;
            --danger-soft: #fee2e2;
            --shadow: 0 18px 45px rgba(15, 23, 42, 0.12);
        }

        body {
            margin: 0;
            font-family: 'Poppins', 'Open Sans', sans-serif;
            background:
                radial-gradient(circle at top right, rgba(29, 78, 216, 0.18), transparent 30%),
                radial-gradient(circle at bottom left, rgba(20, 184, 166, 0.18), transparent 25%),
                linear-gradient(135deg, var(--auth-bg-1), var(--auth-bg-2));
            min-height: 100vh;
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            align-items: center;
            padding: 32px;
        }

        .auth-panel {
            min-height: 720px;
            border-radius: 28px;
            box-shadow: var(--shadow);
        }

        .auth-panel--brand {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0a1f59 0%, #1d4ed8 48%, #0ea5a4 100%);
            padding: 52px 42px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
        }

        .auth-panel--brand::before,
        .auth-panel--brand::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
        }

        .auth-panel--brand::before {
            width: 320px;
            height: 320px;
            top: -90px;
            right: -60px;
        }

        .auth-panel--brand::after {
            width: 420px;
            height: 420px;
            left: -120px;
            bottom: -130px;
        }

        .brand-content {
            position: relative;
            z-index: 1;
            max-width: 520px;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255,255,255,0.2);
            padding: 10px 16px;
            border-radius: 999px;
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
        }

        .brand-logo {
            width: 78px;
            height: 78px;
            object-fit: cover;
            border-radius: 20px;
            background: rgba(255,255,255,0.12);
            padding: 10px;
            margin-bottom: 24px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
        }

        .brand-content h2 {
            font-size: clamp(2rem, 3vw, 3rem);
            font-weight: 800;
            margin: 0 0 14px;
            line-height: 1.2;
        }

        .brand-content p {
            font-size: 1.05rem;
            color: rgba(255,255,255,0.82);
            line-height: 1.8;
            margin-bottom: 28px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: grid;
            gap: 14px;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 14px;
            padding: 12px 14px;
            font-weight: 600;
        }

        .feature-list i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 12px;
            background: rgba(255,255,255,0.12);
            font-size: 1.1rem;
        }

        .auth-panel--form {
            background: rgba(255,255,255,0.88);
            backdrop-filter: blur(10px);
            padding: 44px 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 28px;
            border: 1px solid rgba(148, 163, 184, 0.18);
        }

        .login-card {
            width: 100%;
            max-width: 430px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 26px;
        }

        .login-logo img {
            width: 88px;
            height: 88px;
            object-fit: cover;
            border-radius: 24px;
            background: linear-gradient(135deg, #e0ecff, #dffaf7);
            padding: 10px;
            box-shadow: 0 12px 30px rgba(29, 78, 216, 0.12);
            margin-bottom: 14px;
        }

        .login-logo h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 800;
            color: var(--text);
        }

        .login-logo .subtitle {
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.95rem;
        }

        .login-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--line), transparent);
            margin: 22px 0 26px;
        }

        .form-label {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 8px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            z-index: 2;
            font-size: 1.1rem;
        }

        .form-control {
            width: 100%;
            height: 52px !important;
            border-radius: 14px !important;
            border: 1.5px solid var(--line) !important;
            background: #fff;
            padding: 0 44px 0 16px !important;
            font-size: 0.96rem !important;
            transition: 0.2s ease;
            color: var(--text);
        }

        .form-control:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 5px rgba(29, 78, 216, 0.10) !important;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border-radius: 6px;
            border: 1.5px solid #cbd5e1;
            transform: translateY(-1px);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label,
        .forgot-password {
            font-size: 0.88rem;
            color: var(--muted);
            font-weight: 600;
        }

        .forgot-password {
            text-decoration: none;
            color: var(--primary);
        }

        .forgot-password:hover {
            color: var(--primary-strong);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            cursor: pointer;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-strong));
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            padding: 14px 20px;
            box-shadow: 0 14px 24px rgba(29, 78, 216, 0.22);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 30px rgba(29, 78, 216, 0.28);
        }

        .alert-custom {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-radius: 14px;
            padding: 12px 14px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            font-size: 0.9rem;
        }

        .alert-custom i {
            margin-top: 2px;
        }

        .alert-custom.alert-danger {
            background: var(--danger-soft);
            border-color: rgba(220, 38, 38, 0.18);
            color: #991b1b;
        }

        .secure-note {
            margin-top: 20px;
            text-align: center;
            color: #94a3b8;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .invalid-feedback {
            display: block;
            margin-top: 7px;
            font-size: 0.8rem;
            color: var(--danger);
        }

        @media (max-width: 980px) {
            .auth-shell {
                grid-template-columns: 1fr;
                padding: 18px;
            }

            .auth-panel {
                min-height: auto;
            }

            .auth-panel--brand {
                min-height: 300px;
                padding: 30px 24px;
            }

            .auth-panel--form {
                padding: 24px 18px;
            }
        }

        @media (max-width: 576px) {
            .auth-shell {
                padding: 12px;
            }

            .login-logo h1 {
                font-size: 1.6rem;
            }

            .brand-content h2 {
                font-size: 1.8rem;
            }

            .feature-list li {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="auth-panel auth-panel--brand">
            <div class="brand-content">
                <div class="brand-badge">
                    <i class="bi bi-shield-check"></i>
                    منصة تعليمية متكاملة
                </div>
                <img src="{{ asset('images/logo.png') }}" alt="مركز المأمون الدولي" class="brand-logo" />
                <h2>نظام إدارة الطلاب والدورات</h2>
                <p>تابع الدورات، الطلاب، التقييمات، المدفوعات، والطلبات من واجهة واحدة مصممة لتسهيل الإدارة اليومية.</p>

                <ul class="feature-list">
                    <li><i class="bi bi-people-fill"></i> إدارة الطلاب والملفات الشخصية</li>
                    <li><i class="bi bi-journal-bookmark-fill"></i> متابعة الدورات والجلسات</li>
                    <li><i class="bi bi-currency-dollar"></i> تقارير المدفوعات والفواتير</li>
                    <li><i class="bi bi-graph-up-arrow"></i> تقارير وشهادات دقيقة</li>
                </ul>
            </div>
        </div>

        <div class="auth-panel auth-panel--form">
            <div class="login-card">
                <div class="login-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="مركز المأمون الدولي">
                    <h1>تسجيل الدخول</h1>
                    <div class="subtitle">مرحباً بعودتك إلى لوحة التحكم</div>
                </div>

                <div class="login-divider"></div>

                @if ($errors->any())
                    <div class="alert-custom alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>• {{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-custom alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope" style="color: var(--primary); margin-left: 6px;"></i>
                            البريد الإلكتروني
                        </label>
                        <div class="input-group">
                            <i class="bi bi-envelope input-icon"></i>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required autocomplete="email" autofocus
                                   placeholder="أدخل بريدك الإلكتروني">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock" style="color: var(--primary); margin-left: 6px;"></i>
                            كلمة السر
                        </label>
                        <div class="input-group">
                            <i class="bi bi-lock input-icon"></i>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required autocomplete="current-password"
                                   placeholder="أدخل كلمة السر">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">تذكرني</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">هل نسيت كلمة السر؟</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="bi bi-box-arrow-in-right" style="margin-left: 8px;"></i>
                        تسجيل الدخول
                    </button>
                </form>

                <div class="secure-note">
                    <i class="bi bi-shield-check" style="margin-left: 6px;"></i>نظام آمن ومشفر
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html> --}}
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>مركز المأمون الدولي</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/png">
    <link href="{{ asset('images/logo.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Markazi+Text:wght@500;600;700&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --ink: #122140;
            --ink-soft: #1c3159;
            --gold: #b9873c;
            --gold-soft: #e7d2a6;
            --teal: #2e6b68;
            --parchment: #faf6ee;
            --parchment-deep: #f2ead9;
            --text: #23262b;
            --muted: #767267;
            --line: #e6ded0;
            --danger: #a53b3b;
            --danger-soft: #f6e6e2;
            --shadow: 0 24px 60px -20px rgba(18, 33, 64, 0.35);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Tajawal', 'Open Sans', sans-serif;
            background: var(--parchment);
            min-height: 100vh;
            color: var(--text);
        }

        .auth-shell {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            align-items: stretch;
        }

        /* ---------- Brand panel ---------- */

        .auth-panel--brand {
            position: relative;
            overflow: hidden;
            background: var(--ink);
            padding: 64px 56px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fdfbf6;
        }

        .auth-panel--brand::before {
            content: "";
            position: absolute;
            inset: 0;
            opacity: 0.5;
            background-image:
                repeating-linear-gradient(45deg, rgba(185, 135, 60, 0.10) 0, rgba(185, 135, 60, 0.10) 1px, transparent 1px, transparent 46px),
                repeating-linear-gradient(-45deg, rgba(185, 135, 60, 0.10) 0, rgba(185, 135, 60, 0.10) 1px, transparent 1px, transparent 46px);
            pointer-events: none;
        }

        .auth-panel--brand::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(18, 33, 64, 0.15), var(--ink) 92%);
            pointer-events: none;
        }

        .brand-content {
            position: relative;
            z-index: 1;
            max-width: 460px;
            animation: rise 0.6s ease-out;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--gold-soft);
            font-weight: 700;
            font-size: 0.92rem;
            padding-bottom: 18px;
        }

        .brand-eyebrow i {
            color: var(--gold);
            font-size: 1.05rem;
        }

        .brand-logo {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.06);
            padding: 8px;
            margin-bottom: 26px;
            border: 1px solid rgba(233, 210, 166, 0.25);
        }

        .brand-content h2 {
            font-family: 'Markazi Text', 'Tajawal', sans-serif;
            font-size: clamp(2.2rem, 3vw, 3rem);
            font-weight: 700;
            margin: 0 0 16px;
            line-height: 1.25;
        }

        .brand-rule {
            width: 64px;
            height: 3px;
            background: var(--gold);
            border-radius: 2px;
            margin-bottom: 20px;
        }

        .brand-content p {
            font-size: 1.02rem;
            color: rgba(253, 251, 246, 0.72);
            line-height: 1.9;
            margin-bottom: 34px;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 0;
            border-top: 1px solid rgba(233, 210, 166, 0.16);
            font-weight: 500;
            font-size: 0.98rem;
            color: rgba(253, 251, 246, 0.9);
        }

        .feature-list li:last-child {
            border-bottom: 1px solid rgba(233, 210, 166, 0.16);
        }

        .feature-list i {
            color: var(--gold);
            font-size: 1.15rem;
            width: 22px;
            text-align: center;
        }

        /* ---------- Form panel ---------- */

        .auth-panel--form {
            background: var(--parchment);
            padding: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
        }

        .login-logo {
            margin-bottom: 34px;
        }

        .login-logo h1 {
            margin: 0;
            font-family: 'Markazi Text', 'Tajawal', sans-serif;
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--ink);
        }

        .login-logo .subtitle {
            margin-top: 6px;
            color: var(--muted);
            font-size: 0.96rem;
        }

        .form-label {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 10px;
            display: block;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 4px;
            top: 14px;
            color: var(--teal);
            z-index: 2;
            font-size: 1.05rem;
        }

        .form-control {
            width: 100%;
            height: 46px !important;
            border-radius: 0 !important;
            border: none !important;
            border-bottom: 1.5px solid var(--line) !important;
            background: transparent !important;
            padding: 0 30px 0 4px !important;
            font-size: 0.98rem !important;
            transition: border-color 0.2s ease;
            color: var(--text);
        }

        .form-control:focus {
            border-bottom-color: var(--teal) !important;
            box-shadow: none !important;
        }

        .form-control::placeholder {
            color: #b7b1a2;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0;
        }

        .form-check-input {
            width: 17px;
            height: 17px;
            border-radius: 4px;
            border: 1.5px solid #cfc7b3;
        }

        .form-check-input:checked {
            background-color: var(--teal);
            border-color: var(--teal);
        }

        .form-check-label,
        .forgot-password {
            font-size: 0.87rem;
            color: var(--muted);
            font-weight: 500;
        }

        .forgot-password {
            text-decoration: none;
            color: var(--teal);
            font-weight: 700;
        }

        .forgot-password:hover {
            color: var(--ink);
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            background: var(--ink);
            color: #fdfbf6;
            font-weight: 700;
            font-size: 1rem;
            padding: 14px 20px;
            box-shadow: var(--shadow);
            transition: background 0.2s ease;
            border-bottom: 3px solid var(--gold);
        }

        .btn-login:hover {
            background: var(--ink-soft);
        }

        .alert-custom {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            border-radius: 6px;
            padding: 12px 14px;
            margin-bottom: 24px;
            border-right: 3px solid var(--danger);
            font-size: 0.89rem;
        }

        .alert-custom.alert-danger {
            background: var(--danger-soft);
            color: #7a2c2c;
        }

        .secure-note {
            margin-top: 26px;
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .secure-note i {
            color: var(--teal);
        }

        .invalid-feedback {
            display: block;
            margin-top: 7px;
            font-size: 0.8rem;
            color: var(--danger);
        }

        @media (max-width: 980px) {
            .auth-shell {
                grid-template-columns: 1fr;
            }

            .auth-panel--brand {
                padding: 40px 28px;
            }

            .auth-panel--form {
                padding: 32px 24px;
            }

            .feature-list {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .login-logo h1 {
                font-size: 1.9rem;
            }

            .brand-content h2 {
                font-size: 1.9rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .brand-content {
                animation: none;
            }
        }
    </style>
</head>

<body>
    <div class="auth-shell">
        <div class="auth-panel auth-panel--brand">
            <div class="brand-content">
                <div class="brand-eyebrow">
                    <i class="bi bi-shield-check"></i>
                    منصة تعليمية متكاملة
                </div>
                <img src="{{ asset('images/logo.png') }}" alt="مركز المأمون الدولي" class="brand-logo" />
                <h2>نظام إدارة الطلاب والدورات</h2>
                <div class="brand-rule"></div>
                <p>تابع الدورات، الطلاب، التقييمات، المدفوعات، والطلبات من واجهة واحدة مصممة لتسهيل الإدارة اليومية.</p>

                <ul class="feature-list">
                    <li><i class="bi bi-people-fill"></i> إدارة الطلاب والملفات الشخصية</li>
                    <li><i class="bi bi-journal-bookmark-fill"></i> متابعة الدورات والجلسات</li>
                    <li><i class="bi bi-currency-dollar"></i> تقارير المدفوعات والفواتير</li>
                    <li><i class="bi bi-graph-up-arrow"></i> تقارير وشهادات دقيقة</li>
                </ul>
            </div>
        </div>

        <div class="auth-panel auth-panel--form">
            <div class="login-card">
                <div class="login-logo">
                    <h1>تسجيل الدخول</h1>
                    <div class="subtitle">مرحباً بعودتك إلى لوحة التحكم</div>
                </div>

                @if ($errors->any())
                    <div class="alert-custom alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert-custom alert-danger">
                        <i class="bi bi-exclamation-triangle-fill"></i>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">البريد الإلكتروني</label>
                        <div class="input-group">
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required autocomplete="email" autofocus
                                   placeholder="name@example.com">
                            <i class="bi bi-envelope input-icon"></i>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">كلمة السر</label>
                        <div class="input-group">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password"
                                   required autocomplete="current-password"
                                   placeholder="••••••••">
                            <i class="bi bi-lock input-icon"></i>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">تذكرني</label>
                        </div>

                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">هل نسيت كلمة السر؟</a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        تسجيل الدخول
                    </button>
                </form>

                <div class="secure-note">
                    <i class="bi bi-shield-check"></i>نظام آمن ومشفر
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
