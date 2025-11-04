<!DOCTYPE html>
<html>
<head>
    <title>{{ $student->name }} - All Responses</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #64748b;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            min-height: 100vh;
        }

        .container {
            max-width: 1200px;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: var(--text-primary);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .page-title {
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1.1rem;
            margin: 0;
        }

        /* Student Profile */
        .student-profile {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .student-avatar-large {
            width: 80px;
            height: 80px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 2rem;
            margin-right: 1.5rem;
        }

        .student-details h3 {
            color: #1e293b;
            font-weight: 600;
            margin: 0;
        }

        .student-details p {
            color: #64748b;
            margin: 0.5rem 0 0 0;
        }

        /* Response Cards */
        .response-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .response-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }

        .response-body {
            padding: 2rem;
            background: white;
        }

        .form-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
            margin-right: 1rem;
        }

        .form-title {
            color: #1e293b;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        .submission-date {
            color: #64748b;
            font-size: 0.875rem;
            margin: 0;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            border: none;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: #e2e8f0;
            color: #475569;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-primary:hover {
            background: #cbd5e1;
            color: #334155;
            transform: translateY(-1px);
        }

        .btn-back {
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }

        /* Stats */
        .stats-row {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }

        .empty-state h4 {
            color: #374151;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .student-profile {
                padding: 1.5rem;
            }

            .response-body {
                padding: 1.5rem;
            }

            .student-avatar-large {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
                margin-right: 1rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-user me-3"></i>Student Responses
                    </h1>
                    <p class="page-subtitle mt-2">{{ $classroom->name }}</p>
                </div>
                <a href="{{ route('teacher.classroom.show', $classroom->id) }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Classroom
                </a>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="student-profile">
            <div class="d-flex align-items-center">
                <div class="student-avatar-large">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div class="student-details">
                    <h3>{{ $student->name }}</h3>
                    <p>{{ $student->email }}</p>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-row">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->count() }}</div>
                        <div class="stat-label">Total Submissions</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->unique('form_id')->count() }}</div>
                        <div class="stat-label">Forms Completed</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->count() > 0 ? $submissions->first()->created_at->format('M d') : '-' }}</div>
                        <div class="stat-label">Latest Submission</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responses -->
        @forelse($submissions as $submission)
            <div class="response-card">
                <div class="response-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center flex-grow-1">
                            <div class="form-icon">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div>
                                <h5 class="form-title">{{ $submission->form->title }}</h5>
                                <p class="submission-date">
                                    <i class="fas fa-calendar me-1"></i>Submitted {{ $submission->created_at->format('M d, Y H:i') }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('teacher.viewSubmission', $submission->id) }}" class="btn btn-primary">
                            <i class="fas fa-eye me-1"></i>View Response
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>No Responses Yet</h4>
                <p>This student hasn't submitted any forms yet.</p>
            </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>