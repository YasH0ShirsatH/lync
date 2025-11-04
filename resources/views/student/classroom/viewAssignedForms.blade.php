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

        .form-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            position: relative;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
            border-color: #007bff;
        }

        .form-card.completed {
            border-color: #198754;
        }

        .form-card.completed:hover {
            border-color: #198754;
        }

        .form-header {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            border-bottom: 3px solid #007bff;
            position: relative;
        }

        .form-card.completed .form-header {
            border-bottom-color: #198754;
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: #198754;
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .form-icon {
            width: 60px;
            height: 60px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .form-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: white;
            margin: 0;
        }

        .form-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 140px);
        }

        .form-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .form-card.completed .form-info {
            border-left-color: #198754;
        }

        .info-text {
            color: #6c757d;
            margin: 0;
            line-height: 1.5;
            font-size: 0.9rem;
        }

        .action-button {
            margin-top: auto;
        }

        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            width: 100%;
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

        .stat-number.completed {
            color: #198754;
        }

        .stat-number.pending {
            color: #ffc107;
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
                <li class="breadcrumb-item"><a href="{{ route('student.viewJoinedClasses') }}">Your Classroom</a></li>
                <li class="breadcrumb-item active">{{ $classroom->name }}</li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-clipboard-list me-3"></i>{{ $classroom->name }}
            </h1>
            <p class="lead mb-0 opacity-75">Complete your assigned forms and activities</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    @if($forms->count() > 0)
        <div class="stats-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $forms->count() }}</div>
                        <div class="stat-label">Total Forms</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number completed">{{ count($submittedFormIds) }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number pending">{{ $forms->count() - count($submittedFormIds) }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-4">
        @forelse ($forms as $form)
            <div class="col-lg-4 col-md-6">
                <div class="form-card {{ in_array($form->form_id, $submittedFormIds) ? 'completed' : '' }}">
                    <div class="form-header">
                        @if(in_array($form->form_id, $submittedFormIds))
                            <div class="status-badge">
                                <i class="fas fa-check me-1"></i>Completed
                            </div>
                        @endif
                        <div class="form-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <h5 class="form-title">{{ $form->form->title }}</h5>
                    </div>

                    <div class="form-body">
                        <div class="form-info">
                            <p class="info-text">
                                <strong>Instructor:</strong> {{ $classroom->teacher->name }}<br>
                                <strong>Status:</strong> {{ in_array($form->form_id, $submittedFormIds) ? 'Submitted' : 'Pending Completion' }}
                            </p>
                        </div>

                        <div class="action-button">
                            @if(in_array($form->form_id, $submittedFormIds))
                                <a href="{{ route('student.showForm', [$classroom->id, $form->id]) }}" class="btn btn-success">
                                    <i class="fas fa-eye me-2"></i>View Submission
                                </a>
                            @else
                                <a href="{{ route('student.showForm', [$classroom->id, $form->id]) }}" class="btn btn-primary">
                                    <i class="fas fa-edit me-2"></i>Complete Form
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-clipboard-list empty-icon"></i>
                    <h4 class="mb-3">No Forms Assigned</h4>
                    <p class="text-muted mb-4">This classroom doesn't have any forms assigned yet. Check back later for new assignments.</p>
                    <a href="{{ route('student.viewJoinedClasses') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Classes
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
