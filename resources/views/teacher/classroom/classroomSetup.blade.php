<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Classroom Setup - Lync</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #1e293b;
            --primary-dark: #0f172a;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --info: #64748b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
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
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }

        /* Flash Messages */
        .flash-message {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .flash-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
        }

        .flash-error {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        /* Cards */
        .classroom-card {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
            background: linear-gradient(90deg, var(--primary), var(--info));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .classroom-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }

        .classroom-card:hover::before {
            opacity: 1;
        }

        .stat-badge {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 12px;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
        }

        /* Modal */
        .modal-content {
            border-radius: 20px;
            border: none;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
        }

        .form-control {
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(30, 41, 59, 0.25);
        }

        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            box-shadow: 0 4px 12px rgba(30, 41, 59, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 41, 59, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
        }

        .btn-outline-secondary:hover {
            background: rgba(255,255,255,0.1);
            border-color: white;
            color: white;
        }

        .dropdown-menu {
            border-radius: 12px;
            border: none;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .empty-state {
            background: white;
            border-radius: 20px;
            border: 2px dashed #d1d5db;
            padding: 4rem 2rem;
            text-align: center;
        }
    </style>
</head>
<body>

    @include('layouts.navbar')

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="alert flash-message flash-success alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('delete'))
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
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div style="position: relative; z-index: 2;">
                    <h1 class="mb-2" style="font-size: 2.5rem; font-weight: 700;">
                        <i class="fas fa-school me-3"></i>My Classrooms
                    </h1>
                    <p class="mb-0" style="font-size: 1.1rem; opacity: 0.9;">Manage your learning spaces and student communities</p>
                </div>
                <div class="d-flex gap-3" style="position: relative; z-index: 2;">
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createClassroomModal">
                        <i class="fas fa-plus me-2"></i> New Classroom
                    </button>
                    <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-secondary btn-lg">
                        <i class="fas fa-arrow-left me-2"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container-fluid px-4 pb-5">
        @if($classrooms->count() > 0)
            <div class="row g-4">
                @foreach($classrooms as $classroom)
                    <div class=" col-md-6">
                        <div class="classroom-card h-100">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="mb-0 fw-bold" style="color: #1e293b;">{{ $classroom->name }}</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">


                                            <li><a class="dropdown-item text-danger" href="{{route('teacher.deleteClass',$classroom->id)}}" onclick="return confirm('Delete this classroom?');">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>

                                <p class="text-muted mb-4" style="font-size: 0.9rem; line-height: 1.5;">
                                    {{ $classroom->description ?: 'A collaborative learning environment for students to engage with course materials and assignments.' }}
                                </p>

                                <div class="row g-3 mb-4">
                                    <div class="col-6">
                                        <div class="stat-badge text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <div class="bg-primary bg-opacity-10 rounded-circle p-2 me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-users text-primary"></i>
                                                </div>
                                            </div>
                                            <div class="fw-bold" style="font-size: 1.25rem; color: #1e293b;">{{ $classroom->students ? $classroom->students->count() : 0 }}</div>
                                            <small class="text-muted">Students</small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="stat-badge text-center">
                                            <div class="d-flex align-items-center justify-content-center mb-2">
                                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-2" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-file-alt text-success"></i>
                                                </div>
                                            </div>
                                            <div class="fw-bold" style="font-size: 1.25rem; color: #1e293b;">{{ $classroom->classroomForms ? $classroom->classroomForms->count() : 0 }}</div>
                                            <small class="text-muted">Forms</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{route('teacher.classroom.show',$classroom->id)}}" class="btn btn-primary flex-fill">
                                        <i class="fas fa-arrow-right me-1"></i> Enter
                                    </a>
                                </div>
                            </div>

                            <div class="card-footer bg-light border-0 p-3">
                                <small class="text-muted">
                                    <i class="fas fa-calendar me-1"></i> Created {{ $classroom->created_at->format('M d, Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="mb-4">
                    <i class="fas fa-school" style="font-size: 4rem; color: #d1d5db;"></i>
                </div>
                <h3 class="mb-3" style="color: #374151;">No Classrooms Yet</h3>
                <p class="text-muted mb-4">Create your first classroom to start organizing students and assignments.</p>
                <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#createClassroomModal">
                    <i class="fas fa-plus me-2"></i>Create Your First Classroom
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
                    <div class="modal-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Classroom Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="class_name" placeholder="e.g., Mathematics Grade 10" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Brief description of this classroom and its purpose..."></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Access Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="password" placeholder="Students will use this to join" required>
                            <small class="text-muted">Students will need this password to join your classroom</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0 p-4">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i> Create Classroom
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
