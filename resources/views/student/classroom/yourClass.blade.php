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
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        .page-header {
            background: rgba(52, 58, 64, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            margin-bottom: 2rem;
        }
        .card {
            border-radius: 25px;
            transition: all 0.4s ease;
            border: none;
            overflow: hidden;
            background: white;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
        }
        .card-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            border: none;
            padding: 2rem 1.5rem;
            text-align: center;
        }
        .class-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
        }
        .class-icon i {
            font-size: 1.8rem;
            color: white;
        }
        .card-body {
            padding: 2rem;
            background: white;
            display: flex;
            flex-direction: column;
        }
        .class-info {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            border-left: 4px solid #198754;
        }
        .btn {
            border-radius: 15px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.4);
        }
        .btn-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container py-5">
    <div class="page-header text-center text-white p-4 mb-5">
        <h1 class="display-4 fw-bold mb-2">
            <i class="fas fa-graduation-cap me-3"></i>Your Classrooms
        </h1>
        <p class="lead mb-0">Access your joined classrooms and view assigned forms</p>
    </div>
    
    <div class="row g-4">
        @forelse($classrooms as $classroom)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <div class="class-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="card-title mb-0 fw-bold">{{ $classroom->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="class-info">
                            <p class="text-muted mb-0">{{ $classroom->description ?: 'No description available' }}</p>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="{{ route('student.viewAssignedForms', $classroom->id) }}" class="btn btn-primary">
                                <i class="fas fa-eye me-2"></i>View Forms
                            </a>
                            <button type="button" class="btn btn-danger" onclick="leaveClass('{{ $classroom->id }}')">
                                <i class="fas fa-sign-out-alt me-2"></i>Leave Class
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    You haven't joined any classrooms yet. <a href="{{ route('student.classes') }}">Browse available classes</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
function leaveClass(classId) {
    if (confirm('Are you sure you want to leave this class?')) {
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
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
</body>
</html>
