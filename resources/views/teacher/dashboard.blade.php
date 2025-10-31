<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Teacher Dashboard - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .welcome-card {
            background: rgba(52, 58, 64, 0.8);
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }

        .welcome-card h1 {
            color: white !important;
        }

        .welcome-card p {
            color: rgba(255,255,255,0.8) !important;
        }

        .welcome-card i {
            color: rgb(255, 255, 255) !important;
        }

        .info-card {
            border-radius: 20px;
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .icon-circle {
            background: rgba(52, 58, 64, 0.1) !important;
            border-radius: 50%;
        }

        .icon-circle i {
            color: #343a40 !important;
        }

        .nav-card {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }

        .btn {
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-dark {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.2);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-dark:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.4);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-dark {
            background: white;
            border: 2px solid rgba(255,255,255,0.3);
            color: #343a40;
        }

        .btn-outline-dark:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.4);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-dark:hover small {
            color: rgba(255,255,255,0.8) !important;
        }

        .forms-card {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .forms-card .card-header {
            background: transparent !important;
            border-radius: 25px 25px 0 0 !important;
            padding: 25px;
        }

        .forms-card .card-title {
            color: #212529;
            font-size: 1.3rem;
            font-weight: 600;
        }

        .forms-card .card-title i {
            color: #0d6efd !important;
        }

        .form-item-card {
            border-radius: 20px;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .form-item-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            background: white;
        }

        .form-item-card .card-title {
            color: #343a40c4;
            font-weight: 600;
        }

        .form-item-card .card-text {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-success {
            border-radius: 20px;
            background: #198754;
            border-color: #198754;
            font-weight: 500;
            padding: 8px 16px;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(25,135,84,0.3);
        }

        .btn-danger {
            border-radius: 20px;
            background: #dc3545;
            border-color: #dc3545;
            font-weight: 500;
            padding: 8px 16px;
        }

        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220,53,69,0.3);
        }

        .empty-state {
            color: rgba(255,255,255,0.7) !important;
            padding: 40px 20px;
        }

        .empty-state i {
            color: rgba(255,255,255,0.4) !important;
        }

        .empty-state p {
            color: rgba(255,255,255,0.7) !important;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
   @include('layouts.navbar')

    <!-- Main Content -->
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm welcome-card">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="mb-3 fw-bold text-dark">Welcome back, {{ Auth::guard('teacher')->user()->name }}!</h1>
                                <p class="mb-0 text-muted fs-5">Ready to inspire and educate your students today?</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <i class="fas fa-graduation-cap fa-4x text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Info Cards -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-0 info-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Full Name</h5>
                        <p class="card-text text-muted fs-6">{{ Auth::guard('teacher')->user()->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 info-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Email</h5>
                        <p class="card-text text-muted fs-6">{{ Auth::guard('teacher')->user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 info-card h-100">
                    <div class="card-body text-center p-4">
                        <div class="icon-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-id-badge fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Role</h5>
                        <p class="card-text text-muted fs-6 text-capitalize">{{ Auth::guard('teacher')->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 nav-card">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="{{route('teacher.classroom.setup')}}" class="btn btn-dark w-100 py-4 text-start">
                                    <i class="fas fa-school me-3 fa-lg"></i>
                                    <div class="d-inline-block">
                                        <div class="fw-bold fs-5">Classrooms</div>
                                        <small class="opacity-75">Manage your classes and students</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{route('teacher.formBuilder')}}" class="btn btn-outline-dark w-100 py-4 text-start">
                                    <i class="fas fa-wpforms me-3 fa-lg"></i>
                                    <div class="d-inline-block">
                                        <div class="fw-bold fs-5">Form Builder</div>
                                        <small class="text-muted">Create assignments and quizzes</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Your Forms Section -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 forms-card">
                    <div class="card-header border-0 pb-0">
                        <h5 class="card-title text-white mb-0"><i class="fas fa-clipboard-list me-2 text-primary"></i>Your Forms</h5>
                    </div>
                    @if(count($forms) > 0)
                        <div class="card-body">
                            <div class="row">
                                @foreach($forms as $form)
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 form-item-card">
                                            <div class="card-body p-4">
                                                <h5 class="card-title mb-2" style="color:black;" >{{ $loop->iteration }})  {{ $form->title }}</h5>
                                                <p class="card-text text-muted mb-0">Created on: {{ $form->created_at->format('d M Y') }}</p>
                                                <p class="card-text text-muted mb-0">By : {{ $form->teacher->name }}</p>
                                                <a href="{{route('teacher.showForm',$form->id)}}" class="btn btn-sm btn-success mt-3">View Form</a>
                                                <a href="{{route('teacher.deleteForm',$form->id)}}" onclick="return confirm('Are you sure you want to delete this form?');"  class="btn btn-sm btn-danger mt-3">Delete Form</a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @empty($forms)
                    <div class="card-body">
                        <div class="text-center text-muted py-4 empty-state">
                            <i class="fas fa-file-alt fa-3x mb-3"></i>
                            <p class="mb-0">No forms created yet. Use the Form Builder to create your first form.</p>
                        </div>
                    </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
