<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        .profile-section {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.9) 100%);
            backdrop-filter: blur(20px);
            border-radius: 50px;
            padding: 3rem 2.5rem;
            margin: -3rem auto 3rem;
            max-width: 900px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255,255,255,0.3);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0 auto 2rem;
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.4);
        }

        .profile-info h2 {
            color: #1a1a1a;
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: 2rem;
        }

        .profile-meta {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .meta-item {
            background: rgba(102, 126, 234, 0.1);
            border: 1px solid rgba(102, 126, 234, 0.2);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: #667eea;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .meta-item:hover {
            background: rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
        }

        .meta-item i {
            color: #667eea !important;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .action-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            position: relative;
            overflow: hidden;
        }

        .action-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .action-card:hover::before {
            transform: scaleX(1);
        }

        .action-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            color: inherit;
            text-decoration: none;
        }

        .action-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: #007bff;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .action-card:hover .action-icon {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: white;
            transform: scale(1.1);
        }

        .action-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.75rem;
        }

        .action-description {
            color: #6c757d;
            line-height: 1.6;
            margin: 0;
        }

        .stats-bar {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 3rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 2rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #007bff;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="dashboard-header">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-3">Student Portal</h1>
            <p class="lead opacity-75">Manage your academic journey</p>
        </div>
    </div>

    <div class="container">
        <div class="profile-section text-center">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::guard('student')->user()->name, 0, 1)) }}
            </div>
            <div class="profile-info">
                <h2>{{ Auth::guard('student')->user()->name }}</h2>
                <div class="profile-meta">
                    <div class="meta-item">
                        <i class="fas fa-envelope"></i>
                        <span>{{ Auth::guard('student')->user()->email }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-user-graduate"></i>
                        <span>Student</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ Auth::guard('student')->user()->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="stats-bar">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $joinedClassrooms }}</div>
                    <div class="stat-label">Classes Joined</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $completedForms }}</div>
                    <div class="stat-label">Forms Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $pendingTasks }}</div>
                    <div class="stat-label">Pending Tasks</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $completionRate }}%</div>
                    <div class="stat-label">Completion Rate</div>
                </div>
            </div>
        </div>

        <div class="actions-grid pb-5">
            <a href="{{ route('student.classes') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="action-title">Discover Classes</h3>
                <p class="action-description">Browse and join available classrooms to start your learning journey</p>
            </a>

            <a href="{{ route('student.viewJoinedClasses') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3 class="action-title">My Classrooms</h3>
                <p class="action-description">Access your enrolled classes and view classroom activities</p>
            </a>

            <a href="{{ route('student.allAssignedForms') }}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="action-title">Complete Assignments</h3>
                <p class="action-description">View and submit your assigned forms and coursework</p>
            </a>
        </div>
    </div>

</body>
@include('javascript.js')

</html>
