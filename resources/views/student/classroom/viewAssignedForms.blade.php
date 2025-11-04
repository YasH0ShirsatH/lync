<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Assigned Forms - {{ $classroom->name }}</title>
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
            --success-50: #f0fdf4;
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

        .form-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .form-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-500);
        }

        .form-card.completed {
            border-color: var(--success-500);
        }

        .form-card.completed:hover {
            border-color: var(--success-500);
        }

        .form-header {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .form-card.completed .form-header {
            background: linear-gradient(135deg, var(--success-500) 0%, #16a34a 100%);
        }

        .status-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            backdrop-filter: blur(10px);
        }

        .form-icon {
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .form-icon i {
            font-size: 1.25rem;
            color: white;
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .form-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 140px);
        }

        .form-info {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 0.5rem;
            border-left: 4px solid var(--primary-500);
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .form-card.completed .form-info {
            border-left-color: var(--success-500);
        }

        .info-text {
            color: var(--gray-600);
            margin: 0;
            line-height: 1.5;
            font-size: 0.875rem;
        }

        .feedback-badge {
            background: var(--success-50);
            color: var(--success-500);
            border: 1px solid #dcfce7;
            border-radius: 9999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.75rem;
        }

        .action-button {
            margin-top: auto;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            width: 100%;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-500) 0%, #16a34a 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
            color: white;
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
    </style>
</head>
<body>
@include('layouts.navbar')

<div class="page-header">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('student.viewJoinedClasses') }}">Your Classrooms</a></li>
                <li class="breadcrumb-item active">{{ $classroom->name }}</li>
            </ol>
        </nav>
        <h1 class="page-title">{{ $classroom->name }}</h1>
        <p class="page-subtitle">Complete your assigned forms and activities</p>
    </div>
</div>

<div class="container pb-5">
    @if($forms->count() > 0)
        <div class="stats-overview">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card primary">
                        <div class="stat-number">{{ $forms->count() }}</div>
                        <div class="stat-label">Total Forms</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card success">
                        <div class="stat-number">{{ count($submittedFormIds) }}</div>
                        <div class="stat-label">Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card warning">
                        <div class="stat-number">{{ $forms->count() - count($submittedFormIds) }}</div>
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
                                <strong>Status:</strong> {{ in_array($form->form_id, $submittedFormIds) ? 'Submitted' : 'Pending Completion' }}<br>
                                <strong>Assigned:</strong> {{ $form->created_at->format('M d, Y') }}
                            </p>
                            @if(in_array($form->form_id, $submittedFormIds) && isset($submissions[$form->form_id]))
                                @php $submission = $submissions[$form->form_id]; @endphp
                                @if($submission->rating !== null || $submission->comment)
                                    <div class="feedback-badge">
                                        <i class="fas fa-comment"></i>Teacher Feedback
                                    </div>
                                @endif
                            @endif
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