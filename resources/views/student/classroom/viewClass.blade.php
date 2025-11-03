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
            position: relative;
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

        .class-details {
            margin-bottom: 1.5rem;
        }

        .detail-row {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            border-left: 4px solid #198754;
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: #198754;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .detail-icon i {
            color: white;
            font-size: 1rem;
        }

        .detail-content {
            flex: 1;
        }

        .detail-label {
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .detail-value {
            color: #6c757d;
            margin: 0;
            line-height: 1.5;
        }

        .action-area {
            margin-top: 1rem;
        }

        .password-input-wrapper input {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }

        .password-input-wrapper input:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
        }

        .button-group {
            display: flex;
            gap: 0.5rem;
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
        @forelse ($classes as $class)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <div class="class-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h5 class="card-title mb-0 fw-bold">{{ $class->name }}</h5>
                    </div>
                    
                    <div class="card-body">
                        <div class="class-details">
                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-align-left"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Description</span>
                                    <p class="detail-value">{{ $class->description ?: 'No description available' }}</p>
                                </div>
                            </div>
                            
                            <div class="detail-row">
                                <div class="detail-icon">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="detail-content">
                                    <span class="detail-label">Instructor</span>
                                    <p class="detail-value">{{ $class->teacher->name }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="action-area">
                            <div class="password-section" id="password-{{ $class->id }}" style="display: none;">
                                <div class="password-input-wrapper mb-3">
                                    <input type="password" class="form-control" placeholder="Enter class password" id="password-input-{{ $class->id }}">
                                </div>
                                <div class="button-group">
                                    <button type="button" class="btn btn-success flex-fill" onclick="submitJoin('{{ $class->id }}')">
                                        <i class="fas fa-check me-1"></i>Join
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary flex-fill" onclick="cancelJoin('{{ $class->id }}')">
                                        <i class="fas fa-times me-1"></i>Cancel
                                    </button>
                                </div>
                            </div>
                            
                            <button type="button" class="btn btn-primary btn-lg w-100 join-btn" id="join-btn-{{ $class->id }}" onclick="showPassword('{{ $class->id }}')">
                                <i class="fas fa-rocket me-2"></i>Join Class
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No classes available to join at the moment.
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
        alert('An error occurred. Please try again.');
    });
}
</script>
</body>
</html>