<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All Assigned Forms - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --success-500: #22c55e;
            --warning-500: #f59e0b;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        .container {
            max-width: 1350px;
        }

        .page-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: var(--primary-600);
            text-decoration: none;
        }

        .page-title {
            color: var(--gray-900);
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            margin: 0;
        }

        .stats-overview {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .stat-card {
            text-align: center;
            padding: 1rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--gray-600);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stat-card.primary .stat-number { color: var(--primary-600); }
        .stat-card.success .stat-number { color: var(--success-500); }
        .stat-card.warning .stat-number { color: var(--warning-500); }

        .classroom-section {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            margin-bottom: 2rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .classroom-header {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .classroom-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .form-count {
            background: rgba(255, 255, 255, 0.2);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .form-item {
            padding: 1.5rem 2rem;
            border-bottom: 1px solid var(--gray-100);
            transition: all 0.2s ease;
        }

        .form-item:last-child {
            border-bottom: none;
        }

        .form-item:hover {
            background: var(--gray-50);
        }

        .form-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .form-title {
            color: var(--gray-900);
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-meta {
            color: var(--gray-600);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-updated {
            background: #fef3c7;
            color: #d97706;
        }

        .status-feedback {
            background: #dcfce7;
            color: #16a34a;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 1rem;
            border: 1px solid var(--gray-200);
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--gray-500);
            margin-bottom: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            border: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
        }
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">All Assigned Forms</li>
            </ol>
        </nav>
        <h1 class="page-title">All Assigned Forms</h1>
        <p class="page-subtitle">Complete your assignments organized by classroom</p>
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
        <div class="stats-overview">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card primary">
                        <div class="stat-number">{{ $totalForms }}</div>
                        <div class="stat-label">Total Forms</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card success">
                        <div class="stat-number">{{ $completedForms }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card warning">
                        <div class="stat-number">{{ $totalForms - $completedForms }}</div>
                        <div class="stat-label">Pending</div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @forelse($joinedClassrooms as $classroomStudent)
        @if($classroomStudent->classroom->classroomForms->count() > 0)
            <div class="classroom-section">
                <div class="classroom-header">
                    <h3 class="classroom-title">
                        <i class="fas fa-graduation-cap me-2"></i>
                        {{ $classroomStudent->classroom->name }}
                    </h3>
                    <span class="form-count">
                        {{ $classroomStudent->classroom->classroomForms->count() }} forms
                    </span>
                </div>

                @foreach($classroomStudent->classroom->classroomForms as $classroomForm)
                    <div class="form-item">
                        <a href="{{ route('student.showForm', [$classroomStudent->classroom->id, $classroomForm->id]) }}" class="form-link">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="flex-grow-1">
                                    <h5 class="form-title">
                                        <i class="fas fa-file-alt me-2 text-primary"></i>
                                        {{ $classroomForm->form->title }}
                                    </h5>
                                    <div class="form-meta">
                                        <span><i class="fas fa-user me-1"></i>{{ $classroomStudent->classroom->teacher->name }}</span>
                                        <span><i class="fas fa-calendar me-1"></i>{{ $classroomForm->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    @if(in_array($classroomForm->form_id, $submittedFormIds))
                                        @php
                                            $submission = $formSubmissions->get($classroomForm->form_id);
                                            $isUpdated = $submission && $classroomForm->form->updated_at > $submission->form_version;
                                        @endphp
                                        @if($isUpdated)
                                            <span class="status-badge status-updated">
                                                <i class="fas fa-sync-alt"></i>Updated
                                            </span>
                                        @else
                                            <span class="status-badge status-completed">
                                                <i class="fas fa-check"></i>Completed
                                            </span>
                                        @endif
                                        @if($submission && ($submission->rating !== null || $submission->comment))
                                            <span class="status-badge status-feedback">
                                                <i class="fas fa-comment"></i>Teacher Feedback
                                            </span>
                                        @endif
                                    @else
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock"></i>Pending
                                        </span>
                                    @endif
                                    <i class="fas fa-chevron-right text-primary"></i>
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