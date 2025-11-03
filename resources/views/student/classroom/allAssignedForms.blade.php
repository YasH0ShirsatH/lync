<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Assigned Forms - Lync</title>
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
        .classroom-section {
            background: white;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            margin-bottom: 2rem;
            overflow: hidden;
        }
        .classroom-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        .form-item {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }
        .form-item:last-child {
            border-bottom: none;
        }
        .form-item:hover {
            background: #f8f9fa;
        }
        .form-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }
        .form-status {
            font-size: 0.8rem;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-weight: 600;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-completed {
            background: #d1edff;
            color: #0c63e4;
        }
    </style>
</head>
<body>
@include('layouts.navbar')
<div class="container py-5">
    <div class="page-header text-center text-white p-4 mb-5">
        <h1 class="display-4 fw-bold mb-2">
            <i class="fas fa-clipboard-list me-3"></i>All Assigned Forms
        </h1>
        <p class="lead mb-0">Complete your assignments organized by classroom</p>
    </div>

    @forelse($joinedClassrooms as $classroomStudent)
        @if($classroomStudent->classroom->classroomForms->count() > 0)
            <div class="classroom-section">
                <div class="classroom-header">
                    <h3 class="mb-0 fw-bold">
                        <i class="fas fa-graduation-cap me-2"></i>
                        {{ $classroomStudent->classroom->name }}
                    </h3>
                </div>
                <div class="forms-list">
                    @foreach($classroomStudent->classroom->classroomForms as $classroomForm)
                        <div class="form-item">
                            <a href="{{ route('student.showForm', [$classroomStudent->classroom->id, $classroomForm->id]) }}" class="form-link">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-1 fw-bold">
                                            <i class="fas fa-file-alt me-2 text-primary"></i>
                                            {{ $classroomForm->form->title }}
                                        </h5>
                                        <p class="text-muted mb-0">
                                            <small>
                                                <i class="fas fa-user me-1"></i>
                                                Assigned by {{ $classroomStudent->classroom->teacher->name }}
                                            </small>
                                        </p>
                                    </div>
                                    <div class="text-end">
                                        @if(in_array($classroomForm->form_id, $submittedFormIds))
                                            <span class="form-status status-completed">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                        @else
                                            <span class="form-status status-pending">
                                                <i class="fas fa-clock me-1"></i>Pending
                                            </span>
                                        @endif
                                        <div class="mt-1">
                                            <i class="fas fa-chevron-right text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @empty
        <div class="text-center">
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                You haven't joined any classrooms yet. <a href="{{ route('student.classes') }}">Browse available classes</a>
            </div>
        </div>
    @endforelse


</div>
</body>
</html>
