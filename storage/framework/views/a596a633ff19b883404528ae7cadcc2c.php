<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); box-shadow: 0 2px 20px rgba(0,0,0,0.15); padding: 0 20px; height: 70px;">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center" style="text-decoration: none; gap: 10px;">
            <!-- Logo from images folder -->
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="مركز المأمون الدولي" style="height: 40px; filter: brightness(0) invert(1);">
            <span class="d-none d-lg-block" style="color: #ffffff; font-weight: 700; font-size: 1.2rem; letter-spacing: 0.5px;">مركز المأمون الدولي</span>
        </a>
        <!-- Hamburger icon – toggles sidebar via NiceAdmin's built-in mechanism -->
        <i class="bi bi-list toggle-sidebar-btn" id="sidebarToggle" style="color: #ffffff; font-size: 1.8rem; cursor: pointer; transition: transform 0.3s ease;"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center" style="list-style: none; margin: 0; padding: 0; gap: 5px;">

            <!-- User Profile Dropdown -->
            <li class="nav-item dropdown pe-3" style="position: relative;">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                   style="text-decoration: none; color: #ffffff; padding: 6px 15px 6px 6px; border-radius: 50px; transition: all 0.3s ease; background: rgba(255,255,255,0.1);">
                    <!-- Use a default profile image; you can also use logo here if you prefer -->
                    <img src="<?php echo e(asset('assets/img/profile-img.jpg')); ?>" alt="Profile" class="rounded-circle"
                         style="width: 38px; height: 38px; object-fit: cover; border: 2px solid rgba(255,255,255,0.3);">
                    <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #ffffff; font-weight: 500; font-size: 0.9rem;">
                        <?php echo e(Auth::user()->name); ?>

                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                    style="border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.15); padding: 10px 0; margin-top: 10px; min-width: 220px; background: #ffffff;">

                    <li class="dropdown-header" style="padding: 15px 20px 10px; text-align: center; border-bottom: 1px solid #f1f3f8;">
                        <h6 style="margin: 0; font-weight: 700; color: #2d3436; font-size: 1rem;"><?php echo e(Auth::user()->name); ?></h6>
                        <span style="font-size: 0.8rem; color: #6c757d;"><?php echo e(Auth::user()->email); ?></span>
                    </li>

                    <li>
                        <hr class="dropdown-divider" style="margin: 8px 20px;">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           style="padding: 10px 20px; color: #2d3436; transition: all 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
                            <i class="bi bi-person" style="color: #667eea; font-size: 1.1rem;"></i>
                            <span>الملف الشخصي</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           style="padding: 10px 20px; color: #2d3436; transition: all 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
                            <i class="bi bi-gear" style="color: #667eea; font-size: 1.1rem;"></i>
                            <span>الإعدادات</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider" style="margin: 8px 20px;">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           style="padding: 10px 20px; color: #dc3545; transition: all 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
                            <i class="bi bi-box-arrow-right" style="font-size: 1.1rem;"></i>
                            <span>تسجيل خروج</span>
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav>

</header><!-- End Header -->

<style>
    /* Hover effects for dropdown items */
    .dropdown-item:hover {
        background: #f8faff !important;
        transform: translateX(-5px);
    }

    .dropdown-item i {
        transition: transform 0.2s ease;
    }

    .dropdown-item:hover i {
        transform: scale(1.1);
    }

    /* Profile dropdown arrow */
    .dropdown-menu-arrow::before {
        content: '';
        position: absolute;
        top: -8px;
        right: 20px;
        width: 16px;
        height: 16px;
        background: #ffffff;
        transform: rotate(45deg);
        border-radius: 2px;
        box-shadow: -2px -2px 5px rgba(0,0,0,0.04);
    }

    /* Hamburger hover */
    #sidebarToggle:hover {
        transform: rotate(90deg);
    }

    /* Responsive */
    @media (max-width: 991px) {
        .header {
            padding: 0 15px !important;
        }
        .logo span {
            font-size: 1rem !important;
        }
    }

    @media (max-width: 767px) {
        .header {
            height: 60px !important;
            padding: 0 10px !important;
        }
        .logo img {
            height: 32px !important;
        }
        .logo span {
            font-size: 0.9rem !important;
        }
        .nav-profile .dropdown-toggle {
            display: none !important;
        }
        .nav-profile {
            padding: 6px !important;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the hamburger button
        var toggleBtn = document.getElementById('sidebarToggle');
        // The sidebar is already toggled by NiceAdmin via the class "toggle-sidebar-btn"
        // We just need to trigger the same mechanism.
        // In NiceAdmin, the sidebar toggle is usually handled by a click on .toggle-sidebar-btn
        // which toggles a class on the body. We'll simply simulate a click on the existing toggle element.
        // But to avoid conflict, we'll use the same method: toggle a class on the body.
        var body = document.body;

        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            // Toggle the 'toggle-sidebar' class on the body (NiceAdmin's default)
            body.classList.toggle('toggle-sidebar');
        });
    });
</script>
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views/layouts/header.blade.php ENDPATH**/ ?>