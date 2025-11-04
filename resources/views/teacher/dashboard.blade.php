<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lync - Teacher Dashboard</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* ========================================
           DESIGN SYSTEM - Professional Education Theme
           ======================================== */
        :root {
            /* Primary Colors - Cool Blues for Trust & Professionalism */
            --primary-50: #f0f9ff;
            --primary-100: #e0f2fe;
            --primary-200: #bae6fd;
            --primary-300: #7dd3fc;
            --primary-400: #38bdf8;
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --primary-800: #075985;
            --primary-900: #0c4a6e;

            /* Neutral Grays - Professional & Clean */
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

            /* Semantic Colors - Soft & Professional */
            --success-50: #f0fdf4;
            --success-500: #22c55e;
            --success-600: #16a34a;
            --warning-50: #fffbeb;
            --warning-500: #f59e0b;
            --warning-600: #d97706;
            --danger-50: #fef2f2;
            --danger-500: #ef4444;
            --danger-600: #dc2626;

            /* Shadows & Effects */
            --shadow-xs: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);

            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;

            /* Typography */
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        /* ========================================
           BASE STYLES
           ======================================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--primary-50) 100%);
            color: var(--gray-900);
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* ========================================
           LAYOUT STRUCTURE
           ======================================== */
        .dashboard-container {
            min-height: 100vh;
            padding-top: 2rem;
            padding-bottom: 3rem;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* ========================================
           HEADER SECTION
           ======================================== */
        .dashboard-header {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            border-radius: var(--radius-2xl);
            padding: 3rem 2.5rem;
            margin-bottom: 2.5rem;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .welcome-title {
            font-size: 2.75rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.75rem;
            letter-spacing: -0.025em;
        }

        .welcome-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 400;
        }

        .header-stats {
            display: flex;
            gap: 2rem;
            margin-top: 2rem;
        }

        .header-stat {
            text-align: center;
        }

        .header-stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: white;
            display: block;
        }

        .header-stat-label {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 0.25rem;
        }

        /* ========================================
           KPI CARDS SECTION
           ======================================== */
        .kpi-section {
            margin-bottom: 2.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-800);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary-600);
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .kpi-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .kpi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-500), var(--primary-600));
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .kpi-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
        }

        .kpi-card:hover::before {
            transform: scaleX(1);
        }

        .kpi-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.5rem;
        }

        .kpi-icon {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .kpi-trend {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .kpi-trend.positive {
            color: var(--success-600);
        }

        .kpi-trend.neutral {
            color: var(--gray-500);
        }

        .kpi-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
            line-height: 1;
        }

        .kpi-label {
            font-size: 1rem;
            color: var(--gray-600);
            font-weight: 500;
        }

        .kpi-description {
            font-size: 0.875rem;
            color: var(--gray-500);
            margin-top: 0.5rem;
            line-height: 1.4;
        }

        /* ========================================
           QUICK ACTIONS SECTION
           ======================================== */
        .actions-section {
            margin-bottom: 2.5rem;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            text-decoration: none;
            color: inherit;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .action-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(14, 165, 233, 0.05), transparent);
            transition: left 0.5s ease;
        }

        .action-card:hover::after {
            left: 100%;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-300);
            text-decoration: none;
            color: inherit;
        }

        .action-icon {
            width: 64px;
            height: 64px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            color: white;
            flex-shrink: 0;
            box-shadow: var(--shadow-md);
        }

        .action-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .action-content p {
            font-size: 0.9375rem;
            color: var(--gray-600);
            margin: 0;
            line-height: 1.5;
        }

        /* ========================================
           FORMS MANAGEMENT SECTION
           ======================================== */
        .forms-section {
            margin-bottom: 2rem;
        }

        .forms-container {
            background: white;
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .forms-header {
            background: var(--gray-50);
            padding: 2rem 2.5rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .forms-header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .forms-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0;
        }

        .forms-title i {
            color: var(--primary-600);
        }

        .search-controls {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .search-input {
            width: 280px;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray-300);
            border-radius: var(--radius-lg);
            font-size: 0.9375rem;
            transition: all 0.3s ease;
            background: white;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            width: 320px;
        }

        .search-btn {
            padding: 0.75rem 1.25rem;
            background: var(--primary-600);
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .search-btn:hover {
            background: var(--primary-700);
            transform: translateY(-1px);
        }

        .forms-content {
            padding: 2.5rem;
        }

        .forms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .form-card {
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-xl);
            padding: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .form-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            border-color: var(--primary-300);
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .form-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
            line-height: 1.4;
        }

        .form-meta {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .form-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--gray-600);
        }

        .form-meta-item i {
            color: var(--primary-600);
            width: 16px;
        }

        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            border-radius: var(--radius-md);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--primary-600);
            border-color: var(--primary-600);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-700);
            border-color: var(--primary-700);
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-600);
            border-color: var(--success-600);
            color: white;
        }

        .btn-success:hover {
            background: var(--success-700);
            border-color: var(--success-700);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--danger-600);
            border-color: var(--danger-600);
            color: white;
        }

        .btn-danger:hover {
            background: var(--danger-700);
            border-color: var(--danger-700);
            transform: translateY(-1px);
        }

        /* ========================================
           EMPTY STATES
           ======================================== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--gray-500);
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--gray-400);
        }

        .empty-state h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--gray-500);
            margin-bottom: 1.5rem;
        }

        /* ========================================
           PAGINATION
           ======================================== */
        .pagination-container {
            padding: 2rem 2.5rem;
            border-top: 1px solid var(--gray-200);
            background: var(--gray-50);
        }

        /* ========================================
           ALERTS & NOTIFICATIONS
           ======================================== */
        .alert {
            border-radius: var(--radius-lg);
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
        }

        .alert-success {
            background: var(--success-50);
            color: var(--success-800);
            border-left: 4px solid var(--success-500);
        }

        /* ========================================
           RESPONSIVE DESIGN
           ======================================== */
        @media (max-width: 768px) {
            .main-content {
                padding: 0 1rem;
            }

            .dashboard-header {
                padding: 2rem 1.5rem;
                margin-bottom: 1.5rem;
            }

            .welcome-title {
                font-size: 2rem;
            }

            .header-stats {
                flex-direction: column;
                gap: 1rem;
                margin-top: 1.5rem;
            }

            .kpi-grid,
            .actions-grid {
                grid-template-columns: 1fr;
            }

            .forms-header {
                padding: 1.5rem;
            }

            .forms-content {
                padding: 1.5rem;
            }

            .forms-header-content {
                flex-direction: column;
                align-items: stretch;
            }

            .search-controls {
                flex-direction: column;
                width: 100%;
            }

            .search-input {
                width: 100%;
            }

            .search-input:focus {
                width: 100%;
            }
        }

        /* ========================================
           MICRO-INTERACTIONS
           ======================================== */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .pulse-success {
            animation: pulseSuccess 0.6s ease-out;
        }

        @keyframes pulseSuccess {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="dashboard-container">
        <div class="main-content">
            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show fade-in" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Dashboard Header -->
            <div class="dashboard-header fade-in">
                <div class="header-content">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h1 class="welcome-title">Welcome back, {{ Auth::guard('teacher')->user()->name }}</h1>
                            <p class="welcome-subtitle">Ready to inspire and educate your students today?</p>
                        </div>
                        <div class="col-lg-4">
                            <div class="header-stats">
                                <div class="header-stat">
                                    <span class="header-stat-value">{{ $forms->total() }}</span>
                                    <div class="header-stat-label">Total Forms</div>
                                </div>
                                <div class="header-stat">
                                    <span class="header-stat-value">{{ $classroomSetup->count() }}</span>
                                    <div class="header-stat-label">Classrooms</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KPI Section -->
            <div class="kpi-section fade-in">
                <h2 class="section-title">
                    <i class="fas fa-chart-line"></i>
                    Overview & Analytics
                </h2>
                <div class="kpi-grid">
                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="kpi-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <div class="kpi-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                Active
                            </div>
                        </div>
                        <div class="kpi-value">{{ $forms->total() }}</div>
                        <div class="kpi-label">Total Forms Created</div>
                        <div class="kpi-description">Forms and assignments available for students</div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="kpi-icon">
                                <i class="fas fa-school"></i>
                            </div>
                            <div class="kpi-trend positive">
                                <i class="fas fa-arrow-up"></i>
                                Growing
                            </div>
                        </div>
                        <div class="kpi-value">{{ $classroomSetup->count() }}</div>
                        <div class="kpi-label">Active Classrooms</div>
                        <div class="kpi-description">Classrooms with enrolled students</div>
                    </div>

                    <div class="kpi-card">
                        <div class="kpi-header">
                            <div class="kpi-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="kpi-trend neutral">
                                <i class="fas fa-minus"></i>
                                Stable
                            </div>
                        </div>
                        <div class="kpi-value">{{ $forms->total() > 0 ? number_format($forms->total() / max($classroomSetup->count(), 1), 1) : '0' }}</div>
                        <div class="kpi-label">Avg Forms per Classroom</div>
                        <div class="kpi-description">Average distribution of learning materials</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions Section -->
            <div class="actions-section fade-in">
                <h2 class="section-title">
                    <i class="fas fa-bolt"></i>
                    Quick Actions
                </h2>
                <div class="actions-grid">
                    <a href="{{ route('teacher.classroom.setup') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-school"></i>
                        </div>
                        <div class="action-content">
                            <h3>Manage Classrooms</h3>
                            <p>Create and organize your classes, manage student enrollment, and set up learning environments.</p>
                        </div>
                    </a>

                    <a href="{{ route('teacher.formBuilder') }}" class="action-card">
                        <div class="action-icon">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div class="action-content">
                            <h3>Create New Form</h3>
                            <p>Build custom forms, assignments, and quizzes with our intuitive drag-and-drop form builder.</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Forms Management Section -->
            <div class="forms-section fade-in">
                <div class="forms-container">
                    <div class="forms-header">
                        <div class="forms-header-content">
                            <h2 class="forms-title">
                                <i class="fas fa-folder-open"></i>
                                Forms & Assignments Management
                            </h2>
                            <div class="search-controls">
                                <input type="text" id="form-search" class="search-input" placeholder="Search forms and assignments...">
                                <button type="button" id="search-btn" class="search-btn">
                                    <i class="fas fa-search"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="forms-content">
                        <div id="forms-container">
                            @include('teacher.partials.forms')
                        </div>

                        <div id="pagination-container" class="pagination-container">
                            {{ $forms->links('teacher.partials.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSearch = '';

            // Add fade-in animation to dynamically loaded content
            function addFadeInAnimation() {
                const elements = document.querySelectorAll('#forms-container > *');
                elements.forEach((el, index) => {
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        el.style.transition = 'all 0.4s ease';
                        el.style.opacity = '1';
                        el.style.transform = 'translateY(0)';
                    }, index * 100);
                });
            }

            // Pagination handling
            document.addEventListener('click', function(e) {
                if (e.target.matches('.page-link[data-page]')) {
                    e.preventDefault();
                    const page = e.target.getAttribute('data-page');
                    loadForms(page, currentSearch);
                }
            });

            // Search functionality
            document.getElementById('search-btn').addEventListener('click', function() {
                this.classList.add('pulse-success');
                setTimeout(() => this.classList.remove('pulse-success'), 600);
                currentSearch = document.getElementById('form-search').value;
                loadForms(1, currentSearch);
            });

            document.getElementById('form-search').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    currentSearch = this.value;
                    loadForms(1, currentSearch);
                }
            });

            // Form assignment handling
            document.addEventListener('click', function(e) {
                const target = e.target.closest('.add-classroom-btn') || e.target;

                if (target.matches('.add-classroom-btn')) {
                    const btn = target;
                    const formId = btn.getAttribute('data-form-id');
                    const assignmentDiv = document.getElementById(`assignment-${formId}`);
                    const icon = btn.querySelector('i');

                    if (assignmentDiv.style.display === 'none' || assignmentDiv.style.display === '') {
                        assignmentDiv.style.display = 'block';
                        assignmentDiv.classList.add('fade-in');
                        icon.className = 'fas fa-minus';
                        setTimeout(() => {
                            $(`#classroom-select-${formId}`).selectpicker('destroy').selectpicker();
                        }, 100);
                    } else {
                        assignmentDiv.style.display = 'none';
                        icon.className = 'fas fa-plus';
                    }
                    return;
                }

                if (e.target.matches('.assign-btn')) {
                    const assignButton = e.target;
                    const formId = assignButton.getAttribute('data-form-id');
                    const selectedOptions = $(`#classroom-select-${formId}`).val();

                    if (selectedOptions.length === 0) {
                        alert('Please select at least one classroom');
                        return;
                    }

                    // Add loading state
                    assignButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Assigning...';
                    assignButton.disabled = true;

                    fetch('/teacher/assign-form', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            form_id: formId,
                            classroom_ids: selectedOptions
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            assignButton.innerHTML = '<i class="fas fa-check me-1"></i>Assigned!';
                            assignButton.classList.add('pulse-success');
                            setTimeout(() => {
                                loadForms(1, currentSearch);
                            }, 1000);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        assignButton.innerHTML = '<i class="fas fa-plus me-1"></i>Assign to Classrooms';
                        assignButton.disabled = false;
                    });
                }
            });

            function loadForms(page = 1, search = '') {
                const url = new URL('/teacher/forms', window.location.origin);
                url.searchParams.set('page', page);
                if (search) url.searchParams.set('search', search);

                // Add loading state
                document.getElementById('forms-container').style.opacity = '0.6';

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('forms-container').innerHTML = data.html;
                    document.getElementById('pagination-container').innerHTML = data.pagination;
                    document.getElementById('forms-container').style.opacity = '1';
                    
                    // Re-initialize selectpickers and add animations
                    $('.tom-select-multiple').selectpicker();
                    addFadeInAnimation();
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('forms-container').style.opacity = '1';
                });
            }

            // Initial animation
            addFadeInAnimation();
        });
    </script>
</body>
</html>