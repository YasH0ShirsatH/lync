<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assigned Forms - {{ $classroom->name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            min-height: 100vh;
        }
        .card {
            border-radius: 20px;
            border: none;
            background: rgba(255, 255, 255, 0.95);
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
    <div class="page-header text-center mb-5">
        <h1 class="display-4 fw-bold mb-2">{{ $classroom->name }} - Forms</h1>
    </div>
    
    <div class="row g-4">
        @forelse ($forms as $form)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header text-white text-center">
                        <h5 class="card-title mb-0 fw-bold">
                            <i class="fas fa-file-alt me-2"></i>
                            {{ $form->form->title }}
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Form assigned to this classroom</p>
                        <button class="btn btn-primary w-100">View Form</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle me-2"></i>
                    No forms assigned to this classroom yet.
                </div>
            </div>
        @endforelse
    </div>
</div>
</body>
</html>
