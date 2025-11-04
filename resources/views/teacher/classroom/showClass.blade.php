<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classroom Forms - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-50: #f0f9ff;
            --primary-100: #e0f2fe;
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --primary-800: #075985;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --success-50: #f0fdf4;
            --success-500: #22c55e;
            --success-600: #16a34a;
            --warning-50: #fffbeb;
            --warning-500: #f59e0b;
            --danger-50: #fef2f2;
            --danger-500: #ef4444;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px 0 rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1);
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
        }

        body {
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--gray-800);
            min-height: 100vh;
            line-height: 1.6;
        }

        /* Page Header */
        .page-header-wrapper {
            padding: 2rem 0 3rem;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: var(--white);
            padding: 3rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
            border-radius: var(--radius-2xl);
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-xl);
        }

        .page-title {
            color: var(--white);
            font-weight: 700;
            font-size: 2.25rem;
            margin: 0 0 0.5rem 0;
            line-height: 1.2;
            letter-spacing: -0.025em;
        }

        .page-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            font-weight: 400;
            line-height: 1.4;
        }

        /* Main Content Layout */
        .dashboard-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 4rem;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }

        /* Cards */
        .class-card {
            background: var(--white);
            border-radius: var(--radius-2xl);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            height: fit-content;
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--gray-300);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            padding: 2rem 2rem 1.5rem;
            border-bottom: none;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 2rem;
            right: 2rem;
            height: 1px;
            background: rgba(255, 255, 255, 0.2);
        }

        .card-title {
            color: var(--white);
            font-weight: 600;
            font-size: 1.375rem;
            margin: 0;
            line-height: 1.3;
        }

        .card-body {
            padding: 2rem;
            background: var(--white);
        }

        /* Form Cards */
        .form-card {
            background: var(--white);
            border-radius: var(--radius-lg);
            padding: 1.25rem;
            border: 1px solid var(--gray-200);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-500), var(--primary-600));
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .form-card:hover {
            border-color: var(--primary-200);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .form-card:hover::before {
            opacity: 1;
        }

        .form-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .form-main-info {
            display: flex;
            align-items: center;
            flex: 1;
        }

        .form-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .form-meta {
            flex: 1;
            min-width: 0;
        }

        .form-title {
            color: var(--gray-900);
            font-weight: 600;
            font-size: 1rem;
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
        }

        .form-date {
            color: var(--gray-500);
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .form-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-item {
            text-align: center;
            flex: 1;
        }

        .stat-value {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.125rem;
        }

        .stat-label {
            font-size: 0.625rem;
            color: var(--gray-500);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 600;
        }

        .form-classrooms {
            margin-bottom: 1rem;
        }

        .classroom-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.125rem 0.5rem;
            background: var(--gray-100);
            color: var(--gray-600);
            border-radius: 9999px;
            font-size: 0.625rem;
            font-weight: 500;
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
            border: 1px solid var(--gray-200);
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .classroom-badge:hover {
            background: var(--primary-50);
            color: var(--primary-700);
            border-color: var(--primary-200);
            text-decoration: none;
        }

        .form-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }

        .form-actions .btn {
            padding: 0.5rem 0.75rem;
            font-weight: 500;
            font-size: 0.75rem;
            border-radius: var(--radius-md);
            transition: all 0.2s ease;
        }

        /* Student Cards */
        .student-card {
            background: var(--gray-50);
            border-radius: var(--radius-xl);
            padding: 1.75rem;
            border: 1px solid var(--gray-200);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            margin-bottom: 1.5rem;
        }

        .student-card:hover {
            background: var(--white);
            border-color: var(--primary-200);
            box-shadow: var(--shadow-lg);
            transform: translateY(-3px);
        }

        .student-header {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .student-avatar {
            width: 52px;
            height: 52px;
            background: linear-gradient(135deg, var(--success-500), var(--success-600));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-weight: 600;
            font-size: 1.25rem;
            margin-right: 1.25rem;
            box-shadow: var(--shadow-md);
            flex-shrink: 0;
        }

        .student-info {
            flex: 1;
            min-width: 0;
        }

        .student-name {
            color: var(--gray-900);
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0 0 0.375rem 0;
            line-height: 1.4;
        }

        .student-email {
            color: var(--gray-500);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .student-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin: 1.25rem 0;
            padding: 1.25rem;
            background: var(--white);
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
        }

        .student-actions {
            margin-top: 1.5rem;
        }

        .student-actions .btn {
            padding: 0.875rem 1.25rem;
            font-weight: 600;
            font-size: 0.875rem;
            border-radius: var(--radius-md);
        }

        /* Section Headers */
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.375rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0;
            line-height: 1.3;
        }

        .section-count {
            background: rgba(255, 255, 255, 0.2);
            color: var(--white);
            padding: 0.375rem 0.875rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-left: 1rem;
            backdrop-filter: blur(10px);
        }

        /* Grid Layouts */
        .forms-grid {
            display: grid;
            gap: 1.5rem;
        }

        .students-grid {
            display: grid;
            gap: 1.5rem;
        }

        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            border: none;
            font-size: 0.875rem;
        }

        .btn-outline-light {
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: var(--white);
            background: transparent;
        }

        .btn-outline-light:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.5);
            color: var(--white);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: var(--primary-50);
            color: var(--primary-700);
            border: 1px solid var(--primary-200);
        }

        .btn-primary:hover {
            background: var(--primary-100);
            color: var(--primary-800);
            transform: translateY(-1px);
        }

        .btn-warning {
            background: var(--warning-50);
            color: var(--warning-700);
            border: 1px solid var(--warning-200);
        }

        .btn-warning:hover {
            background: var(--warning-100);
            color: var(--warning-800);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: var(--danger-50);
            color: var(--danger-700);
            border: 1px solid var(--danger-200);
        }

        .btn-danger:hover {
            background: var(--danger-100);
            color: var(--danger-800);
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--success-50);
            color: var(--success-700);
            border: 1px solid var(--success-200);
        }

        .btn-success:hover {
            background: var(--success-100);
            color: var(--success-800);
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 5rem 2rem;
            color: var(--gray-600);
        }

        .empty-state-icon {
            width: 96px;
            height: 96px;
            margin: 0 auto 2rem;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--gray-400);
        }

        .empty-state-title {
            font-size: 1.375rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }

        .empty-state-description {
            font-size: 1rem;
            color: var(--gray-500);
            margin-bottom: 2.5rem;
            line-height: 1.5;
        }



        .empty-state .btn-primary {
            background: var(--primary-500);
            color: var(--white);
            border: none;
            border-radius: var(--radius-md);
            padding: 0.75rem 2rem;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .empty-state .btn-primary:hover {
            background: var(--primary-600);
            transform: translateY(-1px);
            color: var(--white);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 0 1rem 3rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .card-header {
                padding: 1.5rem 1.5rem 1rem;
            }

            .page-header {
                padding: 2rem 1.5rem;
            }

            .page-title {
                font-size: 1.875rem;
            }

            .form-actions {
                grid-template-columns: 1fr;
            }

            .form-stats,
            .student-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="page-header-wrapper">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    @if ($classforms->count() > 0 && $classforms->first()->classroom)
                        <h1 class="page-title">
                            <i class="fas fa-school me-3"></i>{{ $classforms->first()->classroom->name }}
                        </h1>
                        <p class="mb-0" style="opacity: 0.9; font-size: 1.125rem;">Manage forms and track student progress</p>
                    @else
                        <h1 class="page-title">
                            <i class="fas fa-clipboard-list me-3"></i>Classroom Forms
                        </h1>
                        <p class="mb-0" style="opacity: 0.9; font-size: 1.125rem;">No classroom data available</p>
                    @endif
                </div>
                <a href="{{ route('teacher.classroom.setup') }}" class="btn btn-outline-light btn-sm mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-1"></i>Back to Classrooms
                </a>
            </div>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="dashboard-grid">
            <!-- Forms Section -->
            <div class="forms-section">
                <div class="class-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <h3 class="card-title">
                                    <i class="fas fa-file-alt me-2"></i>Assigned Forms
                                </h3>
                                <span class="section-count">{{ $classforms->count() }}</span>
                            </div>
                            <a href="{{ route('teacher.formBuilder') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-plus me-1"></i>Add Form
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($classforms->count() > 0)
                            <div class="forms-grid">
                                @foreach($classforms as $classform)
                                    <div class="form-card">
                                        <div class="form-header">
                                            <div class="form-main-info">
                                                <div class="form-icon">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                                <div class="form-meta">
                                                    <h6 class="form-title">{{ $classform->form->title }}</h6>
                                                    <div class="form-date">
                                                        <i class="fas fa-calendar"></i>
                                                        <span>{{ $classform->form->created_at->format('M d, Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-stats">
                                            <div class="stat-item">
                                                <div class="stat-value">{{ $classform->form->submissions ? $classform->form->submissions->count() : 0 }}</div>
                                                <div class="stat-label">Responses</div>
                                            </div>
                                            <div class="stat-item">
                                                <div class="stat-value" style="font-size: 0.875rem;">{{ $classform->form->created_at->diffForHumans() }}</div>
                                                <div class="stat-label">Created</div>
                                            </div>
                                        </div>

                                        @if($classform->allClassrooms && $classform->allClassrooms->count() > 1)
                                            <div class="form-classrooms">
                                                <small class="text-muted d-block mb-1" style="font-size: 0.625rem;">Also in:</small>
                                                @foreach($classform->allClassrooms as $otherClassroom)
                                                    @if($otherClassroom->classroom_id != $classform->classroom_id)
                                                        <a href="/teacher/classroom/show/{{ $otherClassroom->classroom_id }}" class="classroom-badge">
                                                            {{ $otherClassroom->classroom->name }}
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="form-actions">
                                            <a href="{{ route('teacher.showForm', $classform->form->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="{{ route('teacher.editForm', $classform->form->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('teacher.classroom.viewResponses', [$classform->classroom_id, $classform->form_id]) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-chart-bar"></i> Data
                                            </a>
                                            <a href="{{ route('teacher.classroom.removeForm', [$classform->classroom_id, $classform->form_id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Remove this form?')">
                                                <i class="fas fa-trash"></i> Remove
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <h3 class="empty-state-title">No Forms Assigned</h3>
                                <p class="empty-state-description">This classroom doesn't have any forms yet. Create your first form to get started.</p>
                                <a href="{{ route('teacher.formBuilder') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create First Form
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Students Section -->
            <div class="students-section">
                <div class="class-card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-users me-2"></i>Students
                            </h3>
                            <span class="section-count">{{ $students->count() }}</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($students->count() > 0)
                            <div class="students-grid">
                                @foreach($students as $student)
                                    <div class="student-card">
                                        <div class="student-header">
                                            <div class="student-avatar">
                                                {{ strtoupper(substr($student->student->name, 0, 1)) }}
                                            </div>
                                            <div class="student-info">
                                                <h6 class="student-name">{{ $student->student->name }}</h6>
                                                <div class="student-email">
                                                    <i class="fas fa-envelope"></i>
                                                    <span>{{ $student->student->email }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="student-stats">
                                            <div class="stat-item">
                                                <div class="stat-value">{{ $student->student->submissions ? $student->student->submissions->count() : 0 }}</div>
                                                <div class="stat-label">Submissions</div>
                                            </div>
                                            <div class="stat-item">
                                                <div class="stat-value" style="font-size: 0.875rem;">{{ $student->created_at->format('M Y') }}</div>
                                                <div class="stat-label">Joined</div>
                                            </div>
                                        </div>

                                        <div class="student-actions">
                                            <a href="{{ route('teacher.classroom.viewStudentResponses', [$id, $student->student_id]) }}" class="btn btn-success btn-sm w-100">
                                                <i class="fas fa-chart-line me-1"></i>View Responses
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <h3 class="empty-state-title">No Students Enrolled</h3>
                                <p class="empty-state-description">Students can join this classroom using the classroom access code.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
