<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $form->title }} - Lync</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            color: #1e293b;
        }

        .page-header {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }

        .page-title {
            color: #0f172a;
            font-size: 1.875rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .status-badge {
            background: #dbeafe;
            color: #1e40af;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-back {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            color: #475569;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back:hover {
            background: #e2e8f0;
            border-color: #94a3b8;
            color: #334155;
            transform: translateY(-1px);
        }

        .form-preview-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .form-meta-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .meta-icon {
            width: 2.5rem;
            height: 2.5rem;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
        }

        .meta-content h6 {
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0;
        }

        .meta-content p {
            color: #64748b;
            font-size: 0.75rem;
            margin: 0.25rem 0 0 0;
        }

        .form-preview-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%);
            padding: 2rem;
            text-align: center;
            position: relative;
        }

        .form-header::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .form-title {
            color: white;
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0 0 0.5rem 0;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .form-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
            margin: 0;
            opacity: 0.95;
        }

        .form-content {
            padding: 2rem;
        }

        .form-element {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            transition: all 0.2s ease;
        }

        .form-element:hover {
            border-color: #cbd5e1;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            color: #0f172a;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-control, .form-select {
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:disabled, .form-select:disabled {
            background: #f9fafb;
            border-color: #e5e7eb;
            color: #6b7280;
            cursor: not-allowed;
        }

        .form-control:focus, .form-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            outline: none;
        }

        .form-check-input {
            border-color: #d1d5db;
        }

        .form-check-input:checked {
            background-color: #3b82f6;
            border-color: #3b82f6;
        }

        .form-check-label {
            color: #374151;
            font-size: 0.875rem;
        }

        .required-indicator {
            color: #ef4444;
            margin-left: 0.25rem;
        }

        .edit-title-btn {
            display: none !important;
        }

        .preview-notice {
            background: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .preview-notice-icon {
            color: #d97706;
            font-size: 1.25rem;
        }

        .preview-notice-text {
            color: #92400e;
            font-size: 0.875rem;
            font-weight: 500;
            margin: 0;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem 0;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .form-content {
                padding: 1.5rem;
            }
            
            .meta-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
   @include('layouts.navbar')

    <!-- Page Header -->
    <div class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h1 class="page-title">Form Preview</h1>
                    <div class="page-subtitle">
                        <span class="status-badge">
                            <i class="fas fa-eye"></i>
                            Preview Mode
                        </span>
                        <span class="text-muted">•</span>
                        <span>{{ $form->title }}</span>
                    </div>
                </div>
                <a href="{{ route('teacher.dashboard') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i>
                    Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container pb-5">
        <div class="form-preview-container">
            <!-- Form Meta Information -->
            <div class="form-meta-card">
                <div class="meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="meta-content">
                            <h6>Created</h6>
                            <p>{{ $form->created_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-content">
                            <h6>Last Updated</h6>
                            <p>{{ $form->updated_at->format('M d, Y \a\t g:i A') }}</p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div class="meta-content">
                            <h6>Form Elements</h6>
                            <p id="element-count">Calculating...</p>
                        </div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-asterisk"></i>
                        </div>
                        <div class="meta-content">
                            <h6>Required Fields</h6>
                            <p id="required-count">Calculating...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Preview Notice -->
            <div class="preview-notice">
                <i class="fas fa-info-circle preview-notice-icon"></i>
                <p class="preview-notice-text">
                    This is a preview of your form. All fields are disabled for viewing purposes only.
                </p>
            </div>

            <!-- Form Preview -->
            <div class="form-preview-card">
                <div class="form-header">
                    <h2 class="form-title">{{ $form->title }}</h2>
                    <p class="form-description">Please fill out all required fields marked with an asterisk (*)</p>
                </div>
                <div class="form-content">
                    {!! $form->html_content !!}
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Disable all form inputs for view-only mode
            const inputs = document.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.disabled = true;
            });

            // Hide remove buttons and edit controls
            const removeButtons = document.querySelectorAll('.remove-btn, .edit-title-btn');
            removeButtons.forEach(btn => {
                btn.style.display = 'none';
            });

            // Calculate form statistics
            const formElements = document.querySelectorAll('.form-element');
            const requiredElements = document.querySelectorAll('[required], .required');
            
            document.getElementById('element-count').textContent = formElements.length + ' elements';
            document.getElementById('required-count').textContent = requiredElements.length + ' required';

            // Add subtle hover effects to form elements
            formElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-1px)';
                });
                
                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>
</body>
</html>
