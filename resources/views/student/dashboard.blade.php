<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Dashboard - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .btn-outline-primary:hover small {
            color: white !important;
        }
    </style>
</head>
<body class="bg-white">
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom">
        <div class="container-fluid px-4">
            <a class="navbar-brand fw-bold text-dark" href="#">
                <i class="fas fa-user-graduate me-2 text-primary"></i>Lync Student
            </a>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i>{{ Auth::guard('student')->user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item text-danger" href="{{route('account.logout')}}"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid px-4 py-5">
        <!-- Welcome Section -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <div class="card-body p-5">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h1 class="mb-3 fw-bold text-dark">Welcome back, {{ Auth::guard('student')->user()->name }}!</h1>
                                <p class="mb-0 text-muted fs-5">Ready to learn and grow today?</p>
                            </div>
                            <div class="col-md-4 text-end">
                                <i class="fas fa-book-open fa-4x text-primary opacity-25"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Info Cards -->
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-user text-dark fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Full Name</h5>
                        <p class="card-text text-muted fs-6">{{ Auth::guard('student')->user()->name }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-envelope text-dark fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Email</h5>
                        <p class="card-text text-muted fs-6">{{ Auth::guard('student')->user()->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-id-badge text-dark fa-xl"></i>
                        </div>
                        <h5 class="card-title mb-2 text-dark">Role</h5>
                        <p class="card-text text-muted fs-6 text-capitalize">{{ Auth::guard('student')->user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-primary w-100 py-4 text-start">
                                    <i class="fas fa-school me-3 fa-lg"></i>
                                    <div class="d-inline-block">
                                        <div class="fw-bold fs-5">Classrooms</div>
                                        <small class="opacity-75">Access your enrolled classes</small>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="#" class="btn btn-outline-primary w-100 py-4 text-start">
                                    <i class="fas fa-clipboard-list me-3 fa-lg"></i>
                                    <div class="d-inline-block">
                                        <div class="fw-bold fs-5">Fill Form Assigned</div>
                                        <small class="text-muted">Complete assignments and quizzes</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
