<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title> مركز المأمون الدولي</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('images/logo.png') }}" rel="icon" type="image/png">
<link href="{{ asset('images/logo.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

    <style>
        /* ============================================
           CUSTOM LOGIN PAGE STYLES
           ============================================ */

        .login-container {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 40px 35px;
            max-width: 450px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.35);
        }

        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-logo img {
            max-width: 120px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 12px;
        }

        .login-logo h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2d3436;
            margin: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-logo .subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            margin-top: 5px;
            -webkit-text-fill-color: #6c757d;
        }

        .login-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #667eea, transparent);
            margin: 20px 0;
        }

        .form-label {
            font-weight: 600;
            color: #2d3436;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 10px !important;
            border: 2px solid #e8edf5 !important;
            padding: 10px 15px !important;
            font-size: 0.95rem !important;
            transition: all 0.3s ease !important;
            height: 45px !important;
        }

        .form-control:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.12) !important;
        }

        .input-group {
            position: relative;
        }

        .input-group .form-control {
            padding-right: 45px !important;
        }

        .input-group .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #adb5bd;
            z-index: 10;
            font-size: 1.1rem;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            border: none;
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.35);
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(102, 126, 234, 0.45);
            color: #ffffff;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .form-check-label {
            color: #2d3436;
            font-size: 0.9rem;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .invalid-feedback {
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* Alert Styles */
        .alert-custom {
            border-radius: 12px;
            padding: 12px 18px;
            border: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .alert-custom i {
            font-size: 1.2rem;
        }

        .alert-custom.alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-right: 4px solid #dc3545;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .login-card {
                padding: 25px 20px;
            }
            .login-logo h1 {
                font-size: 1.4rem;
            }
            .login-logo img {
                max-width: 90px;
            }
            .form-control {
                height: 42px !important;
                font-size: 0.9rem !important;
            }
            .btn-login {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-card">

            <!-- Logo Section -->
            <div class="login-logo">
                <img src="{{ asset('images/logo.png') }}" alt="مركز المأمون الدولي">
                <h1>مركز المأمون الدولي</h1>
                <div class="subtitle">نظام إدارة الطلاب والدورات</div>
            </div>

            <div class="login-divider"></div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert-custom alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <div>
                        @foreach ($errors->all() as $error)
                            <div style="font-size: 0.85rem;">• {{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="alert-custom alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    <strong>{{ session('error') }}</strong>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope" style="color: #667eea;"></i>
                        البريد الإلكتروني
                    </label>
                    <div class="input-group has-validation">
                        <i class="bi bi-envelope input-icon"></i>
                        <input id="email" type="email"
                               class="form-control @error('email') is-invalid @enderror"
                               name="email"
                               value="{{ old('email') }}"
                               required autocomplete="email" autofocus
                               placeholder="أدخل بريدك الإلكتروني">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock" style="color: #667eea;"></i>
                        كلمة السر
                    </label>
                    <div class="input-group has-validation">
                        <i class="bi bi-lock input-icon"></i>
                        <input id="password" type="password"
                               class="form-control @error('password') is-invalid @enderror"
                               name="password"
                               required autocomplete="current-password"
                               placeholder="أدخل كلمة السر">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            تذكرني
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            هل نسيت كلمة السر؟
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>
                    تسجيل الدخول
                </button>

            </form>

            <div class="text-center mt-3" style="font-size: 0.8rem; color: #adb5bd;">
                <i class="bi bi-shield-check"></i>
                نظام آمن ومشفر
            </div>

        </div>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
