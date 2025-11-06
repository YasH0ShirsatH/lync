<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Classrooms - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
             font-family: "Playwrite DE Grund", cursive;
        }

        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --danger-500: #ef4444;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0f2fe 100%);
             font-family: "Playwrite DE Grund", cursive;
            min-height: 100vh;
            color: var(--gray-800);
        }

        .container {
            max-width: 1350px;
        }

        .page-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: var(--primary-600);
            text-decoration: none;
        }

        .page-title {
            color: var(--gray-900);
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            margin: 0;
        }

        .stats-overview {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            text-align: center;
            padding: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-600);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--gray-600);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .class-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-500);
        }

        .class-header {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .class-icon {
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .class-icon i {
            font-size: 1.25rem;
            color: white;
        }

        .class-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .class-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 140px);
        }

        .class-description {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 0.5rem;
            border-left: 4px solid var(--primary-500);
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .description-text {
            color: var(--gray-600);
            margin: 0;
            line-height: 1.5;
            font-size: 0.875rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            flex: 1;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, var(--danger-500) 0%, #dc2626 100%);
            color: white;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 1rem;
            border: 1px solid var(--gray-200);
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--gray-500);
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Your Classrooms</li>
            </ol>
        </nav>
        <h1 class="page-title">Your Classrooms</h1>
        <p class="page-subtitle">Access your enrolled classrooms and assignments</p>
    </div>
</div>

<div class="container pb-5">
    @if($classrooms->count() > 0)
        <div class="stats-overview">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-number">{{ $classrooms->count() }}</div>
                        <div class="stat-label">Enrolled Classes</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-number">{{ $classrooms->sum(function($c) { return $c->classroomForms->count(); }) }}</div>
                        <div class="stat-label">Total Assignments</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-number">{{ $classrooms->unique('teacher_id')->count() }}</div>
                        <div class="stat-label">Instructors</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        @forelse($classrooms as $classroom)
            <div class="col-lg-4 col-md-6">
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="class-title">{{ $classroom->name }}</h5>
                    </div>

                    <div class="class-body">
                        <div class="class-description">
                            <p class="description-text">
                                {{ $classroom->description ?: 'No description available for this classroom.' }}
                            </p>
                        </div>

                        <div class="action-buttons">
                            <a href="{{ route('student.viewAssignedForms', $classroom->id) }}" class="btn btn-primary">
                                <i class="fas fa-clipboard-list me-1"></i>View Forms
                            </a>
                            <button type="button" class="btn btn-danger" onclick="leaveClass('{{ $classroom->id }}')">
                                <i class="fas fa-sign-out-alt me-1"></i>Leave
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-graduation-cap empty-icon"></i>
                    <h4 class="mb-3">No Classrooms Joined</h4>
                    <p class="text-muted mb-4">You haven't joined any classrooms yet. Browse and join available classes to access your assignments.</p>
                    <a href="{{ route('student.classes') }}" class="btn btn-primary">
                        <i class="fas fa-search me-2"></i>Browse Classes
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
function leaveClass(classId) {
    if (confirm('Are you sure you want to leave this class? You will lose access to all assignments.')) {
        fetch('/student/leave-class', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                classroom_id: classId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@include('javascript.js')
</body>
</html>
