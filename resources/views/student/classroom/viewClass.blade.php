<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Student Dashboard - Lync</title>
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
            border-radius: 20px;
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
            height: 350px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
        }
        
        .card-header {
            background: rgba(52, 58, 64, 0.95) !important;
            border: none;
            padding: 1.5rem;
        }
        
        .card-body {
            padding: 2rem;
            background: white;
        }
        
        .btn-primary {
            background: #198754;
            border: none;
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(25, 135, 84, 0.3);
            background: #157347;
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container py-5">
    <div class="page-header text-center text-white p-4 mb-5">
        <h1 class="display-4 fw-bold mb-2">
            <i class="fas fa-school me-3"></i>Available Classes
        </h1>
        <p class="lead mb-0">Choose a class to join and start your learning journey</p>
    </div>
    
    <div class="row g-4">
        @foreach ($classes as $class)
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-graduation-cap me-2"></i>
                            {{ $class->name }}
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="card-text text-muted flex-grow-1 mb-4">{{ $class->description }}</p>
                        @if(in_array($class->id, $joinedClassIds))
                            <a href="{{ route('student.viewAssignedForms', $class->id) }}" class="btn btn-success btn-lg mt-auto">
                                <i class="fas fa-eye me-2"></i>View Forms
                            </a>
                        @else
                            <div class="password-section" id="password-{{ $class->id }}" style="display: none;">
                                <input type="password" class="form-control mb-3" placeholder="Enter class password" id="password-input-{{ $class->id }}">
                                <button type="button" class="btn btn-success w-100 mb-2" onclick="submitJoin('{{ $class->id }}')">
                                    <i class="fas fa-check me-2"></i>Join Class
                                </button>
                                <button type="button" class="btn btn-secondary w-100" onclick="cancelJoin('{{ $class->id }}')">
                                    Cancel
                                </button>
                            </div>
                            <button type="button" class="btn btn-primary btn-lg mt-auto join-btn" id="join-btn-{{ $class->id }}" onclick="showPassword('{{ $class->id }}')">
                                <i class="fas fa-rocket me-2"></i>Join Now
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
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
        alert('An error occurred. Please try again.');
    });
}
</script>
</body>
</html>
