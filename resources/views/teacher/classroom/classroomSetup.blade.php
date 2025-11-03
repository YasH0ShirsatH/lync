<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Classroom - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        textarea {
            resize: none;
        }

        .classroom-card {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .classroom-card .card-header {
            background: transparent !important;
            border-radius: 25px 25px 0 0 !important;
            padding: 25px;
            border: none;
        }

        .classroom-card h3 {
            color: white !important;
            font-weight: 700;
        }

        .classroom-card .card-header i {
            color: #0d6efd !important;
        }

        .btn {
            border-radius: 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-outline-dark {
            background: rgba(255,255,255,0.1);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            backdrop-filter: blur(10px);
        }

        .btn-outline-dark:hover {
            background: rgba(255,255,255,0.2);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }

        .form-container {
            background: rgba(255,255,255,0.95);
            border-radius: 20px;
            padding: 40px;
            backdrop-filter: blur(10px);
        }

        .form-control, .form-select {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 12px 16px;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,0.25);
        }

        .form-label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }

        .btn-success {
            background: #198754;
            border-color: #198754;
            border-radius: 20px;
            padding: 12px 30px;
            font-weight: 600;
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(25,135,84,0.3);
        }

        .required-asterisk {
            color: #dc3545;
            font-weight: bold;
        }

         #successAlert {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 1050;
                    background: linear-gradient(135deg, #198754 0%, #20c997 100%);
                    border: none;
                    border-radius: 25px;
                    color: white;
                    font-weight: 600;
                    box-shadow: 0 10px 30px rgba(25,135,84,0.3);
                    backdrop-filter: blur(10px);
                    animation: slideInRight 0.5s ease;
                    min-width: 300px;
                }

                #successAlert.fade-out {
                    animation: slideOutRight 0.5s ease;
                }


        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .classrooms-section {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
            margin-bottom: 30px;
        }

        .classrooms-header {
            background: transparent;
            padding: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .classrooms-header h4 {
            color: white;
            font-weight: 700;
            margin: 0;
        }

        .classroom-item {
            background: rgba(255,255,255,0.95);
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .classroom-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .classroom-name {
            font-weight: 700;
            color: #212529;
            font-size: 1.2rem;
            margin-bottom: 8px;
        }

        .classroom-description {
            color: #6c757d;
            font-size: 0.95rem;
            margin-bottom: 15px;
        }

        .classroom-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-start;
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.875rem;
            border-radius: 15px;
        }

        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background: #bb2d3b;
            border-color: #b02a37;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    @include('layouts.navbar')
    @if(session('success'))
        <div id="successAlert" class="alert text-center p-3">
            <i class="fas fa-check-circle me-2"></i>
            <span id="successMessage">{{ session('success') }}</span>
        </div>
    @endif
     @if(session('delete'))
            <div id="successAlert" class="alert text-center p-3">
                <i class="fas fa-check-circle me-2"></i>
                <span id="successMessage">{{ session('delete') }}</span>
            </div>
        @endif

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="classrooms-section">
                    <div class="classrooms-header d-flex justify-content-between align-items-center">
                        <h4><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Your Classrooms</h4>
                        <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-dark btn-sm">
                            <i class="fas fa-arrow-left me-1"></i>Back
                        </a>
                    </div>
                    @if($classrooms->count() > 0)
                        <div class="row">
                            @foreach($classrooms as $classroom)
                                <div class="col-md-6">
                                    <div class="classroom-item">
                                        <div class="classroom-name">{{ $classroom->name }}</div>
                                        <div class="classroom-description">{{ $classroom->description ?: 'No description provided' }}</div>
                                        <div class="classroom-actions">
                                            <a href="{{route('teacher.classroom.show',$classroom->id)}}" class="btn btn-sm btn-success">
                                                <i class="fas fa-eye me-1"></i>View
                                            </a>
                                            <a href="{{route('teacher.deleteClass',$classroom->id)}}" onclick="return confirm('Are you sure you want to delete this classroom?');" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash me-1"></i>Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-school fa-3x text-white opacity-25 mb-3"></i>
                            <p class="text-white-50 mb-0">No classrooms created yet</p>
                        </div>
                    @endif
                </div>

                <div class="text-center mb-4">
                    <button id="toggleFormBtn" class="btn btn-primary btn-lg">
                        <i class="fas fa-plus me-2"></i>Create New Classroom
                    </button>
                </div>

                <div id="classroomForm" class="card border-0 classroom-card" style="display: none;">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1"><i class="fas fa-school me-2"></i>Create New Classroom</h3>
                            </div>
                            <div>
                                <button id="hideFormBtn" class="btn btn-outline-dark btn-sm">
                                    <i class="fas fa-times me-1"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-container">
                            <form action="{{route('teacher.classroom.save')}}" method="POST">
                                @csrf

                                <div class="mb-4">
                                    <label for="className" class="form-label">
                                        Classroom Name <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="className" name="class_name"
                                           placeholder="Enter classroom name" required>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="4"
                                              placeholder="Enter classroom description (optional)"></textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="password" class="form-label">
                                        Classroom Password <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Enter classroom password" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-save me-2"></i>Create Classroom
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('toggleFormBtn').addEventListener('click', function() {
            const form = document.getElementById('classroomForm');
            const btn = document.getElementById('toggleFormBtn');

            form.style.display = 'block';
            btn.style.display = 'none';
        });

        document.getElementById('hideFormBtn').addEventListener('click', function() {
            const form = document.getElementById('classroomForm');
            const btn = document.getElementById('toggleFormBtn');

            form.style.display = 'none';
            btn.style.display = 'block';
        });

        // Auto-hide success alert
        const successAlert = document.getElementById('successAlert');
        if (successAlert) {
            setTimeout(() => {
                successAlert.classList.add('fade-out');
                setTimeout(() => {
                    successAlert.remove();
                }, 500);
            }, 3000);
        }
    </script>
</body>
</html>
