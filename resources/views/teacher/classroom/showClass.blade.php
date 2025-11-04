<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classroom Forms - Lync</title>
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
            --accent: #3b82f6;
            --accent-hover: #2563eb;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            min-height: 100vh;
        }

        .container {
            max-width: 1400px;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(255,255,255,0.1);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .page-title {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        /* Cards */
        .class-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(0,0,0,0.12);
        }

        .card-header {
            background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-secondary));
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .card-title {
            color: var(--text-primary);
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
            background: white;
        }

        /* Form Cards */
        .form-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .form-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
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
        }

        .form-title {
            color: #1e293b;
            font-weight: 600;
            font-size: 1rem;
            margin: 0;
        }

        /* Student Cards */
        .student-card {
            background: white;
            border-radius: 12px;
            padding: 1.25rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .student-card:hover {
            border-color: #cbd5e1;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transform: translateY(-2px);
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .student-name {
            color: #1e293b;
            font-weight: 600;
        }

        .student-email {
            color: #64748b;
            font-size: 0.875rem;
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
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            background: transparent;
        }

        .btn-outline-light:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
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

        .btn-warning {
            background: #fef3c7;
            color: #92400e;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-warning:hover {
            background: #fde68a;
            color: #78350f;
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #fecaca;
            color: #991b1b;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-danger:hover {
            background: #fca5a5;
            color: #7f1d1d;
            transform: translateY(-1px);
        }

        .btn-success {
            background: #d1fae5;
            color: #065f46;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .btn-success:hover {
            background: #a7f3d0;
            color: #064e3b;
            transform: translateY(-1px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .card-body {
                padding: 1.5rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .btn-group {
                flex-direction: column;
                gap: 0.5rem;
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
                    @if($classforms->count() > 0 && $classforms->first()->classroom)
                        <h1 class="page-title">
                            <i class="fas fa-school me-3"></i>{{ $classforms->first()->classroom->name }}
                        </h1>
                    @else
                        <h1 class="page-title">
                            <i class="fas fa-clipboard-list me-3"></i>Classroom Forms
                        </h1>
                    @endif
                </div>
                <a href="{{ route('teacher.classroom.setup') }}" class="btn btn-outline-light btn-sm mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-1"></i>Back to Classrooms
                </a>
            </div>
        </div>

        <div class="row">
            <!-- Forms Section -->
            <div class="col-lg-6">
                <div class="class-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="card-title">
                                <i class="fas fa-file-alt me-2"></i>Assigned Forms
                            </h3>
                            <a href="{{ route('teacher.formBuilder') }}" class="btn btn-outline-light btn-sm">
                                <i class="fas fa-plus me-1"></i>Add Form
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($classforms->count() > 0)
                            <div class="row g-3">
                                @foreach($classforms as $classform)
                                    <div class="col-12">
                                        <div class="form-card">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="form-icon me-3">
                                                    <i class="fas fa-file-alt"></i>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="form-title mb-1">{{ $classform->form->title }}</h6>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i>{{ $classform->form->created_at->format('M d, Y') }}
                                                    </small>
                                                </div>
                                            </div>
                                            
                                            @if($classform->allClassrooms && $classform->allClassrooms->count() > 1)
                                                <div class="mb-3">
                                                    <small class="text-muted d-block mb-1">Also in:</small>
                                                    @foreach($classform->allClassrooms as $otherClassroom)
                                                        @if($otherClassroom->classroom_id != $classform->classroom_id)
                                                            <span class="badge bg-light text-dark me-1">{{ $otherClassroom->classroom->name }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                            
                                            <div class="d-flex gap-2 flex-wrap">
                                                <a href="{{ route('teacher.showForm', $classform->form->id) }}" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </a>
                                                <a href="{{ route('teacher.editForm', $classform->form->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                                <a href="{{ route('teacher.classroom.viewResponses', [$classform->classroom_id, $classform->form_id]) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-chart-bar me-1"></i>Responses
                                                </a>
                                                <a href="{{ route('teacher.classroom.removeForm', [$classform->classroom_id, $classform->form_id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Remove this form?')">
                                                    <i class="fas fa-trash me-1"></i>Remove
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-file-alt"></i>
                                <h5 class="mt-3 mb-2">No Forms Assigned</h5>
                                <p class="text-muted mb-3">This classroom doesn't have any forms yet.</p>
                                <a href="{{ route('teacher.formBuilder') }}" class="btn btn-primary">
                                    <i class="fas fa-plus me-2"></i>Create First Form
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Students Section -->
            <div class="col-lg-6">
                <div class="class-card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-users me-2"></i>Students ({{ $students->count() }})
                        </h3>
                    </div>
                    <div class="card-body">
                        @if($students->count() > 0)
                            <div class="row g-3">
                                @foreach($students as $student)
                                    <div class="col-12">
                                        <div class="student-card">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <div class="student-avatar me-3">
                                                        {{ strtoupper(substr($student->student->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <h6 class="student-name mb-1">{{ $student->student->name }}</h6>
                                                        <small class="student-email">{{ $student->student->email }}</small>
                                                    </div>
                                                </div>
                                                
                                                <a href="{{ route('teacher.classroom.viewStudentResponses', [$id, $student->student_id]) }}" class="btn btn-success btn-sm">
                                                    <i class="fas fa-chart-line me-1"></i>Responses
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-user-plus"></i>
                                <h5 class="mt-3 mb-2">No Students Enrolled</h5>
                                <p class="text-muted">Students can join using the classroom code.</p>
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