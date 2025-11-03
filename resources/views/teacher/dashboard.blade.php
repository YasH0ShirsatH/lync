<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>lynq - Teacher Dashboard </title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .welcome-card {
            background: rgba(52, 58, 64, 0.8);
            border-radius: 25px;
            backdrop-filter: blur(10px);
        }

        :not(.input-group)>.bootstrap-select.form-control:not([class*=col-]) {
            width: 100%;
            margin-bottom: 20px;
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

        .classroom-badges {
            margin: 12px 0;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
        }

        .classroom-badge {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.1) 0%, rgba(13, 110, 253, 0.05) 100%);
            color: #0d6efd;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            border: 1px solid rgba(13, 110, 253, 0.15);
            transition: all 0.2s ease;
            white-space: nowrap;
        }

        .classroom-badge:hover {
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.15) 0%, rgba(13, 110, 253, 0.1) 100%);
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(13, 110, 253, 0.2);
        }

        .classroom-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
            margin-right: 8px;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .form-item-card {
            border-radius: 20px;
            background: rgba(255,255,255,0.95);
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            overflow: hidden;
        }

        .form-item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            background: white;
        }

        .form-item-card .card-body {
            padding: 25px;
        }

        .form-item-card .card-title {
            color: #212529 !important;
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 12px;
            line-height: 1.3;
        }

        .form-meta {
            margin-bottom: 15px;
        }

        .form-meta p {
            margin-bottom: 4px;
            font-size: 0.85rem;
        }

        .form-actions {
            margin-top: 20px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .classroom-select {
            background: white;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 12px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #495057;
            transition: all 0.3s ease;
            height: auto;
            min-height: 45px;
            max-height: 120px;
            overflow-y: auto;
        }

        .classroom-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
            outline: none;
        }

        .classroom-select option {
            padding: 8px 12px;
            background: white;
            color: #495057;
            border: none;
        }

        .classroom-select option:checked {
            background: #0d6efd;
            color: white;
        }

        .classroom-select option:hover {
            background: #f8f9fa;
        }

        .assign-btn {
            background: linear-gradient(135deg, #198754 0%, #20c997 100%);
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 135, 84, 0.2);
        }

        .assign-btn:hover {
            background: linear-gradient(135deg, #157347 0%, #1aa179 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 135, 84, 0.3);
            color: white;
        }

        .classroom-assignment {
            background: rgba(248, 249, 250, 0.5);
            border-radius: 15px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid rgba(233, 236, 239, 0.6);
        }

        .assignment-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        @media (max-width: 768px) {
            .classroom-badges {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .classroom-badge {
                font-size: 0.7rem;
                padding: 5px 12px;
            }

            .form-actions {
                flex-direction: column;
            }

            .form-actions .btn {
                width: 100%;
                justify-content: center;
            }

            .classroom-select {
                font-size: 0.8rem;
            }

            .assign-btn {
                width: 100%;
                justify-content: center;
            }
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
            <div>
             @if (session('success'))
              <div class="alert alert-success text-dark" role="alert">
                {{ session('success') }}
              </div>
              @endif
             </div>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title text-white mb-0"><i class="fas fa-clipboard-list me-2 text-primary"></i>Your Forms</h5>
                            <div class="search-container d-flex">
                                <input type="text" id="form-search" class="form-control me-2" placeholder="Search forms..." style="border-radius: 20px; width: 200px;">
                                <button type="button" id="search-btn" class="btn btn-primary" style="border-radius: 20px;">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="forms-container">
                            @include('teacher.partials.forms')
                        </div>
                        <div id="pagination-container">
                            {{ $forms->links('teacher.partials.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let currentSearch = '';

            document.addEventListener('click', function(e) {
                if (e.target.matches('.page-link[data-page]')) {
                    e.preventDefault();
                    const page = e.target.getAttribute('data-page');
                    loadForms(page, currentSearch);
                }
            });

            document.getElementById('search-btn').addEventListener('click', function() {
                currentSearch = document.getElementById('form-search').value;
                loadForms(1, currentSearch);
            });

            document.getElementById('form-search').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    currentSearch = this.value;
                    loadForms(1, currentSearch);
                }
            });

            document.addEventListener('click', function(e) {
                if (e.target.matches('.add-classroom-btn') || e.target.closest('.add-classroom-btn')) {
                    const btn = e.target.matches('.add-classroom-btn') ? e.target : e.target.closest('.add-classroom-btn');
                    const formId = btn.getAttribute('data-form-id');
                    const assignmentDiv = document.getElementById(`assignment-${formId}`);
                    const icon = btn.querySelector('i');

                    if (assignmentDiv.style.display === 'none' || assignmentDiv.style.display === '') {
                        assignmentDiv.style.display = 'block';
                        icon.className = 'fas fa-minus';
                        setTimeout(() => {
                            $(`#classroom-select-${formId}`).selectpicker('destroy').selectpicker();
                        }, 100);
                    } else {
                        assignmentDiv.style.display = 'none';
                        icon.className = 'fas fa-plus';
                    }
                    return;
                }

                if (e.target.matches('.assign-btn')) {
                    const formId = e.target.getAttribute('data-form-id');
                    const selectedOptions = $(`#classroom-select-${formId}`).val();

                    if (selectedOptions.length === 0) {
                        alert('Please select at least one classroom');
                        return;
                    }

                    fetch('/teacher/assign-form', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            form_id: formId,
                            classroom_ids: selectedOptions
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            loadForms(1, currentSearch);
                        }
                    })
                    .catch(error => console.error('Error:', error));
                }
            });

            function loadForms(page = 1, search = '') {
                const url = new URL('/teacher/forms', window.location.origin);
                url.searchParams.set('page', page);
                if (search) url.searchParams.set('search', search);

                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('forms-container').innerHTML = data.html;
                    document.getElementById('pagination-container').innerHTML = data.pagination;
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>
