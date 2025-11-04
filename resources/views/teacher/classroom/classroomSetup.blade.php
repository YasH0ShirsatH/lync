<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classroom Setup - Lync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, var(--gray-50) 0%, var(--gray-100) 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        /* Page Header */
        .page-header {
            padding: 2rem 0;
        }

        .page-header-content {
            background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
            color: var(--white);
            padding: 3rem 1.5rem;
            max-width: 1350px;
            margin: 0 auto;
            border-radius: var(--radius-2xl);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .page-subtitle {
            font-size: 1.125rem;
            opacity: 0.9;
            position: relative;
            z-index: 2;
        }

        /* Flash Messages */
        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 320px;
            border-radius: var(--radius-xl);
            border: none;
            box-shadow: var(--shadow-xl);
            backdrop-filter: blur(10px);
        }

        .flash-success {
            background: linear-gradient(135deg, var(--success-500), var(--success-600));
            color: var(--white);
        }

        .flash-error {
            background: linear-gradient(135deg, var(--danger-500), #dc2626);
            color: var(--white);
        }

        /* Classroom Grid */
        .classrooms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        /* Classroom Cards */
        .classroom-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }

        .classroom-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-500), var(--primary-600));
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .classroom-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-xl);
            border-color: var(--gray-300);
        }

        .classroom-card:hover::before {
            opacity: 1;
        }

        .classroom-header {
            padding: 1.5rem 1.5rem 1rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .classroom-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--gray-900);
            margin: 0 0 0.5rem 0;
            line-height: 1.3;
        }

        .classroom-description {
            color: var(--gray-600);
            font-size: 0.875rem;
            line-height: 1.5;
            margin: 0;
        }

        .classroom-metrics {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            padding: 1.5rem;
        }

        .metric-card {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-lg);
            padding: 1rem;
            text-align: center;
            transition: all 0.2s ease;
        }

        .metric-card:hover {
            background: var(--primary-50);
            border-color: var(--primary-200);
        }

        .metric-icon {
            width: 40px;
            height: 40px;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 0.75rem;
            font-size: 1rem;
        }

        .metric-icon.students {
            background: var(--primary-50);
            color: var(--primary-600);
        }

        .metric-icon.forms {
            background: var(--success-50);
            color: var(--success-600);
        }

        .metric-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--gray-900);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .metric-label {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .classroom-actions {
            padding: 1rem 1.5rem;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
        }

        .classroom-footer {
            padding: 1rem 1.5rem;
            background: var(--gray-50);
            border-top: 1px solid var(--gray-200);
            font-size: 0.75rem;
            color: var(--gray-500);
        }

        /* Action Buttons */
        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .action-btn.primary {
            background: var(--primary-500);
            color: var(--white);
            border-color: var(--primary-500);
        }

        .action-btn.primary:hover {
            background: var(--primary-600);
            color: var(--white);
            transform: translateY(-1px);
        }

        .action-btn.secondary {
            background: var(--white);
            color: var(--gray-700);
            border-color: var(--gray-300);
        }

        .action-btn.secondary:hover {
            background: var(--gray-50);
            color: var(--gray-800);
            border-color: var(--gray-400);
        }

        /* Dropdown Menu */
        .dropdown-toggle {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-md);
            padding: 0.5rem;
            color: var(--gray-600);
            transition: all 0.2s ease;
        }

        .dropdown-toggle:hover {
            background: var(--gray-200);
            color: var(--gray-700);
        }

        .dropdown-menu {
            border-radius: var(--radius-lg);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-lg);
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: var(--radius-md);
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: var(--gray-50);
        }

        .dropdown-item.text-danger:hover {
            background: var(--danger-50);
            color: var(--danger-700);
        }

        /* Modal */
        .modal-content {
            border-radius: var(--radius-2xl);
            border: none;
            box-shadow: var(--shadow-xl);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-600), var(--primary-700));
            color: var(--white);
            border-radius: var(--radius-2xl) var(--radius-2xl) 0 0;
            border: none;
            padding: 1.5rem;
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.25rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border-radius: var(--radius-md);
            border: 1px solid var(--gray-300);
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
            font-size: 0.875rem;
        }

        .form-control:focus {
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--gray-400);
        }

        .modal-footer {
            border: none;
            padding: 1.5rem 2rem 2rem;
            gap: 0.75rem;
        }

        /* Empty State */
        .empty-state {
            background: var(--white);
            border: 2px dashed var(--gray-300);
            border-radius: var(--radius-2xl);
            padding: 4rem 2rem;
            text-align: center;
            margin: 2rem 0;
        }

        .empty-state-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: var(--gray-100);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: var(--gray-400);
        }

        .empty-state-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .empty-state-description {
            font-size: 1rem;
            color: var(--gray-600);
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .classrooms-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .classroom-metrics {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert flash-message flash-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('delete'))
        <div class="alert flash-message flash-error alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-trash me-2"></i>
                <span>{{ session('delete') }}</span>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-school me-3"></i>My Classrooms
                    </h1>
                    <p class="page-subtitle mb-0">Manage your learning spaces and student communities</p>
                </div>
                <div class="d-flex gap-3">
                    <button class="action-btn primary" data-bs-toggle="modal" data-bs-target="#createClassroomModal">
                        <i class="fas fa-plus"></i>
                        <span>New Classroom</span>
                    </button>
                    <a href="{{ route('teacher.dashboard') }}" class="action-btn secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container" style="max-width: 1400px; margin: 0 auto; padding: 0 1.5rem 5rem;">
        @if ($classrooms->count() > 0)
            <div class="classrooms-grid">
                @foreach ($classrooms as $classroom)
                    <div class="classroom-card">
                        <!-- Classroom Header -->
                        <div class="classroom-header">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <h3 class="classroom-title">{{ $classroom->name }}</h3>
                                    <p class="classroom-description">
                                        {{ $classroom->description ?: 'A collaborative learning environment for students to engage with course materials and assignments.' }}
                                    </p>
                                </div>
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li>
                                            <a class="dropdown-item text-danger"
                                                href="{{ route('teacher.deleteClass', $classroom->id) }}"
                                                onclick="return confirm('Delete this classroom?');">
                                                <i class="fas fa-trash me-2"></i>Delete Classroom
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Classroom Metrics -->
                        <div class="classroom-metrics">
                            <div class="metric-card">
                                <div class="metric-icon students">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="metric-value">{{ $classroom->students ? $classroom->students->count() : 0 }}
                                </div>
                                <div class="metric-label">Students</div>
                            </div>
                            <div class="metric-card">
                                <div class="metric-icon forms">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="metric-value">
                                    {{ $classroom->classroomForms ? $classroom->classroomForms->count() : 0 }}</div>
                                <div class="metric-label">Forms</div>
                            </div>
                        </div>

                        <!-- Classroom Actions -->
                        <div class="classroom-actions">
                            <a href="{{ route('teacher.classroom.show', $classroom->id) }}"
                                class="action-btn primary w-100">
                                <i class="fas fa-arrow-right"></i>
                                <span>Enter Classroom</span>
                            </a>
                        </div>

                        <!-- Classroom Footer -->
                        <div class="classroom-footer">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-calendar me-2"></i>
                                <span>Created {{ $classroom->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="fas fa-school"></i>
                </div>
                <h3 class="empty-state-title">No Classrooms Yet</h3>
                <p class="empty-state-description">Create your first classroom to start organizing students and
                    assignments.</p>
                <button class="action-btn primary" data-bs-toggle="modal" data-bs-target="#createClassroomModal">
                    <i class="fas fa-plus"></i>
                    Create Your First Classroom
                </button>
            </div>
        @endif
    </div>

    {{-- Create Classroom Modal --}}
    <div class="modal fade" id="createClassroomModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-plus-circle me-2"></i>Create New Classroom
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('teacher.classroom.save') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-4">
                            <label class="form-label">Classroom Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="class_name"
                                placeholder="e.g., Mathematics Grade 10" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" name="description" rows="3"
                                placeholder="Brief description of this classroom and its purpose..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Access Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password"
                                placeholder="Students will use this to join" required>
                            <small class="text-muted mt-1">Students will need this password to join your
                                classroom</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="action-btn secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i>
                            <span>Cancel</span>
                        </button>
                        <button type="submit" class="action-btn primary">
                            <i class="fas fa-plus"></i>
                            <span>Create Classroom</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide flash messages
        setTimeout(() => {
            const alerts = document.querySelectorAll('.flash-message');
            alerts.forEach(alert => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>

</html>
