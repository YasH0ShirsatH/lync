<!DOCTYPE html>
<html>

<head>
    <title>{{ $submission->form->title }} - {{ $submission->student->name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #0ea5e9;
            --primary-blue-dark: #0369a1;
            --secondary-blue: #0284c7;
            --accent-blue: #38bdf8;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-300: #cbd5e1;
            --neutral-400: #94a3b8;
            --neutral-500: #64748b;
            --neutral-600: #475569;
            --neutral-700: #334155;
            --neutral-800: #1e293b;
            --neutral-900: #0f172a;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--neutral-800);
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1370px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        /* Header Section */
        .page-header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 4px 20px rgba(14, 165, 233, 0.15);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }

        .page-title {
            font-weight: 700;
            font-size: 1.875rem;
            margin: 0;
            position: relative;
            z-index: 1;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0.5rem 0 0 0;
            position: relative;
            z-index: 1;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            position: relative;
            z-index: 1;
            cursor: pointer;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-1px);
        }

        /* Student Info Section */
        .student-info {
            background: white;
            border-radius: 16px;
            padding: 1.75rem;
            margin-bottom: 2rem;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            position: relative;
        }

        .student-info::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--success), #16a34a);
            border-radius: 16px 16px 0 0;
        }

        .student-main {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .student-profile {
            display: flex;
            align-items: center;
        }

        .student-avatar {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--success) 0%, #16a34a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            margin-right: 1.25rem;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        }

        .student-details h5 {
            color: var(--neutral-800);
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0 0 0.25rem 0;
            line-height: 1.3;
        }

        .student-email {
            color: var(--neutral-500);
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.25rem;
        }

        .submission-time {
            color: var(--neutral-400);
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-badge.graded {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .status-badge.pending {
            background: rgba(245, 158, 11, 0.1);
            color: var(--warning);
        }

        /* Content Cards */
        .content-card {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--neutral-200);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--neutral-200);
        }

        .card-title {
            font-weight: 600;
            font-size: 1.125rem;
            margin: 0;
            color: var(--neutral-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .card-body {
            padding: 1.75rem;
            background: white;
        }

        /* Response Content Styling */
        .response-content {
            background: var(--neutral-50);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-200);
            margin-top: 1rem;
        }

        .response-content h1,
        .response-content h2,
        .response-content h3,
        .response-content h4,
        .response-content h5,
        .response-content h6 {
            color: var(--neutral-800);
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .response-content p {
            color: var(--neutral-600);
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .response-content ul,
        .response-content ol {
            color: var(--neutral-600);
            padding-left: 1.5rem;
        }

        .response-content li {
            margin-bottom: 0.5rem;
        }

        .response-content blockquote {
            border-left: 4px solid var(--primary-blue);
            padding-left: 1rem;
            margin: 1rem 0;
            color: var(--neutral-500);
            font-style: italic;
            background: rgba(14, 165, 233, 0.05);
            border-radius: 0 8px 8px 0;
        }

        .response-content code {
            background: var(--neutral-100);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            color: var(--neutral-800);
            border: 1px solid var(--neutral-200);
        }

        .response-content pre {
            background: var(--neutral-100);
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1rem 0;
            border: 1px solid var(--neutral-200);
        }

        /* Meta Information */
        .meta-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .meta-card {
            background: var(--neutral-50);
            border-radius: 8px;
            padding: 1rem;
            border: 1px solid var(--neutral-200);
            text-align: center;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            margin: 0 auto 0.75rem;
        }

        .meta-icon.time {
            background: rgba(14, 165, 233, 0.1);
            color: var(--primary-blue);
        }

        .meta-icon.date {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .meta-value {
            font-weight: 600;
            color: var(--neutral-800);
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .meta-label {
            color: var(--neutral-500);
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-weight: 500;
        }

        /* Teacher Remarks Form */
        .remarks-form {
            background: var(--neutral-50);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--neutral-200);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--neutral-700);
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .marks-input-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }

        .marks-input {
            width: 80px;
            text-align: center;
            border: 1px solid var(--neutral-300);
            border-radius: 6px;
            padding: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .marks-separator {
            color: var(--neutral-500);
            font-weight: 600;
        }

        .form-control {
            border: 1px solid var(--neutral-300);
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
        }

        .form-text {
            color: var(--neutral-500);
            font-size: 0.75rem;
            margin-top: 0.375rem;
        }

        /* Buttons */
        .btn {
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.875rem;
            padding: 0.625rem 1.25rem;
        }

        .btn-primary {
            background: var(--primary-blue);
            border-color: var(--primary-blue);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-blue-dark);
            border-color: var(--primary-blue-dark);
            color: white;
            transform: translateY(-1px);
        }

        .btn-warning {
            background: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-warning:hover {
            background: #d97706;
            border-color: #d97706;
            color: white;
            transform: translateY(-1px);
        }

        /* Alert Styling */
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem 1.25rem;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 0 0.75rem;
            }

            .page-header {
                padding: 1.5rem;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .student-info {
                padding: 1.25rem;
            }

            .student-main {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .meta-grid {
                grid-template-columns: 1fr;
            }

            .marks-input-group {
                flex-wrap: wrap;
            }
        }
    </style>
</head>

<body>
    @include('layouts.navbar')

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-file-text me-2"></i>{{ $submission->form->title }}
                    </h1>
                    <p class="page-subtitle">Individual Submission Review</p>
                </div>
                <button onclick="history.back()" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </button>
            </div>
        </div>

        <!-- Student Information -->
        <div class="student-info">
            <div class="student-main">
                <div class="student-profile">
                    <div class="student-avatar">
                        {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                    </div>
                    <div class="student-details">
                        <h5>{{ $submission->student->name }}</h5>
                        <div class="student-email">
                            <i class="fas fa-envelope"></i>
                            <span>{{ $submission->student->email }}</span>
                        </div>
                        <div class="submission-time">
                            <i class="fas fa-clock"></i>
                            <span>{{ $submission->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                <div class="status-section">
                    @if ($submission->rating !== null)
                        <div class="status-badge graded">
                            <i class="fas fa-check-circle me-1"></i>Graded
                        </div>
                    @else
                        <div class="status-badge pending">
                            <i class="fas fa-clock me-1"></i>Pending Review
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Submission Details -->
        <div class="content-card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fas fa-file-text"></i>
                    Student Response
                </h4>
            </div>
            <div class="card-body">
                <!-- Meta Information Grid -->
                <div class="meta-grid">
                    <div class="meta-card">
                        <div class="meta-icon date">
                            <i class="fas fa-calendar"></i>
                        </div>
                        <div class="meta-value">{{ $submission->created_at->format('M d, Y') }}</div>
                        <div class="meta-label">Submission Date</div>
                    </div>
                    <div class="meta-card">
                        <div class="meta-icon time">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-value">{{ $submission->created_at->format('H:i') }}</div>
                        <div class="meta-label">Time Submitted</div>
                    </div>
                </div>

                <!-- Response Content -->
                <div class="response-content">
                    {!! $submission->responses !!}
                </div>
            </div>
        </div>

        <!-- Teacher Evaluation -->
        <div class="content-card">
            <div class="card-header">
                <h4 class="card-title">
                    <i class="fas fa-clipboard-check"></i>
                    Teacher Evaluation
                </h4>
            </div>
            <div class="card-body">
                <div class="remarks-form">
                    <form action="{{ route('teacher.updateSubmissionRemark', $submission->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @php
                            $obtainedMarks = $submission->rating;
                            $teacherComment = '';

                            // Count input fields in the form HTML content
                            $formHtml = $submission->form->html_content;
                            $inputCount = 0;
                            if ($formHtml) {
                                // Count input, textarea, and select elements
                                $inputCount += substr_count($formHtml, '<input');
                                $inputCount += substr_count($formHtml, '<textarea');
                                $inputCount += substr_count($formHtml, '<select');
                            }
                            $totalMarks = $inputCount;

                            // Parse existing comment for teacher feedback
                            if ($submission->comment) {
                                if (str_contains($submission->comment, '|')) {
                                    $parts = explode('|', $submission->comment, 2);
                                    $teacherComment = $parts[1];
                                } elseif (!str_contains($submission->comment, '/')) {
                                    $teacherComment = $submission->comment;
                                }
                            }

                            $hasRemarks = $submission->rating !== null || !empty($teacherComment);
                        @endphp

                        <!-- Scoring Section -->
                        <div class="form-group">
                            <label class="form-label">Score Assessment</label>
                            <div class="marks-input-group">
                                <input type="number" class="marks-input" name="obtained_marks" id="obtained_marks"
                                    value="{{ $obtainedMarks }}" placeholder="0" min="0"
                                    {{ $hasRemarks ? 'disabled' : '' }}>
                                <span class="marks-separator">out of</span>
                                <input type="number" class="marks-input" name="total_marks" id="total_marks"
                                    placeholder="{{ $totalMarks }}" {{ $hasRemarks ? 'disabled' : '' }}>
                            </div>
                            <div class="form-text">Based on {{ $totalMarks }} form fields detected</div>
                        </div>

                        <!-- Feedback Section -->
                        <div class="form-group">
                            <label for="teacher_comment" class="form-label">Detailed Feedback</label>
                            <textarea class="form-control" name="teacher_comment" id="teacher_comment" rows="4"
                                placeholder="Provide constructive feedback to help the student improve..." {{ $hasRemarks ? 'disabled' : '' }}>{{ $teacherComment }}</textarea>
                            <div class="form-text">Your feedback will be visible to the student</div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            @if ($hasRemarks)
                                <button type="button" class="btn btn-warning" id="editBtn" onclick="enableEdit()">
                                    <i class="fas fa-edit me-1"></i>Edit Evaluation
                                </button>
                                <button type="submit" class="btn btn-primary" id="saveBtn" style="display: none;">
                                    <i class="fas fa-save me-1"></i>Save Changes
                                </button>
                            @else
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Submit Evaluation
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function enableEdit() {
            document.getElementById('obtained_marks').disabled = false;
            document.getElementById('total_marks').disabled = false;
            document.getElementById('teacher_comment').disabled = false;
            document.getElementById('editBtn').style.display = 'none';
            document.getElementById('saveBtn').style.display = 'inline-block';
        }
    </script>
</body>

</html>
