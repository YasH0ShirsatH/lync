<!DOCTYPE html>
<html>
<head>
    <title>{{ $submission->form->title }} - {{ $submission->student->name }}</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #64748b;
        }

        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1e293b;
            min-height: 100vh;
        }

        .container {
            max-width: 1000px;
        }

        /* Header */
        .page-header {
            background: linear-gradient(135deg, var(--bg-secondary), var(--bg-tertiary));
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            color: var(--text-primary);
            box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        }

        .page-title {
            font-weight: 700;
            font-size: 2rem;
            margin: 0;
        }

        .page-subtitle {
            opacity: 0.9;
            font-size: 1rem;
            margin: 0;
        }

        /* Student Info Bar */
        .student-info {
            background: white;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .student-avatar {
            width: 50px;
            height: 50px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .student-details h5 {
            color: #1e293b;
            font-weight: 600;
            margin: 0;
        }

        .student-details p {
            color: #64748b;
            margin: 0.25rem 0 0 0;
            font-size: 0.875rem;
        }

        /* Submission Card */
        .submission-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .submission-header {
            background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-secondary));
            color: var(--text-primary);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .submission-title {
            font-weight: 600;
            font-size: 1.25rem;
            margin: 0;
        }

        .submission-body {
            padding: 2rem;
            background: white;
        }

        /* Response Content Styling */
        .submission-body h1, .submission-body h2, .submission-body h3,
        .submission-body h4, .submission-body h5, .submission-body h6 {
            color: #1e293b;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .submission-body p {
            color: #475569;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .submission-body ul, .submission-body ol {
            color: #475569;
            padding-left: 1.5rem;
        }

        .submission-body li {
            margin-bottom: 0.5rem;
        }

        .submission-body blockquote {
            border-left: 4px solid #3b82f6;
            padding-left: 1rem;
            margin: 1rem 0;
            color: #64748b;
            font-style: italic;
        }

        .submission-body code {
            background: #f1f5f9;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.875rem;
            color: #1e293b;
        }

        .submission-body pre {
            background: #f1f5f9;
            padding: 1rem;
            border-radius: 8px;
            overflow-x: auto;
            margin: 1rem 0;
        }

        /* Back Button */
        .btn-back {
            background: rgba(255,255,255,0.2);
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }

        /* Meta Info */
        .meta-info {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e2e8f0;
        }

        .meta-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .meta-item:last-child {
            margin-bottom: 0;
        }

        .meta-item i {
            color: #64748b;
            margin-right: 0.5rem;
            width: 16px;
        }

        .meta-item span {
            color: #475569;
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .student-info {
                padding: 1rem;
            }

            .submission-body {
                padding: 1.5rem;
            }

            .student-avatar {
                width: 40px;
                height: 40px;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-file-alt me-3"></i>{{ $submission->form->title }}
                    </h1>
                    <p class="page-subtitle mt-2">Form Submission Details</p>
                </div>
                <button onclick="history.back()" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </button>
            </div>
        </div>

        <!-- Student Info -->
        <div class="student-info">
            <div class="d-flex align-items-center">
                <div class="student-avatar">
                    {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                </div>
                <div class="student-details">
                    <h5>{{ $submission->student->name }}</h5>
                    <p>{{ $submission->student->email }}</p>
                </div>
            </div>
        </div>

        <!-- Submission Card -->
        <div class="submission-card">
            <div class="submission-header">
                <h4 class="submission-title">
                    <i class="fas fa-clipboard-check me-2"></i>Student Response
                </h4>
            </div>
            <div class="submission-body">
                <!-- Meta Information -->
                <div class="meta-info">
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>Submitted on {{ $submission->created_at->format('M d, Y') }} at {{ $submission->created_at->format('H:i') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span>{{ $submission->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <!-- Response Content -->
                <div class="response-content">
                    {!! $submission->responses !!}
                </div>
            </div>
        </div>

        <!-- Teacher Remarks Section -->
        <div class="submission-card mt-4">
            <div class="submission-header">
                <h4 class="submission-title">
                    <i class="fas fa-clipboard-check me-2"></i>Teacher Remarks
                </h4>
            </div>
            <div class="submission-body">
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
                            } else if (!str_contains($submission->comment, '/')) {
                                $teacherComment = $submission->comment;
                            }
                        }
                    @endphp

                    @php
                        $hasRemarks = $submission->rating !== null || !empty($teacherComment);
                    @endphp

                    <!-- Marks Section -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Correct</label>
                        <div class="d-flex align-items-center">
                            <input type="number" class="form-control" name="obtained_marks" id="obtained_marks"
                                   value="{{ $obtainedMarks }}" placeholder="0"
                                   min="0" style="width: 100px; margin-right: 10px;" {{ $hasRemarks ? 'disabled' : '' }}>
                            <span class="me-2">out of</span>
                            <input type="number" class="form-control" name="total_marks" id="total_marks"
                                    placeholder="Eg : {{ $totalMarks }}"
                                   style="width: 100px; background-color: #f8f9fa;" {{ $hasRemarks ? 'disabled' : '' }}>
                        </div>
                        <small class="text-muted">Total correct answers based on {{ $totalMarks }} form fields</small>
                    </div>

                    <!-- Comment Section -->
                    <div class="mb-4">
                        <label for="teacher_comment" class="form-label fw-semibold">Comments</label>
                        <textarea class="form-control" name="teacher_comment" id="teacher_comment" rows="4"
                                  placeholder="Add your feedback and comments for the student..." {{ $hasRemarks ? 'disabled' : '' }}>{{ $teacherComment }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        @if($hasRemarks)
                            <button type="button" class="btn btn-warning me-2" id="editBtn" onclick="enableEdit()">
                                <i class="fas fa-edit me-2"></i>Edit Remarks
                            </button>
                            <button type="submit" class="btn btn-primary" id="saveBtn" style="display: none;">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        @else
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Remarks
                            </button>
                        @endif
                    </div>
                </form>
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

