<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Lync - Modern Learning Management System</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Delius+Swash+Caps&family=Metal+Mania&family=Playwrite+DE+Grund:wght@100..400&display=swap');
        :root {
            --primary-50: #f0f9ff;
            --primary-100: #e0f2fe;
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
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
            --success-500: #22c55e;
            --success-600: #16a34a;
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

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
            min-height: 100vh;
        }

        .welcome-container {
            min-height: 100vh;
            padding: 2rem 1rem;
        }

        .main-content {
            max-width: 1400px;
            margin: 0 auto;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            border-radius: 2rem;
            padding: 6rem 2.5rem;
            margin-bottom: 4rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(14, 165, 233, 0.25);
            text-align: center;
            color: white;
        }

        /* Navbar Styles */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--gray-200);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-sm);
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-600) !important;
            text-decoration: none;
        }

        .guest-pill {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
        }

        .guest-pill:hover {
            background: var(--gray-200);
            border-color: var(--gray-300);
        }

        .guest-pill-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-700);
            font-weight: 500;
            font-size: 0.875rem;
        }

        .guest-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
            min-width: 160px;
            display: none;
            z-index: 1001;
            margin-top: 0.5rem;
        }

        .guest-dropdown.show {
            display: block;
        }

        .guest-dropdown a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            color: var(--gray-700);
            text-decoration: none;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .guest-dropdown a:hover {
            background: var(--gray-100);
            color: var(--primary-600);
        }



        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="25" cy="25" r="0.5" fill="%23ffffff" opacity="0.05"/><circle cx="75" cy="75" r="0.8" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .hero-section::after {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: rotate 20s linear infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .hero-badge i {
            color: #10b981;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-title {
            font-size: 4.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #ffffff 0%, rgba(255,255,255,0.8) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.75rem;
            font-weight: 500;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.75rem 2rem;
            display: inline-block;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        }

        .hero-description {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.7;
            font-weight: 400;
        }

        .auth-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .auth-btn {
            padding: 1.25rem 2.5rem;
            border-radius: 50px;
            font-size: 1.125rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            min-width: 180px;
            justify-content: center;
            position: relative;
            z-index: 10;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .auth-btn.primary {
            background: rgba(255, 255, 255, 0.95);
            color: var(--primary-700);
            box-shadow: 0 8px 32px rgba(255, 255, 255, 0.3);
        }

        .auth-btn.primary:hover {
            background: white;
            color: var(--primary-800);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.4);
        }

        .auth-btn.secondary {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .auth-btn.secondary:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .features-section {
            margin-bottom: 3rem;
        }

        .section-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--gray-800);
            text-align: center;
            margin-bottom: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .section-title i {
            color: var(--primary-600);
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-align: center;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-300);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin: 0 auto 1.5rem;
            box-shadow: var(--shadow-md);
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 1rem;
        }

        .feature-description {
            color: var(--gray-600);
            font-size: 1rem;
            line-height: 1.6;
        }

        .stats-section {
            background: white;
            border-radius: var(--radius-2xl);
            padding: 3rem 2.5rem;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            text-align: center;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
        }

        .stat-item {
            padding: 1.5rem;
        }

        .stat-value {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-600);
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 1rem;
            color: var(--gray-600);
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.25rem;
            }

            .hero-section {
                padding: 3rem 1.5rem;
            }

            .auth-buttons {
                flex-direction: column;
                align-items: center;
            }

            .auth-btn {
                width: 100%;
                max-width: 300px;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .stats-section {
                padding: 2rem 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
            }

            .feature-card {
                padding: 2rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid px-4" style=" display: flex; justify-content: center; align-items: center; ">
            <div class="d-flex justify-content-between align-items-center w-100" style="max-width: 1300px;">
                <a class="navbar-brand" href="/" style="font-family : Delius Swash Caps, cursive;letter-spacing : 1px;" >
                    <i class="fas fa-graduation-cap me-2"></i>
                    Lync
                </a>

                <div class="guest-pill" onclick="toggleGuestDropdown()">
                    <div class="guest-pill-content">
                        <i class="fas fa-user-circle"></i>
                        <span>Guest</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="guest-dropdown" id="guestDropdown">
                        <a href="/login">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                        <a href="/register">
                            <i class="fas fa-user-plus"></i>
                            Register
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="welcome-container">
        <div class="main-content">
            <!-- Hero Section -->
            <div class="hero-section">
                <div class="hero-content">
                    <div class="hero-badge">
                        <i class="fas fa-sparkles"></i>
                        <span>New & Improved Platform</span>
                    </div>
                    <h1 class="hero-title">Welcome to Lync</h1>
                    <div class="hero-subtitle">Modern Learning Management System</div>
                    <p class="hero-description">
                        Empower education with our comprehensive platform designed for teachers and students.
                        Create forms, manage classrooms, and build engaging learning experiences.
                    </p>
                    <div class="auth-buttons">
                        <a href="/login" class="auth-btn primary">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                        <a href="/register" class="auth-btn secondary">
                            <i class="fas fa-user-plus"></i>
                            Register
                        </a>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="features-section">
                <h2 class="section-title">
                    <i class="fas fa-star"></i>
                    Why Choose Lync?
                </h2>
                <div class="features-grid">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <h3 class="feature-title">For Teachers</h3>
                        <p class="feature-description">
                            Create dynamic forms, manage classrooms, track student progress, and build custom web pages with our intuitive tools.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="feature-title">For Students</h3>
                        <p class="feature-description">
                            Access assignments, submit forms, participate in classroom activities, and track your learning journey seamlessly.
                        </p>
                    </div>

                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h3 class="feature-title">Easy to Use</h3>
                        <p class="feature-description">
                            Modern, intuitive interface with drag-and-drop form builders and powerful management tools that anyone can master.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="stats-section">
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-value">1000+</span>
                        <div class="stat-label">Active Users</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">500+</span>
                        <div class="stat-label">Forms Created</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">100+</span>
                        <div class="stat-label">Classrooms</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value">99%</span>
                        <div class="stat-label">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleGuestDropdown() {
            const dropdown = document.getElementById('guestDropdown');
            dropdown.classList.toggle('show');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const guestPill = document.querySelector('.guest-pill');
            const dropdown = document.getElementById('guestDropdown');

            if (!guestPill.contains(event.target)) {
                dropdown.classList.remove('show');
            }
        });
    </script>
</body>
</html>
