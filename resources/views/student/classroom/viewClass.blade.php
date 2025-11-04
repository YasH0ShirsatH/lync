<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Available Classes - Lync</title>
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
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }

        .info-icon {
            width: 40px;
            height: 40px;
            background: #007bff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .info-icon i {
            color: white;
            font-size: 1rem;
        }

        .info-content h6 {
            color: #2c3e50;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .info-content p {
            color: #6c757d;
            margin: 0;
            line-height: 1.5;
            font-size: 0.9rem;
        }

        .join-section {
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
        }

        .password-input {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            margin-bottom: 1rem;
        }

        .password-input:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .empty-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
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
                <li class="breadcrumb-item active">Available Classes</li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-school me-3"></i>Available Classes
            </h1>
            <p class="lead mb-0 opacity-75">Discover and join classrooms to start learning</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row g-4">
        @forelse ($classes as $class)
            <div class="col-lg-4 col-md-6">
                <div class="class-card">
                    <div class="class-header">
                        <div class="class-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="class-title">{{ $class->name }}</h5>
                    </div>

                    <div class="class-body">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="info-content">
                                <h6>Instructor</h6>
                                <p>{{ $class->teacher->name }}</p>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <div class="info-content">
                                <h6>Description</h6>
                                <p>{{ $class->description ?: 'No description available' }}</p>
                            </div>
                        </div>

                        <div class="join-section">
                            <div class="password-section" id="password-{{ $class->id }}" style="display: none;">
                                <input type="password" class="form-control password-input" placeholder="Enter class password" id="password-input-{{ $class->id }}">
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-success flex-fill" onclick="submitJoin('{{ $class->id }}')">
                                        <i class="fas fa-check me-1"></i>Join Class
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary flex-fill" onclick="cancelJoin('{{ $class->id }}')">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary w-100" id="join-btn-{{ $class->id }}" onclick="showPassword('{{ $class->id }}')">
                                <i class="fas fa-plus me-2"></i>Join This Class
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-school empty-icon"></i>
                    <h4 class="mb-3">No Classes Available</h4>
                    <p class="text-muted mb-4">There are no classes available to join at the moment. Check back later or contact your instructor.</p>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-home me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
function showPassword(classId) {
    document.getElementById(`password-${classId}`).style.display = 'block';
    document.getElementById(`join-btn-${classId}`).style.display = 'none';
}

function cancelJoin(classId) {
    document.getElementById(`password-${classId}`).style.display = 'none';
    document.getElementById(`join-btn-${classId}`).style.display = 'block';
    document.getElementById(`password-input-${classId}`).value = '';
}

function submitJoin(classId) {
    const password = document.getElementById(`password-input-${classId}`).value;
    if (!password) {
        alert('Please enter the class password');
        return;
    }

    fetch('/student/join-class', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            classroom_id: classId,
            password: password
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
</script>
@include('javascript.js')
</body>
</html>
