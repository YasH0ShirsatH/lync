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
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 classroom-card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mb-1"><i class="fas fa-school me-2"></i>Create New Classroom</h3>
                            </div>
                            <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="form-container">
                            <form action="#" method="POST">
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
                                        Create Password <span class="required-asterisk">*</span>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Enter password " required>
                                </div>






                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-plus me-2"></i>Create Classroom
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
