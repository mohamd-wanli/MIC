<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center" style="background: #122140; box-shadow: 0 2px 20px rgba(18,33,64,0.25); padding: 0 20px; height: 70px; border-bottom: 3px solid #b9873c;">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center" style="text-decoration: none; gap: 10px;">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="مركز المأمون الدولي" style="height: 38px;">
            <span class="d-none d-lg-block" style="color: #fdfbf6; font-family: 'Markazi Text', 'Tajawal', sans-serif; font-weight: 700; font-size: 1.3rem; letter-spacing: 0.3px;">مركز المأمون الدولي</span>
        </a>
        <!-- Hamburger icon – toggles sidebar via NiceAdmin's built-in mechanism -->
        <i class="bi bi-list toggle-sidebar-btn" id="sidebarToggle" style="color: #e7d2a6; font-size: 1.7rem; cursor: pointer; transition: transform 0.3s ease;"></i>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center" style="list-style: none; margin: 0; padding: 0; gap: 5px;">

            <!-- User Profile Dropdown -->
            <li class="nav-item dropdown pe-3" style="position: relative;">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown"
                   style="text-decoration: none; color: #fdfbf6; padding: 5px 14px 5px 5px; border-radius: 10px; transition: background 0.25s ease; background: rgba(255,255,255,0.06); border: 1px solid rgba(233,210,166,0.2);">
                    <img src="<?php echo e(asset('assets/img/profile-img.jpg')); ?>" alt="Profile" class="rounded-circle"
                         style="width: 36px; height: 36px; object-fit: cover; border: 2px solid #b9873c;">
                    <span class="d-none d-md-block dropdown-toggle ps-2" style="color: #fdfbf6; font-weight: 500; font-size: 0.9rem;">
                        <?php echo e(Auth::user()->name); ?>

                    </span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile"
                    style="border: none; border-radius: 14px; box-shadow: 0 16px 40px rgba(18,33,64,0.18); padding: 10px 0; margin-top: 12px; min-width: 220px; background: #ffffff; border-top: 3px solid #b9873c;">

                    <li class="dropdown-header" style="padding: 15px 20px 10px; text-align: center; border-bottom: 1px solid #ece4d4;">
                        <h6 style="margin: 0; font-weight: 700; color: #122140; font-size: 1rem;"><?php echo e(Auth::user()->name); ?></h6>
                        <span style="font-size: 0.8rem; color: #837d6e;"><?php echo e(Auth::user()->email); ?></span>
                    </li>

                    <li>
                        <hr class="dropdown-divider" style="margin: 8px 20px; border-color: #ece4d4;">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           style="padding: 10px 20px; color: #23262b; transition: background 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
                            <i class="bi bi-person" style="color: #2e6b68; font-size: 1.1rem;"></i>
                            <span>الملف الشخصي</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#"
                           style="padding: 10px 20px; color: #23262b; transition: background 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
                            <i class="bi bi-gear" style="color: #2e6b68; font-size: 1.1rem;"></i>
                            <span>الإعدادات</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider" style="margin: 8px 20px; border-color: #ece4d4;">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           style="padding: 10px 20px; color: #a53b3b; transition: background 0.2s ease; font-size: 0.9rem; gap: 10px; border-radius: 8px; margin: 0 8px;">
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
    /* Profile pill hover */
    .nav-profile:hover {
        background: rgba(255,255,255,0.12) !important;
    }

    /* Hover effects for dropdown items */
    .dropdown-item:hover {
        background: #faf6ee !important;
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
        box-shadow: -2px -2px 5px rgba(18,33,64,0.06);
    }

    /* Hamburger hover */
    #sidebarToggle:hover {
        transform: rotate(90deg);
        color: #ffffff !important;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .header {
            padding: 0 15px !important;
        }
        .logo span {
            font-size: 1.05rem !important;
        }
    }

    @media (max-width: 767px) {
        .header {
            height: 60px !important;
            padding: 0 10px !important;
        }
        .logo img {
            height: 30px !important;
        }
        .logo span {
            font-size: 0.9rem !important;
        }
        .nav-profile .dropdown-toggle {
            display: none !important;
        }
        .nav-profile {
            padding: 5px !important;
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
<?php /**PATH C:\Users\wanli\Desktop\mic\resources\views\layouts\header.blade.php ENDPATH**/ ?>