<!DOCTYPE html>
<html>
<head>
    <title>Form Responses - {{ $form->title }}</title>
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
            max-width: 1200px;
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
            font-size: 1.1rem;
            margin: 0;
        }

        /* Response Cards */
        .response-card {
            background: white;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .response-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        }

        .response-header {
            background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-secondary));
            color: var(--text-primary);
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .student-info {
            display: flex;
            align-items: center;
            justify-content: between;
        }

        .student-avatar {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 1rem;
        }

        .student-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        .submission-time {
            font-size: 0.875rem;
            opacity: 0.8;
            margin: 0;
        }

        .response-body {
            padding: 2rem;
            background: white;
        }

        /* Response Content Styling */
        .response-body h1, .response-body h2, .response-body h3,
        .response-body h4, .response-body h5, .response-body h6 {
            color: #1e293b;
            margin-bottom: 1rem;
        }

        .response-body p {
            color: #475569;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .response-body ul, .response-body ol {
            color: #475569;
            padding-left: 1.5rem;
        }

        .response-body li {
            margin-bottom: 0.5rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #64748b;
        }

        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            opacity: 0.3;
        }

        .empty-state h4 {
            color: #374151;
            margin-bottom: 1rem;
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
        }

        .btn-back:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
            color: white;
            transform: translateY(-2px);
        }

        /* Stats Bar */
        .stats-bar {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #64748b;
            margin: 0;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                padding: 1.5rem;
            }

            .response-body {
                padding: 1.5rem;
            }

            .stats-bar {
                padding: 1rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    @include('layouts.navbar')

    <div class="container py-5">
        <div class="page-header">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <div>
                    <h1 class="page-title">
                        <i class="fas fa-chart-bar me-3"></i>{{ $form->title }}
                    </h1>
                    <p class="page-subtitle mt-2">{{ $classroom->name }} - Form Responses</p>
                </div>
                <a href="{{ route('teacher.classroom.show', $classroom->id) }}" class="btn-back mt-3 mt-md-0">
                    <i class="fas fa-arrow-left me-2"></i>Back to Classroom
                </a>
            </div>
        </div>

        <!-- Stats Bar -->
        <div class="stats-bar">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->count() }}</div>
                        <div class="stat-label">Total Responses</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->unique('student_id')->count() }}</div>
                        <div class="stat-label">Students Responded</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item">
                        <div class="stat-number">{{ $submissions->count() > 0 ? $submissions->first()->created_at->format('M d') : '-' }}</div>
                        <div class="stat-label">Latest Response</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Responses -->
        @forelse($submissions as $submission)
            <div class="response-card" onclick="window.location.href='{{ route('teacher.viewSubmission', $submission->id) }}'" style="cursor: pointer;">
                <div class="response-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="student-avatar">
                                {{ strtoupper(substr($submission->student->name, 0, 1)) }}
                            </div>
                            <div>
                                <h5 class="student-name">{{ $submission->student->name }}</h5>
                                <p class="submission-time">{{ $submission->student->email }}</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="submission-time">
                                <i class="fas fa-clock me-1"></i>{{ $submission->created_at->format('M d, Y H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
                <div class="response-body">
                    {!! $submission->responses !!}

                    <!-- Teacher Remarks Section -->
                    <div class="mt-4 pt-4 border-top">
                        <h6 class="mb-3"><i class="fas fa-clipboard-check me-2"></i>Teacher Remarks</h6>

                        @php
                            $obtainedMarks = $submission->rating;
                            $teacherComment = '';

                            // Count input fields in the form HTML content
                            $formHtml = $submission->form->html_content;
                            $inputCount = 0;
                            if ($formHtml) {
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

                            $hasRemarks = $submission->rating !== null || !empty($teacherComment);
                        @endphp

                        <form action="{{ route('teacher.updateSubmissionRemark', $submission->id) }}" method="POST" class="remarks-form-{{ $submission->id }}">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Marks</label>
                                    <div class="d-flex align-items-center">
                                        <input type="number" class="form-control form-control-sm" name="obtained_marks"
                                               value="{{ $obtainedMarks }}" placeholder="0" min="0"
                                               style="width: 80px; margin-right: 8px;" {{ $hasRemarks ? 'disabled' : '' }}>
                                        <span class="me-2">/</span>
                                        <input type="number" class="form-control form-control-sm" name="total_marks"
                                               placeholder="{{ $totalMarks }}" style="width: 80px;" {{ $hasRemarks ? 'disabled' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Comments</label>
                                <textarea class="form-control form-control-sm" name="teacher_comment" rows="2"
                                          placeholder="Add feedback..." {{ $hasRemarks ? 'disabled' : '' }}>{{ $teacherComment }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end">
                                @if($hasRemarks)
                                    <button type="button" class="btn btn-warning btn-sm me-2" onclick="enableEdit({{ $submission->id }})">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </button>
                                    <button type="submit" class="btn btn-primary btn-sm" style="display: none;" id="saveBtn-{{ $submission->id }}">
                                        <i class="fas fa-save me-1"></i>Save
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fas fa-save me-1"></i>Save
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h4>No Responses Yet</h4>
                <p>Students haven't submitted responses for this form yet.</p>
            </div>
        @endforelse
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function enableEdit(submissionId) {
            const form = document.querySelector('.remarks-form-' + submissionId);
            const inputs = form.querySelectorAll('input, textarea');
            const editBtn = form.querySelector('button[onclick*="enableEdit"]');
            const saveBtn = document.getElementById('saveBtn-' + submissionId);

            inputs.forEach(input => input.disabled = false);
            editBtn.style.display = 'none';
            saveBtn.style.display = 'inline-block';
        }
    </script>
</body>
</html>
