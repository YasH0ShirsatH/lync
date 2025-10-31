<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->title }} - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .form-preview-card {
            background: rgba(52, 58, 64, 0.95);
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            backdrop-filter: blur(10px);
        }

        .form-preview-card .card-header {
            background: transparent !important;
            border-radius: 25px 25px 0 0 !important;
            padding: 25px;
            border: none;
        }

        .form-preview-card h4 {
            color: white !important;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .form-preview-card small {
            color: rgba(255,255,255,0.7) !important;
        }

        .form-preview-card small i {
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

        .awesome-form {
            background: white;
            border-radius: 25px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .form-header {
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
            padding: 30px;
            text-align: center;
            position: relative;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: white;
        }

        .form-header h2 {
            color: white;
            font-weight: 700;
            font-size: 2.2rem;
            margin: 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .form-header p {
            color: rgba(255,255,255,0.8);
            margin: 10px 0 0 0;
            font-size: 1.1rem;
        }

        .form-body {
            padding: 40px;
        }

        .form-element {
            background: white;
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.05);
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e9ecef;
            background: #f8f9fa;
        }

        .form-control:disabled, .form-select:disabled {
            background: #f8f9fa;
            opacity: 0.8;
        }

        .form-label {
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
   @include('layouts.navbar')

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 form-preview-card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1 fw-bold">Form Preview</h4>
                                <small>
                                    <i class="fas fa-eye me-1"></i>Preview Mode
                                    <span class="mx-2">•</span>
                                    Created {{ $form->created_at->format('M d, Y') }}
                                </small>
                            </div>
                            <a href="{{ route('teacher.dashboard') }}" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="awesome-form">
                            <div class="form-header">
                                <h2>{{ $form->title }}</h2>
                                <p>Please fill out all required fields</p>
                            </div>
                            <div class="form-body">
                                {!! $form->html_content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Disable all form inputs for view-only mode
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.disabled = true;
            });

            // Hide remove buttons
            const removeButtons = document.querySelectorAll('.remove-btn');
            removeButtons.forEach(btn => {
                btn.style.display = 'none';
            });
        });
    </script>
</body>
</html>
