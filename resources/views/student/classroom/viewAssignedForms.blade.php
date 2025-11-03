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
        .form-icon {
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
        .form-icon i {
            font-size: 1.8rem;
            color: white;
        }
        .card-body {
            padding: 2rem;
            background: white;
            display: flex;
            flex-direction: column;
        }
        .form-info {
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
        
        .card.submitted {
            opacity: 0.7;
        }
        
        .card.submitted .card-header {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        }
        
        .btn-secondary {
            background: #6c757d;
            border: none;
        }
        
        .submitted-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container py-5">
    <div class="page-header text-center text-white p-4 mb-5">
        <h1 class="display-4 fw-bold mb-2">
            <i class="fas fa-clipboard-list me-3"></i>{{ $classroom->name }}
        </h1>
        <p class="lead mb-0">Assigned Forms & Activities</p>
    </div>

    <div class="row g-4">
        @forelse ($forms as $form)
            <div class="col-lg-4 col-md-6">
                <div class="card shadow-lg {{ in_array($form->form_id, $submittedFormIds) ? 'submitted' : '' }}">
                    <div class="card-header text-white position-relative">
                        @if(in_array($form->form_id, $submittedFormIds))
                            <div class="submitted-badge">
                                <i class="fas fa-check me-1"></i>Submitted
                            </div>
                        @endif
                        <div class="form-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5 class="card-title mb-0 fw-bold">{{ $form->form->title }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-info">
                            <p class="text-muted mb-0">Form assigned to this classroom by {{$classroom->teacher->name}}</p>
                        </div>
                        <div class="d-grid">
                            @if(in_array($form->form_id, $submittedFormIds))
                                <a href="{{route('student.showForm',[$classroom->id,$form->id])}}" class="btn btn-secondary btn-lg">
                                    <i class="fas fa-check me-2"></i>View Submitted
                                </a>
                            @else
                                <a href="{{route('student.showForm',[$classroom->id,$form->id])}}" class="btn btn-primary btn-lg">
                                    <i class="fas fa-edit me-2"></i>Complete Form
                                </a>
                            @endif
                        </div>
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
