<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Your Classrooms - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-section {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb-nav {
            background: transparent;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
        }

        .breadcrumb-item.active {
            color: white;
        }

        .class-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            border-color: #007bff;
        }

        .class-header {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            border-bottom: 3px solid #007bff;
        }

        .class-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .class-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .class-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .class-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 140px);
        }

        .class-description {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .description-text {
            color: #6c757d;
            margin: 0;
            line-height: 1.5;
            font-size: 0.9rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            flex: 1;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
        }

        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .empty-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }

        .stats-section {
            background: white;
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
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

<div class="header-section">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Your Classrooms</li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-graduation-cap me-3"></i>Your Classrooms
            </h1>
            <p class="lead mb-0 opacity-75">Access your enrolled classrooms and assignments</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    @if($classrooms->count() > 0)
        <div class="stats-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $classrooms->count() }}</div>
                        <div class="stat-label">Enrolled Classes</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $classrooms->sum(function($c) { return $c->classroomForms->count(); }) }}</div>
                        <div class="stat-label">Total Assignments</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
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
