<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Available Classes - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        :root {
            --primary-500: #0ea5e9;
            --primary-600: #0284c7;
            --primary-700: #0369a1;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --success-500: #22c55e;
            --white: #ffffff;
        }

        body {
            background: linear-gradient(135deg, var(--gray-50) 0%, #e0f2fe 100%);
            min-height: 100vh;
            color: var(--gray-800);
        }

        .container {
            max-width: 1350px;
        }

        .page-header {
            background: var(--white);
            border-bottom: 1px solid var(--gray-200);
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin-bottom: 1rem;
        }

        .breadcrumb-item a {
            color: var(--primary-600);
            text-decoration: none;
        }

        .page-title {
            color: var(--gray-900);
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
        }

        .page-subtitle {
            color: var(--gray-600);
            font-size: 1rem;
            margin: 0;
        }

        .class-card {
            background: var(--white);
            border: 1px solid var(--gray-200);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .class-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: var(--primary-500);
        }

        .class-header {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .class-icon {
            width: 3rem;
            height: 3rem;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .class-icon i {
            font-size: 1.25rem;
            color: white;
        }

        .class-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .class-body {
            padding: 2rem;
            display: flex;
            flex-direction: column;
            height: calc(100% - 140px);
        }

        .info-section {
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--gray-50);
            border-radius: 0.5rem;
            border-left: 4px solid var(--primary-500);
        }

        .info-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: var(--primary-500);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .info-icon i {
            color: white;
            font-size: 0.875rem;
        }

        .info-content h6 {
            color: var(--gray-900);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .info-content p {
            color: var(--gray-600);
            margin: 0;
            line-height: 1.5;
            font-size: 0.875rem;
        }

        .join-section {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .password-input {
            border: 1px solid var(--gray-200);
            border-radius: 0.5rem;
            padding: 0.75rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
            width: 100%;
        }

        .password-input:focus {
            border-color: var(--primary-500);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            outline: none;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(14, 165, 233, 0.3);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--success-500) 0%, #16a34a 100%);
            color: white;
        }

        .btn-success:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
            color: white;
        }

        .btn-outline-secondary {
            border: 1px solid var(--gray-200);
            color: var(--gray-600);
            background: var(--white);
        }

        .btn-outline-secondary:hover {
            background: var(--gray-100);
            border-color: var(--gray-300);
            color: var(--gray-700);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: var(--white);
            border-radius: 1rem;
            border: 1px solid var(--gray-200);
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--gray-500);
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="page-header">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Available Classes</li>
                </ol>
            </nav>
            <h1 class="page-title">Available Classes</h1>
            <p class="page-subtitle">Discover and join classrooms to start learning</p>
        </div>
    </div>

    <div class="container pb-5">
        <div class="row g-4">
            @forelse ($classes as $class)
                <div class="col-lg-4 col-md-6">
                    <div class="class-card">
                        <div class="class-header">
                            <div class="class-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <h5 class="class-title">{{ $class->name }}</h5>
                        </div>

                        <div class="class-body">
                            <div class="info-section">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-user-tie"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Instructor</h6>
                                        <p>{{ $class->teacher->name }}</p>
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-align-left"></i>
                                    </div>
                                    <div class="info-content">
                                        <h6>Description</h6>
                                        <p>{{ $class->description ?: 'No description available' }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="join-section">
                                <div class="password-section" id="password-{{ $class->id }}" style="display: none;">
                                    <input type="password" class="password-input" placeholder="Enter class password"
                                        id="password-input-{{ $class->id }}">
                                    <div class="d-flex gap-2">
                                        <button type="button" class="btn btn-success flex-fill"
                                            onclick="submitJoin('{{ $class->id }}')">
                                            <i class="fas fa-check me-1"></i>Join Class
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary flex-fill"
                                            onclick="cancelJoin('{{ $class->id }}')">
                                            <i class="fas fa-times me-1"></i>Cancel
                                        </button>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-primary w-100" id="join-btn-{{ $class->id }}"
                                    onclick="showPassword('{{ $class->id }}')">
                                    <i class="fas fa-plus me-2"></i>Join This Class
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-school empty-icon"></i>
                        <h4 class="mb-3">No Classes Available</h4>
                        <p class="text-muted mb-4">There are no classes available to join at the moment. Check back
                            later or contact your instructor.</p>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        function showPassword(classId) {
            document.getElementById(`password-${classId}`).style.display = 'block';
            document.getElementById(`join-btn-${classId}`).style.display = 'none';
        }

        function cancelJoin(classId) {
            document.getElementById(`password-${classId}`).style.display = 'none';
            document.getElementById(`join-btn-${classId}`).style.display = 'block';
            document.getElementById(`password-input-${classId}`).value = '';
        }

        function submitJoin(classId) {
            const password = document.getElementById(`password-input-${classId}`).value;
            if (!password) {
                alert('Please enter the class password');
                return;
            }

            fetch('/student/join-class', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        classroom_id: classId,
                        password: password
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
        }
    </script>
    @include('javascript.js')
</body>

</html>
