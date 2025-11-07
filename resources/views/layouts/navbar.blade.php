<style>
    /* ========================================
       NAVBAR DESIGN SYSTEM - Professional Education Theme
       ======================================== */


      @import url('https://fonts.googleapis.com/css2?family=Delius+Swash+Caps&family=Metal+Mania&family=Playwrite+DE+Grund:wght@100..400&display=swap');


    :root {
        /* Consistent with dashboard color system */
        --primary-50: #f0f9ff;
        --primary-100: #e0f2fe;
        --primary-500: #0ea5e9;
        --primary-600: #0284c7;
        --primary-700: #0369a1;
        --primary-800: #075985;

        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;

        --white: #ffffff;
        --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);

        --radius-sm: 0.375rem;
        --radius-md: 0.5rem;
        --radius-lg: 0.75rem;
        --radius-xl: 1rem;

        --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        --font-family-2 : "Metal Mania", system-ui;
    }

    /* Import Inter font for consistency */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    /* ========================================
       NAVBAR BASE STYLES
       ======================================== */
    .professional-navbar {
        background: var(--white);
        border-bottom: 1px solid var(--gray-200);
        box-shadow: var(--shadow-sm);
        padding: 0;
        position: sticky;
        top: 0;
        z-index: 1030;
        backdrop-filter: blur(8px);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .professional-navbar.scrolled {
        box-shadow: var(--shadow-md);
        border-bottom-color: var(--gray-300);
    }

    .navbar-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    /* ========================================
       BRAND SECTION
       ======================================== */
    .navbar-brand-section {
        display: flex;
        align-items: center;
        padding: 1rem 0;
    }

    .brand-logo {
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.2s ease;
        padding: 0.5rem 0.75rem;
        border-radius: var(--radius-lg);
    }

    .brand-logo:hover {
        background: var(--gray-50);
        transform: translateY(-1px);
    }

    .brand-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 0.75rem;
        color: var(--white);
        font-size: 1.25rem;
        box-shadow: var(--shadow-sm);
    }

    .brand-text {
        font-family: var(--font-family);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin: 0;
        letter-spacing: -0.025em;
    }

    /* ========================================
       NAVIGATION MENU
       ======================================== */
    .navbar-nav {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .nav-item {
        position: relative;
        margin: 0 0.5rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.5rem;
        color: var(--gray-700);
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        border-radius: var(--radius-md);
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        white-space: nowrap;
    }

    .nav-link::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--primary-50), var(--primary-100));
        opacity: 0;
        transition: opacity 0.2s ease;
        z-index: -1;
    }

    .nav-link:hover::before {
        opacity: 1;
    }

    .nav-link:hover {
        color: var(--primary-700);
        background: transparent;
        transform: translateY(-1px);
    }

    .nav-link.active {
        color: var(--primary-700);
        background: var(--primary-50);
        font-weight: 600;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 24px;
        height: 2px;
        background: var(--primary-600);
        border-radius: 1px;
    }

    .nav-link i {
        font-size: 1rem;
        color: var(--gray-500);
        transition: color 0.2s ease;
    }

    .nav-link:hover i,
    .nav-link.active i {
        color: var(--primary-600);
    }

    /* ========================================
       DROPDOWN MENUS
       ======================================== */
    .dropdown-toggle::after {
        display: none !important;
    }

    .nav-link.dropdown-toggle {
        position: relative;
    }

    .nav-link.dropdown-toggle::after {
        content: '\f107';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.75rem;
        color: var(--gray-400);
        margin-left: 0.5rem;
        transition: transform 0.2s ease;
        display: inline-block !important;
        border: none;
    }

    .nav-link.dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

    .dropdown-menu {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        padding: 0.5rem;
        margin-top: 0.5rem;
        min-width: 200px;
        animation: dropdownFadeIn 0.2s ease;
    }

    @keyframes dropdownFadeIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.5rem;
        color: var(--gray-700);
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        border-radius: var(--radius-md);
        transition: all 0.2s ease;
        margin-bottom: 0.25rem;
        white-space: nowrap;
    }

    .dropdown-item:last-child {
        margin-bottom: 0;
    }

    .dropdown-item:hover {
        background: var(--gray-50);
        color: var(--gray-900);
        transform: translateX(2px);
    }

    .dropdown-item i {
        width: 16px;
        text-align: center;
        color: var(--gray-500);
        font-size: 0.875rem;
    }

    .dropdown-item:hover i {
        color: var(--primary-600);
    }

    .dropdown-divider {
        height: 1px;
        background: var(--gray-200);
        margin: 0.5rem 0;
        border: none;
    }

    /* ========================================
       USER PROFILE SECTION
       ======================================== */
    .user-section {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-left: auto;
    }

    .user-profile {
        position: relative;
    }

    .user-button {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 1.25rem;
        background: var(--gray-50);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-xl);
        color: var(--gray-700);
        text-decoration: none;
        font-weight: 500;
        font-size: 1rem;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        min-width: 180px;
    }

    .user-button:hover {
        background: var(--white);
        border-color: var(--gray-300);
        box-shadow: var(--shadow-sm);
        color: var(--gray-900);
        transform: translateY(-1px);
    }

    .user-button.show {
        background: var(--white);
        border-color: var(--primary-300);
        box-shadow: var(--shadow-sm);
    }

    .user-avatar {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 0.875rem;
        font-weight: 600;
        flex-shrink: 0;
    }

    .user-info {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        font-weight: 600;
        color: var(--gray-900);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.2;
    }

    .user-role {
        font-size: 0.75rem;
        color: var(--gray-500);
        text-transform: capitalize;
        letter-spacing: 0.025em;
        font-weight: 500;
    }

    .user-button.dropdown-toggle::after {
        content: '\f107';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.75rem;
        color: var(--gray-400);
        transition: transform 0.2s ease;
        border: none;
        margin-left: auto;
    }

    .user-button.dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

    /* ========================================
       MOBILE RESPONSIVE
       ======================================== */
    .navbar-toggler {
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-md);
        padding: 0.5rem;
        background: var(--white);
        transition: all 0.2s ease;
    }

    .navbar-toggler:hover {
        background: var(--gray-50);
        border-color: var(--gray-400);
    }

    .navbar-toggler:focus {
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        outline: none;
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%2871, 85, 105, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }

    @media (max-width: 991.98px) {
        .navbar-container {
            padding: 0 1rem;
        }

        .navbar-collapse {
            background: var(--white);
            border-top: 1px solid var(--gray-200);
            margin-top: 1rem;
            padding-top: 1rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
        }

        .navbar-nav {
            flex-direction: column;
            align-items: stretch;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .nav-link {
            padding: 1rem;
            justify-content: flex-start;
        }

        .user-section {
            margin-left: 0;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .user-button {
            width: 100%;
            justify-content: flex-start;
        }
    }

    /* ========================================
       UTILITY CLASSES
       ======================================== */
    .text-danger {
        color: var(--danger-600) !important;
    }

    .text-danger:hover {
        color: var(--danger-700) !important;
    }

    /* ========================================
       ACCESSIBILITY ENHANCEMENTS
       ======================================== */
    .nav-link:focus,
    .dropdown-item:focus,
    .user-button:focus {
        outline: 2px solid var(--primary-500);
        outline-offset: 2px;
    }

    /* ========================================
       LOADING STATES
       ======================================== */
    .nav-link.loading {
        pointer-events: none;
        opacity: 0.6;
    }

    .nav-link.loading::after {
        content: '';
        width: 12px;
        height: 12px;
        border: 2px solid var(--gray-300);
        border-top: 2px solid var(--primary-600);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-left: 0.5rem;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* ========================================
       NOTIFICATION BADGE
       ======================================== */
    .nav-badge {
        position: absolute;
        top: 0.25rem;
        right: 0.25rem;
        background: var(--danger-500);
        color: var(--white);
        font-size: 0.625rem;
        font-weight: 600;
        padding: 0.125rem 0.375rem;
        border-radius: 0.75rem;
        min-width: 1.25rem;
        text-align: center;
        line-height: 1;
    }
</style>

<nav class="navbar navbar-expand-lg professional-navbar" id="mainNavbar">
    <div class="container-fluid navbar-container">
        <!-- Brand Section -->
        <div class="navbar-brand-section">
            <a class="brand-logo"
                href="{{ Auth::guard('teacher')->check() ? route('teacher.dashboard') : (Auth::guard('student')->check() ? route('student.dashboard') : '/') }}">
                <div class="brand-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="brand-text" style="font-family : Delius Swash Caps, cursive;letter-spacing : 1px;" >Lynq</h1>
            </a>
        </div>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Content -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Navigation Menu -->
            @if (Auth::guard('teacher')->check())
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}"
                            href="{{ route('teacher.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teacher.classroom.*') ? 'active' : '' }}"
                            href="{{ route('teacher.classroom.setup') }}">
                            <i class="fas fa-school"></i>
                            <span>Classrooms</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('teacher.formBuilder') ? 'active' : '' }}"
                            href="{{ route('teacher.formBuilder') }}">
                            <i class="fab fa-wpforms"></i>
                            <span>Form Builder</span>
                        </a>
                    </li>



                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('student.classes') || request()->routeIs('student.viewJoinedClasses') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-globe"></i>
                            <span>Website</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('website.builder.teacher') }}">
                                    <i class="fa-solid fa-gears"></i>
                                    <span>Website Builder</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('website.links.teacher')}}">
                                    <i class="fas fa-list"></i>
                                    <span>Website links</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('teacher.globalFormSubmissions')}}">
                                    <i class="fab fa-wpforms"></i>
                                    <span>Global Forms</span>
                                </a>
                            </li>

                        </ul>
                    </li>


                </ul>
            @elseif(Auth::guard('student')->check())
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                            href="{{ route('student.dashboard') }}">
                            <i class="fas fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ request()->routeIs('student.classes') || request()->routeIs('student.viewJoinedClasses') ? 'active' : '' }}"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-book"></i>
                            <span>Classes</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="{{ route('student.viewJoinedClasses') }}">
                                    <i class="fas fa-users"></i>
                                    <span>My Classes</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('student.classes') }}">
                                    <i class="fas fa-list"></i>
                                    <span>Browse Classes</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('student.allAssignedForms') ? 'active' : '' }}"
                            href="{{ route('student.allAssignedForms') }}">
                            <i class="fas fa-clipboard-list"></i>
                            <span>Assignments</span>
                            <!-- Example notification badge -->
                            <!-- <span class="nav-badge">3</span> -->
                        </a>
                    </li>
                </ul>
            @endif

            <!-- User Profile Section -->
            @if (Auth::guard('teacher')->check() || Auth::guard('student')->check())
                <div class="user-section">
                    <div class="dropdown user-profile">
                        <button class="user-button dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="user-avatar">
                                {{ strtoupper(substr(Auth::guard('teacher')->check() ? Auth::guard('teacher')->user()->name : Auth::guard('student')->user()->name, 0, 1)) }}
                            </div>
                            <div class="user-info">
                                <div class="user-name" style="font-family : Delius Swash Caps, cursive;letter-spacing : 1px;">
                                    {{ Auth::guard('teacher')->check() ? Auth::guard('teacher')->user()->name : Auth::guard('student')->user()->name }}
                                </div>
                                <div class="user-role" >
                                    {{ Auth::guard('teacher')->check() ? 'Teacher' : 'Student' }}
                                </div>
                            </div>
                            <i class="fas fa-chevron-down user-dropdown-arrow"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user"></i>
                                    <span>Profile Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cog"></i>
                                    <span>Preferences</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('account.logout') }}">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Sign Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</nav>

<script>
    // Add scroll effect to navbar
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('mainNavbar');
        let lastScrollTop = 0;

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        });

        // Add active state management
        const navLinks = document.querySelectorAll('.nav-link:not(.dropdown-toggle)');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Add loading state
                this.classList.add('loading');

                // Remove loading state after navigation (simulated)
                setTimeout(() => {
                    this.classList.remove('loading');
                }, 1000);
            });
        });

        // Smooth dropdown animations
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.dropdown-toggle');
            const menu = dropdown.querySelector('.dropdown-menu');

            dropdown.addEventListener('show.bs.dropdown', function() {
                menu.style.display = 'block';
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(-8px)';

                requestAnimationFrame(() => {
                    menu.style.transition = 'all 0.2s ease';
                    menu.style.opacity = '1';
                    menu.style.transform = 'translateY(0)';
                });
            });

            dropdown.addEventListener('hide.bs.dropdown', function() {
                menu.style.transition = 'all 0.15s ease';
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(-8px)';

                setTimeout(() => {
                    menu.style.display = 'none';
                }, 150);
            });
        });
    });
</script>

