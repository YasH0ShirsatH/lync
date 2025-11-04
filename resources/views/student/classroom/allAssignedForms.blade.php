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

        .classroom-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .classroom-header {
            background: linear-gradient(135deg, #495057 0%, #6c757d 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: 3px solid #007bff;
        }

        .form-item {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.3s ease;
            position: relative;
        }

        .form-item:last-child {
            border-bottom: none;
        }

        .form-item:hover {
            background: #f8f9fa;
            transform: translateX(5px);
        }

        .form-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .form-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-meta {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-updated {
            background: #ffeaa7;
            color: #d68910;
            border: 1px solid #f39c12;
        }

        .arrow-icon {
            color: #007bff;
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .form-item:hover .arrow-icon {
            transform: translateX(5px);
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
            padding: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
            font-weight: 500;
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
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="header-section">
    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Assigned Forms</li>
            </ol>
        </nav>
        <div class="text-center">
            <h1 class="display-5 fw-bold mb-2">
                <i class="fas fa-clipboard-list me-3"></i>All Assigned Forms
            </h1>
            <p class="lead mb-0 opacity-75">Complete your assignments organized by classroom</p>
        </div>
    </div>
</div>

<div class="container pb-5">
    @php
        $totalForms = 0;
        $completedForms = 0;
        foreach($joinedClassrooms as $classroomStudent) {
            $totalForms += $classroomStudent->classroom->classroomForms->count();
            foreach($classroomStudent->classroom->classroomForms as $form) {
                if(in_array($form->form_id, $submittedFormIds)) {
                    $completedForms++;
                }
            }
        }
    @endphp

    @if($totalForms > 0)
        <div class="stats-section">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $totalForms }}</div>
                        <div class="stat-label">Total Forms</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number text-success">{{ $completedForms }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number text-warning">{{ $totalForms - $completedForms }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @forelse($joinedClassrooms as $classroomStudent)
        @if($classroomStudent->classroom->classroomForms->count() > 0)
            <div class="classroom-card">
                <div class="classroom-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0 fw-bold">
                            <i class="fas fa-graduation-cap me-2"></i>
                            {{ $classroomStudent->classroom->name }}
                        </h3>
                        <small class="opacity-75">
                            {{ $classroomStudent->classroom->classroomForms->count() }}
                            {{ $classroomStudent->classroom->classroomForms->count() == 1 ? 'form' : 'forms' }}
                        </small>
                    </div>
                </div>

                @foreach($classroomStudent->classroom->classroomForms as $classroomForm)
                    <div class="form-item">
                        <a href="{{ route('student.showForm', [$classroomStudent->classroom->id, $classroomForm->id]) }}" class="form-link">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="form-title mb-1">
                                        <i class="fas fa-file-alt me-2 text-primary"></i>
                                        {{ $classroomForm->form->title }}
                                    </h5>
                                    <div class="form-meta">
                                        <i class="fas fa-user me-1"></i>
                                        Assigned by {{ $classroomStudent->classroom->teacher->name }}
                                        <span class="mx-2">•</span>
                                        <i class="fas fa-calendar me-1"></i>
                                        {{ $classroomForm->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    @if(in_array($classroomForm->form_id, $submittedFormIds))
                                        @php
                                            $submission = $formSubmissions->get($classroomForm->form_id);
                                            $isUpdated = $submission && $classroomForm->form->updated_at > $submission->form_version;
                                        @endphp
                                        @if($isUpdated)
                                            <span class="status-badge status-updated me-2">
                                                <i class="fas fa-sync-alt me-1"></i>Updated
                                            </span>
                                        @else
                                            <span class="status-badge status-completed me-2">
                                                <i class="fas fa-check me-1"></i>Completed
                                            </span>
                                        @endif
                                        @if($submission && ($submission->rating !== null || $submission->comment))
                                            <span class="status-badge status-completed me-2">
                                                <i class="fas fa-comment me-1"></i>Teacher Feedback
                                            </span>
                                        @endif
                                    @else
                                        <span class="status-badge status-pending me-2">
                                            <i class="fas fa-clock me-1"></i>Pending
                                        </span>
                                    @endif
                                    <i class="fas fa-chevron-right arrow-icon"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    @empty
        <div class="empty-state">
            <i class="fas fa-clipboard-list empty-icon"></i>
            <h4 class="mb-3">No Forms Assigned</h4>
            <p class="text-muted mb-4">You haven't been assigned any forms yet. Check back later for new assignments.</p>
            <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
            </a>
        </div>
    @endforelse
</div>

</body>
</html>
