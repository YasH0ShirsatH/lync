<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        /* --- Modern Color Palette & Variables --- */
        :root {
            --text-dark: #1f2937; /* Dark Slate */
            --primary-blue: #3b82f6; /* Tailwind Blue 500 */
            --primary-dark: #1e40af; /* Tailwind Blue 800 */
            --bg-light: #f8fafc; /* Crisp White/Light Gray */
            --border-color: #e5e7eb;
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        body {
            background-color: var(--bg-light);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            color: var(--text-dark);
        }

        /* --- Header Section --- */
        .header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 3rem 0;
            border-radius: 0 0 24px 24px;
        }
        .header-title {
            font-weight: 600;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        .header-subtitle {
            opacity: 0.9;
            font-size: 1rem;
        }

        /* --- Stats Cards --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.2s ease;
            text-align: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }
        .stat-label {
            color: #6c757d;
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Color themes for stats */
        .stat-card.blue .stat-icon { background-color: #e3f2fd; color: #007bff; }
        .stat-card.blue .stat-number { color: #007bff; }
        .stat-card.green .stat-icon { background-color: #e8f5e8; color: #198754; }
        .stat-card.green .stat-number { color: #198754; }
        .stat-card.orange .stat-icon { background-color: #fff3cd; color: #fd7e14; }
        .stat-card.orange .stat-number { color: #fd7e14; }
        .stat-card.purple .stat-icon { background-color: #f3e8ff; color: #7c3aed; }
        .stat-card.purple .stat-number { color: #7c3aed; }


        /* --- Action Cards (Cleaner and more defined) --- */
        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            text-decoration: none;
            color: inherit;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
            transition: all 0.2s ease;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            border-color: var(--text-dark);
            color: inherit;
            text-decoration: none;
        }

        .action-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .action-icon-large {
            width: 48px;
            height: 48px;
            border-radius: 8px; /* Square icon background */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 1rem;
        }

        .action-title {
            font-weight: 600;
            color: var(--text-dark);
            font-size: 1.25rem;
            margin-bottom: 0;
        }
        .action-desc {
            color: var(--secondary-text);
            font-size: 0.9rem;
            line-height: 1.5;
            padding-left: 3.75rem; /* Align description under title but next to icon */
        }

        /* Action card specific colors */
        .card-blue .action-icon-large { background-color: #eff6ff; color: var(--primary-blue); }
        .card-purple .action-icon-large { background-color: #ede9fe; color: #7c3aed; }
        .card-green .action-icon-large { background-color: #ecfdf5; color: #059669; }

        /* Bubble animation */
        .bubble-animate {
            animation: bubbleEffect 0.6s ease-out;
        }

        @keyframes bubbleEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

    </style>
</head>
<body>
    @include('layouts.navbar')

    {{-- 1. Header Section --}}
    <div class="header">
        <div class="container">
            <h1 class="header-title">Welcome, {{ Auth::guard('student')->user()->name }}</h1>
            <p class="header-subtitle">Track your progress and manage your academic journey</p>
        </div>
    </div>

    <div class="container">
        {{-- 2. Stats Section (Independent Cards) --}}
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="stat-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="stat-number">{{ $joinedClassrooms }}</div>
                <div class="stat-label">Classes Joined</div>
            </div>
            <div class="stat-card purple">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-number">{{ $totalForms }}</div>
                <div class="stat-label">Total Forms</div>
            </div>
            <div class="stat-card green">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <div class="stat-number">{{ $completedForms }}</div>
                <div class="stat-label">Completed</div>
            </div>
            <div class="stat-card orange">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ $pendingForms }}</div>
                <div class="stat-label">Pending</div>
            </div>

        </div>

        {{-- 3. Action Cards (Grid) --}}
        <h3 class="fw-bold mb-4 mt-4 text-body-emphasis">Quick Actions</h3>

        <div class="actions-grid">

            <a href="{{ route('student.classes') }}" class="action-card card-blue" id="searchBtn">
                <div class="action-card-header">
                    <div class="action-icon-large">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4 class="action-title">Discover Classes</h4>
                </div>
                <p class="action-desc">Browse available classrooms and join new courses with a classroom code.</p>
            </a>

            <a href="{{ route('student.viewJoinedClasses') }}" class="action-card card-purple">
                <div class="action-card-header">
                    <div class="action-icon-large" style="background-color: #ede9fe; color: #7c3aed;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h4 class="action-title">My Classrooms</h4>
                </div>
                <p class="action-desc">View your enrolled classes, class announcements, and teacher updates.</p>
            </a>

            <a href="{{ route('student.allAssignedForms') }}" class="action-card card-green">
                <div class="action-card-header">
                    <div class="action-icon-large">
                        <i class="fas fa-file-signature"></i>
                    </div>
                    <h4 class="action-title">Complete Assignments</h4>
                </div>
                <p class="action-desc">Access the list of all forms, quizzes, and assignments due for your classes.</p>
            </a>
        </div>
    </div>

    {{-- Javascript --}}
    <script>
        document.getElementById('searchBtn').addEventListener('click', function(e) {
            e.preventDefault();
            this.classList.add('bubble-animate');
            setTimeout(() => {
                window.location.href = this.href;
            }, 300);
        });
    </script>

    @include('javascript.js')
</body>
</html>
