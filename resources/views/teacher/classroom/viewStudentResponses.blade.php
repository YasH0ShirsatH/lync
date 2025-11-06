<!DOCTYPE html>
<html>
<head>
    <title>{{ $student->name }} - All Responses</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0ea5e9;
            --primary-blue-dark: #0369a1;
            --secondary-blue: #0284c7;
            --accent-blue: #38bdf8;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-300: #cbd5e1;
            --neutral-400: #94a3b8;
            --neutral-500: #64748b;
            --neutral-600: #475569;
            --neutral-700: #334155;
            --neutral-800: #1e293b;
            --neutral-900: #0f172a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--neutral-800);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.875rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            position: relative;
            z-index: 1;
        }

        .btn-back {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.3);
            color: white;
            transform: translateY(-1px);
        }

        /* Student Profile Section */
        .student-profile {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            position: relative;
        }

        .student-profile::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue));
            border-radius: 16px 16px 0 0;
        }

        .student-main-info {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .student-avatar-large {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 2rem;
            margin-right: 1.5rem;
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.2);
        }

        .student-details h3 {
            color: var(--neutral-800);
            font-weight: 600;
            font-size: 1.5rem;
            margin: 0 0 0.5rem 0;
            line-height: 1.3;
        }

        .student-email {
            color: var(--neutral-500);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .student-joined {
            color: var(--neutral-400);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Enhanced Stats Section */
        .stats-section {
            margin-bottom: 2rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            transition: all 0.2s ease;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin: 0 auto 1rem;
        }

        .stat-icon.submissions {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .stat-icon.forms {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon.latest {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--neutral-800);
            margin: 0;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--neutral-500);
            margin: 0.5rem 0 0 0;
            font-weight: 500;
        }

        /* Response Cards */
        .responses-section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--neutral-800);
            margin: 0;
        }

        .responses-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .response-card {
            background: white;
            border-radius: 12px;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .response-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: var(--primary-blue);
        }

        .response-header {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            padding: 1.25rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .response-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .response-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .form-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.125rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .form-details h6 {
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
            color: var(--neutral-800);
            line-height: 1.3;
        }

        .submission-meta {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            margin-top: 0.5rem;
        }

        .submission-date {
            color: var(--neutral-500);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .grade-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .grade-badge.graded {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .grade-badge.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        .response-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .btn-primary {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
            padding: 0.5rem 1rem;
        }

        .btn-primary:hover {
            background: var(--primary-blue-dark);
            border-color: var(--primary-blue-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-outline-primary {
            border: 1px solid var(--primary-blue);
            color: var(--primary-blue);
            background: transparent;
            padding: 0.5rem 1rem;
        }

        .btn-outline-primary:hover {
            background: var(--primary-blue);
            color: white;
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 12px;
            border: 1px solid var(--neutral-200);
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            background: var(--neutral-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--neutral-400);
            font-size: 2rem;
        }

        .empty-state h4 {
            color: var(--neutral-700);
            margin-bottom: 0.75rem;
            font-weight: 600;
        }

        .empty-state p {
            color: var(--neutral-500);
            margin: 0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 0.75rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .student-profile {
                padding: 1.5rem;
            }

            .student-main-info {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }

            .student-avatar-large {
                margin-right: 0;
                margin-bottom: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .response-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .response-actions {
                width: 100%;
                justify-content: flex-end;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-4">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-user-graduate me-2"></i>Student Performance
                    </h1>
                    <p class="page-subtitle">{{ $classroom->name }} • Individual Progress Report</p>
                </div>
                <a href="{{ route('teacher.classroom.show', $classroom->id) }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Classroom
                </a>
            </div>
        </div>

        <!-- Student Profile -->
        <div class="student-profile">
            <div class="student-main-info">
                <div class="student-avatar-large">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>
                <div class="student-details">
                    <h3>{{ $student->name }}</h3>
                    <div class="student-email">
                        <i class="fas fa-envelope"></i>
                        <span>{{ $student->email }}</span>
                    </div>
                    <div class="student-joined">
                        <i class="fas fa-calendar-plus"></i>
                        <span>Joined {{ $student->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Section -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon submissions">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="stat-number">{{ $submissions->count() }}</div>
                    <div class="stat-label">Total Submissions</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon forms">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $submissions->unique('form_id')->count() }}</div>
                    <div class="stat-label">Forms Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon latest">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $submissions->whereNotNull('rating')->count() }}</div>
                    <div class="stat-label">Graded Responses</div>
                </div>
            </div>
        </div>

        <!-- Responses Section -->
        <div class="responses-section">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="fas fa-list-alt me-2"></i>Form Submissions
                </h2>
            </div>

            <div class="responses-grid">
                @forelse($submissions as $submission)
                    <div class="response-card">
                        <div class="response-header">
                            <div class="response-main">
                                <div class="response-info">
                                    <div class="form-icon">
                                        <i class="fas fa-file-text"></i>
                                    </div>
                                    <div class="form-details">
                                        <h6>{{ $submission->form->title }}</h6>
                                        <div class="submission-meta">
                                            <div class="submission-date">
                                                <i class="fas fa-calendar"></i>
                                                <span>{{ $submission->created_at->diffForHumans() }}</span>
                                            </div>
                                            @if($submission->rating !== null)
                                                <div class="grade-badge graded">
                                                    <i class="fas fa-check-circle me-1"></i>Graded
                                                </div>
                                            @else
                                                <div class="grade-badge pending">
                                                    <i class="fas fa-clock me-1"></i>Pending Review
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="response-actions">
                                    <a href="{{ route('teacher.viewSubmission', $submission->id) }}" class="btn btn-primary">
                                        <i class="fas fa-eye me-1"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <h4>No Submissions Yet</h4>
                        <p>This student hasn't submitted any forms yet. Submissions will appear here once they start completing assigned forms.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>