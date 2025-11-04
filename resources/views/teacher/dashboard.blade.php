<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>lynq - Teacher Dashboard</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

    <style>
        /* --- GLOBAL STYLES --- */
        :root {
            --primary: #e2e8f0;
            --primary-dark: #cbd5e1;
            --secondary: #64748b;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -2px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
            --gradient-primary: linear-gradient(135deg, #1e293b 0%, #334155 100%);
            --gradient-card: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            color: var(--text-dark);
        }

        .container {
            padding-top: 1.5rem;
            padding-bottom: 2.5rem;
            max-width: 1200px;
        }

        /* --- HEADER & WELCOME --- */
        .dashboard-header {
            background: var(--text-dark);
            color: white;
            padding: 2.5rem 0 3.5rem;
            margin-bottom: -1.5rem;
            border-bottom-right-radius: 24px;
            border-bottom-left-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .dashboard-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -10%;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .welcome-title {
            font-size: 2.5rem;
            font-weight: 700;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
            position: relative;
            z-index: 2;
        }

        /* --- STAT CARDS --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            transform: translateY(-60px);
            position: relative;
            z-index: 10;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.2s ease;
            text-align: center;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        }

        .stat-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.2rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--secondary);
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Specific stat card colors */
        .stat-card:nth-child(1) .stat-icon { background: #e2e8f0; color: #475569; }
        .stat-card:nth-child(2) .stat-icon { background: #d1fae5; color: #065f46; }
        .stat-card:nth-child(3) .stat-icon { background: #fef3c7; color: #92400e; }

        /* --- ACTION CARDS --- */
        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            text-decoration: none;
            color: inherit;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .action-card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.12);
            transform: translateY(-2px);
            color: inherit;
        }

        .action-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            color: #475569;
            font-size: 1.2rem;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .action-title {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }

        .action-description {
            color: var(--secondary);
            font-size: 0.875rem;
            line-height: 1.4;
        }

        /* --- FORMS SECTION --- */
        .forms-section {
            margin-top: 2rem;
        }

        .forms-card {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow-light);
            border: 1px solid #e5e7eb;
            overflow: hidden;
        }

        .forms-card .card-header {
            background-color: var(--bg-light);
            padding: 2rem 2rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .forms-card .card-title {
            color: var(--text-dark);
            font-size: 1.25rem;
            font-weight: 600;
        }

        .search-container {
            margin-bottom: 1.5rem;
        }

        .search-container .form-control {
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }

        .search-container .form-control:focus {
            border-color: #94a3b8;
            box-shadow: 0 0 0 0.2rem rgba(148, 163, 184, 0.25);
        }

        .search-container .btn-primary {
            background: #e2e8f0;
            border-color: #e2e8f0;
            color: #475569;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
        }

        .search-container .btn-primary:hover {
            background: #cbd5e1;
            border-color: #cbd5e1;
            color: #334155;
        }

        /* Bubble animation */
        .bubble-animate {
            animation: bubbleEffect 0.6s ease-out;
        }

        @keyframes bubbleEffect {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        /* --- PAGINATION --- */
        #pagination-container {
            padding: 2rem;
            border-top: 1px solid #e5e7eb;
            background-color: #fafbfc;
        }

        /* --- PLUS ICON REDESIGN --- */
        .add-classroom-btn {
            /* Styles handled inline in forms.blade.php */
        }

        /* --- BUTTON STYLES --- */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
        }
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            box-shadow: 0 2px 8px rgba(79, 70, 229, 0.2);
        }
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }
        .btn-dark {
            background: var(--text-dark);
            border-color: var(--text-dark);
        }
        .btn-dark:hover {
            background: #0f172a;
            border-color: #0f172a;
            transform: translateY(-1px);
        }

    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="dashboard-header">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="welcome-section">
                <h1 class="welcome-title text-white">Teacher Dashboard</h1>
                <p class="welcome-subtitle">Welcome back, {{ Auth::guard('teacher')->user()->name }}</p>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" >
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-value">{{ $forms->total() }}</div>
                <div class="stat-label">Total Forms</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div class="stat-value">{{ $classroomSetup->count() }}</div>
                <div class="stat-label">Active Classrooms</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="stat-value text-truncate">{{ Auth::guard('teacher')->user()->name }}</div>
                <div class="stat-label">Teacher Profile</div>
            </div>
        </div>

        <div class="action-grid">
            <a href="{{route('teacher.classroom.setup')}}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-school"></i>
                </div>
                <div>
                    <div class="action-title">Manage Classrooms</div>
                    <div class="action-description">Create and manage your classes, view enrolled students, and organize your teaching materials.</div>
                </div>
            </a>
            <a href="{{route('teacher.formBuilder')}}" class="action-card">
                <div class="action-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <div class="action-title">Create Forms & Quizzes</div>
                    <div class="action-description">Build custom forms, assignments, and quizzes with our intuitive drag-and-drop form builder.</div>
                </div>
            </a>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card border-0 forms-card">
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h5 class="card-title mb-0"><i class="fas fa-clipboard-list me-2 text-primary"></i>Your Forms & Assignments</h5>
                            <div class="search-container d-flex">
                                <input type="text" id="form-search" class="form-control me-3" placeholder="Search forms...">
                                <button type="button" id="search-btn" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div id="forms-container" class="p-4">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        // The entire JS block for form loading, searching, and assignment is unchanged
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
                const target = e.target.closest('.add-classroom-btn') || e.target;

                if (target.matches('.add-classroom-btn')) {
                    const btn = target;
                    const formId = btn.getAttribute('data-form-id');
                    const assignmentDiv = document.getElementById(`assignment-${formId}`);
                    const icon = btn.querySelector('i');

                    // Toggle functionality
                    if (assignmentDiv.style.display === 'none' || assignmentDiv.style.display === '') {
                        assignmentDiv.style.display = 'block';
                        icon.className = 'fas fa-minus';
                        // Re-initialize bootstrap-select (essential for functionality)
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
                    const assignButton = e.target;
                    const formId = assignButton.getAttribute('data-form-id');
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
                    // Re-initialize selectpickers for newly loaded content
                    $('.tom-select-multiple').selectpicker();
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
</body>
</html>
