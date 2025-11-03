<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            border-radius: 20px;
            transition: all 0.3s ease;
            border: none;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.95);
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
            <div class="col-md-6 col-xl-4">
                <div class="card shadow-lg">
                    <div class="card-header text-white">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-chalkboard-teacher me-2"></i>
                            {{ $classroom->name }}
                        </h5>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <p class="text-muted flex-grow-1">{{ $classroom->description }}</p>
                        <a href="{{ route('student.viewAssignedForms', $classroom->id) }}" class="btn btn-primary mt-auto">
                            <i class="fas fa-eye me-2"></i>View Forms
                        </a>
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
</body>
</html>
